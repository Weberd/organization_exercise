<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationsByGeoRadiusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow all requests, or implement your auth logic
    }

    /**
     * Use route parameters for validation
     */
    public function validationData(): array
    {
        return [
            'latitude'  => $this->route('lat'),
            'longitude' => $this->route('lng'),
            'radius'    => $this->route('radius'),
        ];
    }

    public function rules(): array
    {
        return [
            'latitude'  => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'radius'    => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'latitude.required'  => 'Latitude is required.',
            'latitude.numeric'   => 'Latitude must be a number.',
            'latitude.between'   => 'Latitude must be between -90 and 90.',
            'longitude.required' => 'Longitude is required.',
            'longitude.numeric'  => 'Longitude must be a number.',
            'longitude.between'  => 'Longitude must be between -180 and 180.',
            'radius.required'    => 'Radius is required.',
            'radius.numeric'     => 'Radius must be a number.',
            'radius.min'         => 'Radius must be at least 0.',
        ];
    }
}
