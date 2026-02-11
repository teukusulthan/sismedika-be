<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpenOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'waiter';
    }

    public function rules(): array
    {
        return [
            'table_id' => ['required', 'exists:restaurant_tables,id'],
        ];
    }
}
