<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonUpdateRequest extends FormRequest
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
            'name'                  => 'required|max:256',
            'date'                  => 'required|date_format:Y-m-d',
            'timeslot_id'           => 'required|integer|exists:timeslots,id',
            'teacher_id'            => 'required|integer|exists:teachers,id',
            'education_level'       => 'required|integer',
            'type'                  => 'required|integer',
            'system_type'           => 'required|integer',
            'link_type'             => '',
            'location'              => 'required|integer',
            'commentary'            => '',
            'should_record'         => '',
            'special_requirements'  => 'array',
            'color_id'              => '',
            'room_id'               => '',
            'admin_feedback'        => '',
            'status'                => 'integer|nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => 'Не заполнено поле Название',
            'name.max'                  => 'Максимальная длина поля - 256 символов',
            'date.required'             => 'Не заполнено поле Дата',
            'teacher_id.required'       => 'Не заполнено поле Преподаватель',
            'education_level.required'  => 'Не заполнено поле Уровень образования',
            'type.required'             => 'Не заполнено поле Тип занятия',
            'system_type.required'      => 'Не заполнено поле Система видеоконференций',
            'link_type.required'        => 'Не заполнено поле Тип ссылки',
            'location.required'         => 'Не заполнено поле Место проведения',
            'commentary'                => '',
            'should_record'             => '',
            'special_requirements'      => '',
            'color_id'                  => '',
            'room_id'                   => '',
            'admin_feedback'            => '',
            'status'                    => '',
        ];
    }
}
