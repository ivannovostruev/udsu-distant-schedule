<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Файл не был отправлен на сервер',
            'file.mimes'    => 'Недопустимый тип файла. Ожидается xlsx или xls',
            'file.max'      => 'Максимальный объём файла 2 Мб',
        ];
    }
}
