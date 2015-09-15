<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DepartmentRequest extends Request
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
            'department_name'=>'required|unique:branches',
            'branch_Name'=>'required',
            'status'=>'required',
        ];
    }
}
