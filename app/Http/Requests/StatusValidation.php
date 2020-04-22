<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'name' => 'required|min:3|max:30|unique:task_statuses,name'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|min:3|max:30|unique:task_statuses,name' . $this->task_status->id,
                ];
            default:
                break;
        }
    }
}
