<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddOrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'waiter';
    }

    public function rules(): array
    {
        return [
            'food_id' => ['required', 'exists:foods,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}
