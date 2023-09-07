<?php

namespace App\Http\Requests\API\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
            'name' => 'required|string|max:32|regex:/^[a-zA-Z]+(?:[\\s.]+[a-zA-Z]+)*$/',
            'email' => 'required|string|email|max:245|unique:' . User::class,
            'password' => ['required', 'min:8', 'max:32', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+. ,])[A-Za-z\d!@#$%^&*()_+. ,]*$/'],
        ];
    }


    public function messages()
    {
        return [
            'name.regex' => 'The name should be of alphabets.',
            'email.max' => 'The email field must not exceed 245 characters in length.',
            'email.unique' => 'This email has already been taken.',
            'name.alpha' => 'The name field must only contain alphabetical characters.',
            'password.regex' => 'The password must contain at least one capital letter, one digit and one special character.'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => "Validation error",
            'errors' => $validator->errors(),
        ]));
    }
}
