<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupUpdateRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                Rule::unique('groups')->ignore($this->group)
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Название" не заполнено',
            'name.unique'   => 'Группа с таким названием уже существует',
        ];
    }
}
