<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OracleSupportRequest extends Request
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
            'issue_title'=>'required',
            'description'=>'required',
            'sr_number'=>'required',
            'product'=>'required',
            'contact'=>'required',
            'date_opened'=>'required|date',
            'status'=>'required'
        ];
    }
}
