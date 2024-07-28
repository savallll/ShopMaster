<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|unique:products,name,'.$this->id,
            'price' => 'required',
            'number' => 'required',
            'sale' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            
        ];
    }

    public function messages(){
        return [
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'name.required' => 'Tên sản phẩm trống',
            'price.required' => 'giá sản phẩm trống',
            'number.required' => 'số lượng sản phẩm trống',
            'sale.required' => 'giảm giá trống',
            'province_id.required' => 'vui lòng chọn Tỉnh/TP',
            'district_id.required' => 'vui lòng chọn Quận/huyện',
            'ward_id.required' => 'vui lòng chọn địa Phường/xã',
        ];
    }
}
