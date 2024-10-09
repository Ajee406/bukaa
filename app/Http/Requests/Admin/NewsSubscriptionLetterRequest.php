<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsSubscriptionLetterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(){

        return [
            'email' => [
                'bail',
                'required',
                'email'
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Please enter your email address.',
        ];
    }
}
