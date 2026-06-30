<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|min:3|max:12',
            'email' => 'nullable|email:rfc|max:128',
            'mPhone' => 'nullable|string|min:6|max:24',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => trim($this->name),
            'email' => trim($this->email),
            'mPhone' => trim($this->mPhone),
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'msg' => $validator->errors()
            ], 422)
        );
    }
}
