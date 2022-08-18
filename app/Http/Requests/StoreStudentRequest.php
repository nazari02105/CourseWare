<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'username' => "required|string|min:3|max:63",
            'national_code' => "required|digits:10|unique:students",
            'email' => 'required|email|string|min:6|max:63|unique:students',
            'age' => 'required|integer|between:7,40',
            'password' => 'required|string|min:5|max:63',
        ];
    }
}
