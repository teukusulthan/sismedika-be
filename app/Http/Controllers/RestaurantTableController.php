<?php

namespace App\Http\Controllers;

use App\Models\RestaurantTable;

class RestaurantTableController extends Controller
{
    public function index()
{
    $tables = RestaurantTable::with(['orders' => function ($q) {
        $q->where('status', 'open');
    }])->get();

    $tables->transform(function ($table) {
        return [
            'id' => $table->id, 
            'name' => $table->name,
            'status' => $table->status,
            'current_order_id' => optional($table->orders->first())->id,
        ];
    });

    return response()->json($tables);
}
}
