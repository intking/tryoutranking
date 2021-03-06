<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRegisterTryoutRequest extends FormRequest
{
    public function authorize()
    {
        //return Gate::allows('register_access');
        return true;
    }

    public function rules()
    {
        return [
            // 'user_id' => [
            //     'exists:users,id',
            // ],
            'tryout_id' => [
                'required'|'exists:tryouts,id',
            ],
            'user_name' => [
                'required',
            ],
            'school_name' => [
                'required',
            ],
            'graduation_date' => [
                'required',
            ],
            'phone_number' => [
                'required',
            ],
        ];
    }
}
