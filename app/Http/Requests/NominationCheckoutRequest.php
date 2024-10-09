<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NominationCheckoutRequest extends FormRequest
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
            'election_manifesto' =>'bail|required|min:10',
            'photo' =>'required|mimes:jpg,png,jpeg,gif,pdf,docs|max:2048',
            'symbol_id' =>'required',
        ];

        foreach (request()->allFiles() as $key => $value) {
            $rules[$key] = 'required|mimes:jpg,png,jpeg,gif,pdf,docs|max:2048';
        }

        return $rules;
    }
}
