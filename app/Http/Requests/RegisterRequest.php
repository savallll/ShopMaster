<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'emailReg' => 'required|unique:users,email',
            'passwordReg' => 'required',
            // 'sale' => 'required',
            
        ];
    }

    public function messages(){
        return [
            // 'name.unique' => 'Tên tài khoản đã tồn tại',
            'name.required' => 'Tên tài khoản trống',
            'emailReg.required' => 'email trống',
            'emailReg.unique' => 'email đã tồn tại',
            'passwordReg' => 'password trống',
        ];
    }
}
