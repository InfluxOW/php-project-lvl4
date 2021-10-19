<?php

namespace App\Http\Requests;

use App\Enums\AttentionLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LabelRequest extends FormRequest
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
                    'name' => ['required', 'min:3', 'max:50', Rule::unique('labels', 'name')],
                    'description' => ['required', 'min:10', 'max:300'],
                    'attention_level' => Rule::in(array_values(AttentionLevel::getConstants())),
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => ['required', 'min:3', 'max:50', Rule::unique('labels', 'name')->ignore($this->label->id)],
                    'description' => ['required', 'min:10', 'max:300'],
                    'attention_level' => Rule::in(array_values(AttentionLevel::getConstants())),
                ];
            default:
                return [];
        }
    }
}
