<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CommitteeRequest extends FormRequest
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
            'user_id' => ['required', 'max:120'],
            'photo' => $this->id ? 'bail|nullable|mimes:jpeg,png,jpg,webp|file|max:2048' : 'bail|required|mimes:jpeg,png,jpg,webp|file|max:2048',
            'designation_id' => 'required',
            'committee_election_id' => 'required'
        ];
    }

}
