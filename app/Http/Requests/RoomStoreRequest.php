<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomStoreRequest extends FormRequest
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
            'name' => 'required|unique:rooms',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Не указано название комнаты',
            'name.unique'   => 'Комната с таким названием уже существует',
        ];
    }
}
