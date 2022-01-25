<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(User::RULES, [
            'shop_id' => 'required|exists:shops,id',
            'role_id' => 'required|exists:users,id',
        ]);
    }
}
