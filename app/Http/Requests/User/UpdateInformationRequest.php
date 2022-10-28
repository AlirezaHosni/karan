<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class UpdateInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullName' => 'required|max:120|min:2|regex:/^[a-zA-Z\-۰-۹0-9ء-ي. ا-ی]+$/u',
            'name' => 'required|max:120|min:2|regex:/^[a-zA-Z\-\_0-9\. ]+$/u',
            'father_name' => 'nullable|max:120|min:2|regex:/^[a-zA-Z\-۰-۹0-9ء-ي. ا-ی]+$/u',
            'email' => 'required|max:120|min:2|email',
//            'phoneNumber' => 'required|max:13|min:11|string|regex:/^(0|098|+98)9\d{9}$/u',
//            'parent_phoneNumber' => 'nullable|max:13|min:11|string|regex:/^(0|098|+98)9\d{9}$/u',
            'phoneNumber' => 'required|max:13|min:11|string',
            'parent_phoneNumber' => 'nullable|max:13|min:11|string',
            'gender' => ['required', Rule::in([0, 1]), 'numeric'],
            'role' => ['required', Rule::in([0, 1]), 'numeric'],
            'province' => 'nullable|max:120|min:2|regex:/^[a-zA-Z\-۰-۹0-9ء-ي. ا-ی]+$/u',
            'city' => 'nullable|max:120|min:2|regex:/^[a-zA-Z\-۰-۹0-9ء-ي. ا-ی]+$/u',
            'birthday' => 'nullable|numeric',
            'national_code' => 'nullable|numeric',
            'unit' => ['nullable', Rule::in([1, 2, 3]), 'numeric'],
            'grade_id' => ['nullable', 'numeric', 'exists:grades,id'],
            'password' => ['nullable', 'confirmed', 'min:6'],
        ];
    }
}
