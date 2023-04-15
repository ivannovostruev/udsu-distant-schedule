<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReasonUpdateRequest extends FormRequest
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
            'shortname' => 'max:255',
            'name'      => 'required',
            'type'      => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'shortname.max' => 'Максимальная длина поля Краткое название - 255 символа',
            'name.required' => 'Не заполнено поле Название',
            'type.required' => 'Не заполнено поле Тип',
        ];
    }
}
