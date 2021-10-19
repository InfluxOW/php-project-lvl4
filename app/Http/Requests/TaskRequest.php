<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:5', 'max:50'],
            'description' => ['max:1000'],
            'status_id' => Rule::exists('task_statuses', 'id'),
            'assignees' => Rule::exists('users', 'id'),
            'labels' => Rule::exists('labels', 'id'),
        ];
    }
}
