<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'avatar' => ['image', 'mimes:jpeg,jpg,png,gif,svg', 'max:1024', 'dimensions:ratio=1/1'],
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
