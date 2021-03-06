<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserEditRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'department'=>'required',
            'branch'=>'required',
            'phone'=>'required',
            'username'=>'required|unique:users',
            'status'=>'required',
            'right'=>'required',
            'email'=>'required|email|unique:users',
            'Password'=>'required',
            'password_confirmation'=>'required',
            'designation'=>'required',
        ];
    }
}
