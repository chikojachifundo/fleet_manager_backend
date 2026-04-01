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

        DB::transaction(function () use ($request) {

            $data = $request->validated();
            $driverUser = User::create([
                'name' => $data['firstname'] . ' ' . $data['surname'],
                'email' => $data['email'],
                'password' => Hash::make(ucfirst($data['surname'] . "@2026")),
                'group' => 'drivers',
                'status' => 'expired',
            ]);

            Driver::create(array_merge($data, ['user_id' => $driverUser->id]));
        });

        return response()->json([
            'data' => $request->validated()
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
