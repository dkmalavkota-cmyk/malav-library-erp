<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Authorize the request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            'first_name' => 'required|string|max:100',

            'last_name' => 'nullable|string|max:100',

            'father_name' => 'nullable|string|max:150',

          'mobile' => [
    'required',
    'string',
    'max:20',
    \Illuminate\Validation\Rule::unique('students', 'mobile')
        ->where(fn ($query) => $query->where(
            'library_id',
            auth()->user()->library_id
        )),
],

            'whatsapp' => 'nullable|string|max:20',

           'email' => [
    'nullable',
    'email',
    'max:150',
    \Illuminate\Validation\Rule::unique('students', 'email')
        ->where(fn ($query) => $query->where(
            'library_id',
            auth()->user()->library_id
        )),
],

            'gender' => 'required|in:Male,Female,Other',

            'dob' => 'nullable|date',

            'aadhaar_number' => 'nullable|string|max:20',

            'address' => 'nullable|string',

            'city' => 'nullable|string|max:100',

            'state' => 'nullable|string|max:100',

            'college' => 'nullable|string|max:150',

            'course' => 'nullable|string|max:150',

            'preparing_for' => 'nullable|string|max:150',

            'joining_date' => 'required|date',

            'status' => 'required|in:Active,Inactive,Suspended',

            'remarks' => 'nullable|string',

            'photo' => 'nullable|image|max:2048',

        ];
    }

    /**
     * Custom Validation Messages
     */
    public function messages(): array
    {
        return [

            'first_name.required' => 'Please enter the first name.',

            'mobile.required' => 'Please enter the mobile number.',
            'mobile.unique' => 'This mobile number is already registered.',

            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',

            'gender.required' => 'Please select a gender.',
            'gender.in' => 'Please select a valid gender.',

            'joining_date.required' => 'Please select the joining date.',

            'status.required' => 'Please select the student status.',
            'status.in' => 'Please select a valid student status.',

            'photo.image' => 'Please upload a valid image.',
            'photo.max' => 'Photo size must not exceed 2 MB.',

        ];
    }
}