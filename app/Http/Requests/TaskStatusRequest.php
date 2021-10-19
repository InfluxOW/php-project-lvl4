<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => ['required', 'min:3', 'max:30', Rule::unique('task_statuses', 'name')]
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => ['required', 'min:3', 'max:30', Rule::unique('task_statuses', 'name')->ignore($this->status->id)],
                ];
            default:
                return [];
        }
    }
}
