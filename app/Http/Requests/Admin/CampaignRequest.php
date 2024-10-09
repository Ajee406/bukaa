<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
            'title' => ['required', 'max:120'],
            'image' => $this->slug ? 'bail|nullable|mimes:jpeg,png,jpg,webp|file|max:2048' : 'bail|required|mimes:jpeg,png,jpg,webp|file|max:2048',
            'video_url' => 'bail|nullable|url',
            'campaign_category_id' => 'bail|required',
            'goal' => 'bail|nullable|numeric',
            'location' => 'bail|nullable|string',
            'end_date' => 'bail|nullable|date',
            'details' => 'bail|required|min:10',
            'minimum_amount' => 'bail|nullable|min:1'
        ];
    }
}
