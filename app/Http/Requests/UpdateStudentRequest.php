<?php

namespace App\Http\Requests;

use App\Models\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_edit');
    }

    public function rules()
    {
        return [
            'hours' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'specialization_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'nullable',
                'unique:users,email,' . request()->user_id,
            ],
            'phone' => [
                'required',
                'size:10',
                'regex:/(05)[0-9]{8}/',
                'unique:users,phone,' . request()->user_id,
            ],
        ];
    }
}
