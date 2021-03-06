<?php

namespace App\Http\Requests;

use App\Models\Group;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('group_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'course_hours' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'course_cost' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'students.*' => [
                'integer',
            ],
            'students' => [ 
                'array',
            ],
            'photo' => [
                'required',
            ],
        ];
    }
}
