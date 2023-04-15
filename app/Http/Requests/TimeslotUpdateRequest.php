<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeslotUpdateRequest extends FormRequest
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
            'name'          => 'required|max:255',
            'start_time'    => 'required',
            'end_time'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Не заполнено поле Название',
            'name.max'              => 'Максимальная длина поля Название - 255 символа',
            'start_time.required'   => 'Не заполнено поле Время начала',
            'end_time.required'     => 'Не заполнено поле Время конца',
        ];
    }
}
