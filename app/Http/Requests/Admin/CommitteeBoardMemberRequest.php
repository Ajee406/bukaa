<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CommitteeBoardMemberRequest extends FormRequest
{
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
        return [
            'name' => ['required', 'max:120'],
            'photo' => $this->id ? 'bail|nullable|mimes:jpeg,png,jpg,webp|file|max:2048' : 'bail|required|mimes:jpeg,png,jpg,webp|file|max:2048',
            'email' => ['required', 'email', 'unique:users,email,'.$this->user_id],
            'phone' => 'bail|required|min:6|unique:users,mobile,'.$this->user_id,
            'password' =>  $this->id ? 'nullable|string|min:6' : 'required|string|min:6',
            'designation_id' =>  'required',
            'election_id' =>  'required',
            'company' =>  'required|min:2',
            'address' =>  'required:min:5',
        ];
    }
}
