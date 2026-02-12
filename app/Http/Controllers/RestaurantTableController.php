<?php

namespace App\Http\Controllers;

use App\Models\RestaurantTable;

class RestaurantTableController extends Controller
{
    public function index()
    {
        return response()->json(
            RestaurantTable::all()
        );
    }
}
