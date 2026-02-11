<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Food;
use App\Models\RestaurantTable;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function open(int $tableId, int $userId): Order
    {
        return DB::transaction(function () use ($tableId, $userId) {

            $table = RestaurantTable::lockForUpdate()->findOrFail($tableId);

            if ($table->status !== 'available') {
                throw ValidationException::withMessages([
                    'table_id' => ['Table is not available.'],
                ]);
            }

            $order = Order::create([
                'table_id' => $table->id,
                'user_id' => $userId,
                'status' => 'open',
                'total_price' => 0,
            ]);

            $table->update([
                'status' => 'occupied',
            ]);

            return $order;
        });
    }

    public function addItem(Order $order, int $foodId, int $quantity): Order
    {
        return DB::transaction(function () use ($order, $foodId, $quantity) {

            $order->refresh();

            if ($order->status !== 'open') {
                throw ValidationException::withMessages([
                    'order' => ['Order is already closed.'],
                ]);
            }

            $food = Food::findOrFail($foodId);

            $subtotal = $food->price * $quantity;

            OrderItem::create([
                'order_id' => $order->id,
                'food_id' => $food->id,
                'quantity' => $quantity,
                'price' => $food->price,
                'subtotal' => $subtotal,
            ]);

            $order->update([
                'total_price' => $order->total_price + $subtotal,
            ]);

            return $order->load(['items.food', 'table', 'user']);
        });
    }

    public function close(Order $order): Order
    {
        return DB::transaction(function () use ($order) {

            $order->refresh();

            if ($order->status !== 'open') {
                throw ValidationException::withMessages([
                    'order' => ['Order is already closed.'],
                ]);
            }

            $order->update([
                'status' => 'closed',
                'closed_at' => now(),
            ]);

            $order->table()->update([
                'status' => 'available',
            ]);

            return $order->load(['items.food', 'table', 'user']);
        });
    }
}
