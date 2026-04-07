<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseActionController extends Controller
{
    public function approve(Expense $expense): \Illuminate\Http\JsonResponse
    {
        $expense->update(['status' => 'approved']);
        return response()->json([
            'message' => 'Expense approved successfully'
        ]);
    }

    public function reject(Expense $expense): \Illuminate\Http\JsonResponse
    {
        $expense->update(['status' => 'rejected']);
        return response()->json([
            'message' => 'Expense rejected successfully'
        ]);
    }

}
