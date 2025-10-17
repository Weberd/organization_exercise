<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationsByGeoRectangleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow access, add auth logic if needed
    }

    /**
     * Use route parameters for validation.
     */
    public function validationData()
    {
        return [
            'min_lng' => $this->route('min_lng'),
            'min_lat' => $this->route('min_lat'),
            'max_lng' => $this->route('max_lng'),
            'max_lat' => $this->route('max_lat'),
        ];
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'min_lng' => 'required|numeric|between:-180,180',
            'max_lng' => 'required|numeric|between:-180,180|gte:min_lng',
            'min_lat' => 'required|numeric|between:-90,90',
            'max_lat' => 'required|numeric|between:-90,90|gte:min_lat',
        ];
    }

    /**
     * Optional: Custom error messages
     */
    public function messages(): array
    {
        return [
            'min_lng.required' => 'Minimal longitude required',
            'max_lng.gte' => 'Max longitude must be more or equal than minimal',
            'min_lat.required' => 'Minimal latitude required',
            'max_lat.gte' => 'Max latitude must be more or equal than minimal',
        ];
    }
}
