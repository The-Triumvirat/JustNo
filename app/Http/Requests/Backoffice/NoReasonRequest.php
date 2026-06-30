<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NoReasonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'reason' => [
                'required',
                'string',
                'max:512',
                Rule::unique('no_reasons', 'reason')->ignore($this->route('id')),
            ],
        ];
    }
}
