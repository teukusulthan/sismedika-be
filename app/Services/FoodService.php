<?php

namespace App\Services;

use App\Models\Food;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FoodService
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Food::query()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function create(array $data): Food
    {
        return Food::create($data);
    }

    public function update(Food $food, array $data): Food
    {
        $food->update($data);

        return $food->refresh();
    }

    public function delete(Food $food): void
    {
        $food->delete();
    }
}
