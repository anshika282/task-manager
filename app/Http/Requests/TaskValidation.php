<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'bail|required|string|max:255',
            'description' => 'bail|required|string|max:65534',
            'long_description' => 'bail|nullable|string',
            'priority' => 'bail|required|in:hig,medium,low',
            'completed' => 'bail|required|boolean',
            'start_date' => 'bail|required|date|before:tomorrow',
        ];
    }
}
