<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColorUpdateRequest extends FormRequest
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
            'hex' => [
                'required',
                'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/',
                Rule::unique('colors')->ignore($this->color)
            ],
//            'description'   => '',
//            'weight' => [
//                'required',
//                'integer',
//                'min:1',
//                'max:1000',
//                Rule::unique('colors')->ignore($this->color)
//            ],
        ];
    }

    public function messages()
    {
        return [
            'hex.required'      => 'Не указан цвет ячейки',
            'hex.unique'        => 'Цвет ячейки должен быть уникальным',
            'hex.regex'         => 'Неверный формат цвета ячейки',
//            'weight.required'   => 'Не указан порядок сортировки',
//            'weight.integer'    => 'Порядок сортировки должен быть числом',
//            'weight.unique'     => 'Такой порядок сортировки уже существует',
//            'weight.min'        => 'Порядок сортировки должен быть больше 1',
//            'weight.max'        => 'Порядок сортировки должен быть меньше 1000',
        ];
    }
}
