<?php

namespace App\Http\Requests\Admin;

use App\Rules\UniqueWithConditions;
use Illuminate\Foundation\Http\FormRequest;

class CommitteeElectionRequest extends FormRequest
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
            'title' => [
                'bail',
                'required',
                new UniqueWithConditions('committee_elections', 'title', $this->id, 'id', ['tenant_id' => getTenantId()])
            ],
            'session' => [
                'bail',
                'required'
            ],
            'details' => [
                'bail',
                'required'
            ],
            'vote_start_date' => [
                'bail',
                'required',
                'date',
            ],
            'vote_end_date' => [
                'bail',
                'required',
                'date',
            ]
        ];
    }
}
