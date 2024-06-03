<?php

namespace App\Http\Requests\Type;

use Illuminate\Foundation\Http\FormRequest;

class TypeAssignRequest extends FormRequest
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
            // 'name' => 'required|string|unique:user_types,name'
            'user_id' => 'required|exists:users,id',
            'type_id' => 'required|exists:user_types,id',
        ];
    }
}
