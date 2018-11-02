<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RequestAdd extends FormRequest
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
        $data = array();

        $data['username'] = 'required';
        $data['password'] = 'required';
        $data['password_confirmation'] = 'required';
        $data['email'] = 'required|email|unique:users,email';
        $data['firstname'] = 'required';
        $data['lastname'] = 'required';

        $data['status'] = 'required';


        return $data;
    }

    public function messages()
    {
        $data = array();

        $data['username.required'] = 'Tên tài khoản không được để trống.';
        $data['password.required'] = 'Mật khẩu không được để trống.';
        $data['password_confirmation.required'] = 'Xác nhận mật khẩu không được để trống.';
        $data['email.required'] = 'Email không được để trống.';
        $data['firstname.required'] = 'Tên thành viên không được để trống.';
        $data['lastname.required'] = 'Họ thành viên không được để trống.';
        $data['avatar.required'] = 'Ảnh đại diện không được để trống.';
        $data['status.required'] = 'Trạng thái thành viên không được để trống.';

        return $data;
    }

    public function validate() {
        $data = $this->all();

        $rules = $this->rules();
        $messages = $this->messages();

        $validator = \Validator::make($data, $rules, $messages);

        $errors = array();
        if ($validator->fails()) {
            $errors = $validator->errors();
        }
        return $errors;
    }
}
