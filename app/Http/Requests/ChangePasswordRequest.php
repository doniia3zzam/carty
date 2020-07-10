<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'password' => 'required|same:password',
            'old_password' => 'required',
            'password_confirmation' => 'required|same:password'

        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Password field is required',
            'old_password.required' => 'Current password field is required',
            'password_confirmation.required' => 'Password confirmation field is required',
            'password_confirmation.same' => 'Field should be same as New Password'
        ];
    }
}
