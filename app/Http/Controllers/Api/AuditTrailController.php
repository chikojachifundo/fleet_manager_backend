<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    public function index(Request $request)
    {
        $query = Audit::with('user');

        // FILTER: date range
        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        // FILTER: action (created, updated, deleted)
        if ($request->event) {
            $query->where('event', $request->event);
        }

        // FILTER: model
        if ($request->model) {
            $query->where('auditable_type', $request->model);
        }

        // FILTER: user
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        return response()->json(
            $query->latest()->paginate(20)
        );
    }
}
