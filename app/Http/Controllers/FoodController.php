<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use App\Services\FoodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    protected FoodService $foodService;

    public function __construct(FoodService $foodService)
    {
        $this->foodService = $foodService;
    }

    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);

        $foods = $this->foodService->paginate((int) $perPage);

        return FoodResource::collection($foods);
    }

    public function store(StoreFoodRequest $request): FoodResource
    {
        $food = $this->foodService->create($request->validated());

        return new FoodResource($food);
    }

    public function show(Food $food): FoodResource
    {
        return new FoodResource($food);
    }

    public function update(UpdateFoodRequest $request, Food $food): FoodResource
    {
        $updated = $this->foodService->update($food, $request->validated());

        return new FoodResource($updated);
    }

    public function destroy(Food $food): JsonResponse
    {
        $this->foodService->delete($food);

        return response()->json([
            'message' => 'Food deleted successfully.',
        ]);
    }
}
