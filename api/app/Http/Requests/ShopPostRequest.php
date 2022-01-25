<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191|unique:shops,name',
            'logo' => 'nullable' // nullable for now. :(
        ];
    }
}
