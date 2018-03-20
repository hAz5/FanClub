<?php

namespace FanClub\request;

use Illuminate\Foundation\Http\FormRequest;

class StoreActionRequest extends FormRequest
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
            'name'=>'required|max:1000',
            'slug'=>'required|max:900|unique:actions,slug',
            'score'=>'required|numeric',
            'description'=>'required',
            'status'=>'sometimes|numeric|max:0|min:0'
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'نام فعالیت',
            'slug'=>'نامک فعالیت',
            'score'=>'امتیاز',
            'status'=>'وضعیت فعالیت'
        ];
    }
}
