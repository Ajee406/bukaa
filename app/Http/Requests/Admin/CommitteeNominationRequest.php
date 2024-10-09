<?php

namespace App\Http\Requests\Admin;

use App\Rules\UniqueWithConditions;
use Illuminate\Foundation\Http\FormRequest;

class CommitteeNominationRequest extends FormRequest
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
            'title' => 'bail|required',
            'election_id' => 'bail|required',
            'category_id' => 'bail|required',
            'designation_id' => 'bail|required',
            'start_date' => 'bail|required|date',
            'end_date' => 'bail|required|date',
            'form_price' => 'bail|nullable|min:1',
        ];
    }
}
