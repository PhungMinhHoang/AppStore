<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|min:2|max:255|unique:products',
            'description' => 'required|min:2',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'promotional' => 'nullable|numeric',
            'image' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải từ 2-255 ký tự',
            'max' => ':attribute phải từ 2-255 ký tự',
            'unique' => ':attribute đã tồn tại',
            'integer' => ':attribute phải là số nguyên',
            'numeric' => ':attribute phải là số thực',
            'image' => ':attribute phải là hình ảnh',
        ];
    }
    public function attributes()
    {       
        return [
            'name' => 'Tên sản phẩm',
            'description' => 'Mô tả sản phẩm',
            'quantity' => 'Số lượng sản phẩm',
            'price' => 'Đơn giá sản phẩm',
            'promotional' => 'Giá khuyến mại',
            'image' => 'Ảnh minh họa',
        ];
    }
}
