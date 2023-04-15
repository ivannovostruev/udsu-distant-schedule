<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonStoreRequest extends FormRequest
{
    /**
     * Валидные строки:
     * 01.01.2022, 01.01.2022,
     * 01.01.2022,01.01.2022,
     * 01.01.2022,01.01.2022
     * 09.09.2050,
     * 10.10.2155,
     * 19.12.2222,
     * 20.01.2777,
     * 29.09.2023,
     * 30.10.2023,
     * 31.12.2023,
     */
    const DATES_PATTERN = '/^((((0[1-9])|(1\d)|(2\d)|(3[01]))\.((0[1-9])|(1[0-2]))\.(2\d{3})), ?)*(?2),?$/';

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
            'date'                  => 'required_without:dates|date_format:Y-m-d',
            'dates'                 => ['required_without:date', 'string', 'regex:' . self::DATES_PATTERN],
            'timeslots'             => 'required|array|min:1',
            'groups'                => 'array|min:1',
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
            'date.required_without'     => 'Не заполнено поле Дата',
            'dates.required_without'    => 'Не заполнено поле Даты',
            'dates.regex'               => 'Некорректный формат ввода дат через запятую',
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
