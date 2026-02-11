<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CloseOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return in_array($this->user()->role, ['waiter', 'cashier']);
    }

    public function rules(): array
    {
        return [];
    }
}
