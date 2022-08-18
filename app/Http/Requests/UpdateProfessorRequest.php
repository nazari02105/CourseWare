<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfessorRequest extends FormRequest
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
            'national_code' => "required|digits:10",
            'email' => 'required|email|string|min:6|max:63',
            'experience' => 'required|integer|between:5,40',
            'age' => 'required|integer|between:25,60',
        ];
    }
}
