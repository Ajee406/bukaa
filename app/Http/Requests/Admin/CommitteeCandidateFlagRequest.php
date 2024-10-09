<?php

namespace App\Http\Requests\Admin;

use App\Rules\UniqueWithConditions;
use Illuminate\Foundation\Http\FormRequest;

class CommitteeCandidateFlagRequest extends FormRequest
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
            'name' => [
                'bail',
                'required'
            ],
            'flag' => $this->id ? 'bail|nullable|mimes:jpeg,png,jpg,webp|file|max:2048' : 'bail|required|mimes:jpeg,png,jpg,webp|file|max:2048',

            'committee_category_id' => [
                'required'
            ],
            'committee_election_id' => [
                'required',
            ]
        ];
    }
}
