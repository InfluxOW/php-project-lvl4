<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabelValidation extends FormRequest
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
                    'name' => 'required|min:3|max:50|unique:labels,name',
                    'description' => 'required|min:10|max:300'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|min:3|max:50|unique:labels,name,' . $this->label->id,
                    'description' => 'required|min:10|max:300'
                ];
            default:
                break;
        }
    }
}
