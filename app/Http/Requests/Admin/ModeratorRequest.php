<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ModeratorRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'max:120'],
            'email' => ['required', 'email', 'unique:users,email,' . $this->id],
            'mobile' => ['required'],
            'roles' => ['required'],
        ];

        // Check if this is an update request by checking if $this->id is present
        if ($this->id) {
            $rules['password'] = ['nullable'];
        } else {
            $rules['password'] = ['required'];
        }

        return $rules;
    }
}
