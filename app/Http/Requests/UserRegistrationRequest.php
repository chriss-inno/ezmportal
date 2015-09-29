<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRegistrationRequest extends Request
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
            //
            'first_name'=>'required',
            'last_name'=>'required',
            'designation'=>'required',
            'branch'=>'required',
            'department'=>'required',
            'Password' => 'required|min:5',
            'password_confirmation'=>'required|min:5',
        ];
    }
}
