<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsSubscriptionTemplateSendMailRequest extends FormRequest
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
    public function rules()
    {

        $type = $this->input('type');

        $rules = [
            'email_template' => [
                'bail',
                'required',
            ]
        ];

        if ($type === 'individual-subscription') {
            $rules['individual_subscription'] = [
                'bail',
                'required',
            ];
        }

        if ($type === 'individual-alumni') {
            $rules['individual_alumni'] = [
                'bail',
                'required',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'email_template.required' => 'Please select email template.',
            'individual_subscription.required' => 'Please select email address.',
            'individual_alumni.required' => 'Please select email address.',
        ];
    }
}
