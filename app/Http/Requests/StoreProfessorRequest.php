<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfessorRequest extends FormRequest
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
            'national_code' => "required|digits:10|unique:professors",
            'email' => 'required|email|string|min:6|max:63|unique:professors',
            'experience' => 'required|integer|between:5,40',
            'age' => 'required|integer|between:25,60',
            'password' => 'required|string|min:5|max:63',
        ];
    }
}
