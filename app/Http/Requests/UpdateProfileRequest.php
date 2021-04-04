<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:60'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::id())],
            // 'photo' => ['image', 'mimes:png, jpg, jpeg', 'nullable', 'size:1024'],

        ];
    }
}
