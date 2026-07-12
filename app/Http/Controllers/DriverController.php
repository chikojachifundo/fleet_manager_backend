<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'drivers' => Driver::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request)
    {

        $driver = DB::transaction(function () use ($request) {

            $data = $request->validated();
            $driverUser = User::create([
                'name' => $data['firstname'] . ' ' . $data['surname'],
                'email' => $data['email'],
                'password' => Hash::make(ucfirst($data['surname'] . "@2026")),
                'group' => 'drivers',
                'status' => 'expired',
            ]);

            return Driver::create(array_merge($data, ['user_id' => $driverUser->id]));
        });

        // Attach license file
        if ($request->hasFile('license_file')) {
            $driver->addMediaFromRequest('license_file')
                ->usingName($driver->licence_number . '_license')
                ->withCustomProperties(['category' => 'license'])
                ->toMediaCollection('license');
        }

        // Attach national ID file
        if ($request->hasFile('national_id_file')) {
            $driver->addMediaFromRequest('national_id_file')
                ->usingName($driver->national_id_number . '_national_id')
                ->withCustomProperties(['category' => 'national_id'])
                ->toMediaCollection('national_id');
        }

        return response()->json([
            'message' => 'Driver registered successfully',
            'driver' => $driver->load('media'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        return response()->json([
            'driver' => $driver,
            'media' => $driver->getMedia(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $driver->update($request->validated());

        // Attach license file if provided
        if ($request->hasFile('license_file')) {
            $driver->addMediaFromRequest('license_file')
                ->usingName($driver->licence_number . '_license')
                ->withCustomProperties(['category' => 'license'])
                ->toMediaCollection('license');
        }

        // Attach national ID file if provided
        if ($request->hasFile('national_id_file')) {
            $driver->addMediaFromRequest('national_id_file')
                ->usingName($driver->national_id_number . '_national_id')
                ->withCustomProperties(['category' => 'national_id'])
                ->toMediaCollection('national_id');
        }

        return response()->json([
            'message'=>'Driver updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
