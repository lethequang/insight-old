<?php

namespace App\Http\Requests\Role_User;

use Illuminate\Foundation\Http\FormRequest;

class RequestUpdate extends FormRequest
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
            'role_id' => 'required',
        ];
    }

    public function messages()
    {

        return [
            'role_id.required' => 'Nhóm chưa được chọn ',
        ];
    }

}
