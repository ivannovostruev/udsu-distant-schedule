<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherUpdateRequest extends FormRequest
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
            'full_name' => 'string',
            'email' => [
                'email:rfc,dns',
                Rule::unique('teachers')->ignore($this->teacher),
            ],
        ];
    }

    public function messages()
    {
        return [
            'full_name.string'  => 'ФИО преподавателя содержит недопустимые символы',
            'email.email'       => 'Неверный формат адреса электронной почты',
            'email.unique'      => 'Такой адрес электронной почты уже существует',
        ];
    }
}
