<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithDateRangeRequest extends FormRequest
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
            'start' => 'nullable|date_format:m-d-Y',
            'end' => 'nullable|date_format:m-d-Y',
            'direction' => 'nullable|in:asc,desc,ASC,DESC'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'start.date_format' => __("format.date.m-d-Y"),
            'end.date_format' => __("format.date.m-d-Y"),
            'direction.in' => __("filters.sort.direction"),
        ];
    }
}
