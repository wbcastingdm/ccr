<?php

namespace App\Http\Requests\Point;

use Illuminate\Foundation\Http\FormRequest;

class StorePointRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'point' => 'required|integer|min:1',
            'subject' => 'required|string|min:5|max:300',
            'phone' => 'required|min:11|max:14',
            'type_id' => 'required|integer'
        ];
    }
}
