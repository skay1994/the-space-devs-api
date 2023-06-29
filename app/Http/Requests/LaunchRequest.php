<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LaunchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'rocket_id' => 'required|exists:rockets,id',
            'launch_provider_id' => 'required|exists:launch_service_providers,id',
            'name' => 'required',
            'status' => ['required', Rule::in(Status::values())],
            'url' => 'required',
            'probability' => 'nullable',
            'holdreason' => 'nullable',
            'failreason' => 'nullable',
            'hashtag' => 'nullable',
            'image' => 'nullable',
            'infographic' => 'nullable',
            'program' => 'nullable',
            'inhold' => 'required|boolean',
            'webcast_live' => 'required|boolean',
            'net' => 'required|date_format:Y-m-d H:i:s',
            'tbdtime' => 'required|date_format:Y-m-d H:i:s',
            'tbddate' => 'required|date_format:Y-m-d H:i:s',
            'window_start' => 'required|date_format:Y-m-d H:i:s',
            'window_end' => 'required|date_format:Y-m-d H:i:s',
        ];
    }
}
