<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class ReminderRequest extends Request
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
            'rm_title'=>'required',
            'start_date'=>'required|date_format:"Y-m-d"',
            'end_date'=>'required|date_format:"Y-m-d"|after:start_date',
            'description'=>'required',
            'recurrence_pattern'=>'required',
            'status'=>'required',
            'emails'=>'required'
        ];
    }
}
