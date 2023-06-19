<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

    public function prepareForValidation()
    {
        $sku = $this->get('sku');
        $this->merge(['sku' => strtoupper($sku)]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:products',
            'description' => 'required',
            'categories' => 'required|array',
            'brand' => 'nullable|integer',
            'price' => 'required|integer',
            'selling_price' => 'required|integer',
            'sku' => 'required|unique:products',
            'should_track' => 'sometimes|integer',
            'stock_count' => 'nullable|required_if:should_track,1|integer',
            'is_active' => 'sometimes|boolean',
            'base_image' => 'required|integer',
            'additional_images' => 'sometimes|array',
        ];

        if (! $this->isMethod('POST')) {
            $rules['slug'] = 'required|max:255|unique:products,id,'.$this->route('product')->id;
            $rules['sku'] = 'required|unique:products,id,'.$this->route('product')->id;
        }

        return $rules;
    }

    public function all($keys = null)
    {
        $data = parent::all() + [
            'is_active' => 0,
        ];

        $data['brand_id']    = $data['brand'];
        $data['stock_count'] = intval($data['stock_count']);

        return $data;
    }
}
