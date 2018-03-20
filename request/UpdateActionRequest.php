<?php

namespace FanClub\request;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActionRequest extends FormRequest
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
            'id'=>'required|exists:actions,id',
            'name'=>'required|max:1000',
            'slug'=>'required|max:900|unique:actions,slug,'.$this->get('id').',id',
            'score'=>'required|numeric',
            'description'=>'required',
            'status'=>'sometimes|numeric|max:0|min:0'
        ];
    }
}
