<?php

namespace App\Http\Requests\Backoffice;

use App\Models\NoReason;
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
        $noReason = $this->route('noReason');

        return [
            'reason' => [
                'required',
                'string',
                'max:512',
                Rule::unique('no_reasons', 'reason')->ignore(
                    $noReason instanceof NoReason ? $noReason->getKey() : null
                ),
            ],
        ];
    }
}
