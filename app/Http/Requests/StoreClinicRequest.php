<?php

namespace App\Http\Requests;

use App\Models\Clinic;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClinicRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('clinic_create');
    }

    public function rules()
    {
        return [
            'clinic_number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'clinic_name' => [
                'string',
                'required',
            ],
            'specializations.*' => [
                'integer',
            ],
            'specializations' => [
                'required',
                'array',
            ],
        ];
    }
}
