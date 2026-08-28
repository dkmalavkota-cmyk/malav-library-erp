<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
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

            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'code' => [

                'required',
                'string',
                'max:20',

              Rule::unique('rooms', 'code')
    ->where(fn ($query) => $query->where(
        'library_id',
        auth()->user()->library_id
    ))
    ->ignore($this->route('room')),
            ],

            'floor' => [
                'nullable',
                'string',
                'max:100',
            ],

            'total_seats' => [
                'required',
                'integer',
                'min:1',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                'in:Active,Inactive',
            ],

        ];
    }
}