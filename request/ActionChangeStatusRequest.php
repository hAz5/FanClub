<?php

namespace FanClub\request;

use Illuminate\Foundation\Http\FormRequest;

class ActionChangeStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'action_id'=>'required|exists:actions,id',
            'status'=>'required|min:0|max:1'
        ];
    }


    public function attributes()
    {
        return [
            'action_id'=>'ای دی فعالیت',
            'status'=>'وضعیت'
        ];
    }
}
