<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users')->ignore($this?->user?->id)],
            'password' => ['required', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
        ];
    }
}
