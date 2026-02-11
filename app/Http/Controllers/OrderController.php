<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpenOrderRequest;
use App\Http\Requests\AddOrderItemRequest;
use App\Http\Requests\CloseOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(): AnonymousResourceCollection
    {
        $orders = Order::with(['table', 'user'])
            ->latest()
            ->paginate(10);

        return OrderResource::collection($orders);
    }

    public function show(Order $order): OrderResource
    {
        $order->load(['items.food', 'table', 'user']);

        return new OrderResource($order);
    }

    public function open(OpenOrderRequest $request): OrderResource
    {
        $order = $this->orderService->open(
            $request->validated()['table_id'],
            $request->user()->id
        );

        return new OrderResource($order->load(['table', 'user']));
    }

    public function addItem(AddOrderItemRequest $request, Order $order): OrderResource
    {
        $updated = $this->orderService->addItem(
            $order,
            $request->validated()['food_id'],
            $request->validated()['quantity']
        );

        return new OrderResource($updated);
    }

    public function close(CloseOrderRequest $request, Order $order): OrderResource
    {
        $closed = $this->orderService->close($order);

        return new OrderResource($closed);
    }
}
