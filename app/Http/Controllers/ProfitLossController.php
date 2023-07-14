<?php

namespace App\Http\Controllers;

use App\Models\ProfitLoss;
use Illuminate\Http\Request;

class ProfitLossController extends Controller
{
    public function index()
    {
        $profitLosses = ProfitLoss::all();
        return response()->json(['profitLosses' => $profitLosses]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year' => 'required|integer',
            'revenue' => 'required|numeric',
            'expenses' => 'required|numeric',
            'customer_name' => 'required|string',
            'contact_person' => 'required|string',
            'deal_status' => 'required|string',
        ]);

        $data['net_profit'] = $data['revenue'] - $data['expenses'];

        $profitLoss = ProfitLoss::create($data);
        return response()->json(['profitLoss' => $profitLoss], 201);
    }

    public function update(Request $request, ProfitLoss $profitLoss)
    {
        $data = $request->validate([
            'year' => 'required|integer',
            'revenue' => 'required|numeric',
            'expenses' => 'required|numeric',
            'customer_name' => 'required|string',
            'contact_person' => 'required|string',
            'deal_status' => 'required|string',
        ]);

        $data['net_profit'] = $data['revenue'] - $data['expenses'];

        $profitLoss->update($data);
        return response()->json(['profitLoss' => $profitLoss]);
    }

    // Add other methods for delete, etc.
}
