<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateGeofenceRequest extends FormRequest
{
    public $isApiRequest = false;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Request $request): bool
    {
        $id = $request->get('id') ?? $request->route('geofence');
        if ($id === null) {
            return false;
        }
        if (! $request->has('id')) {
            $this->isApiRequest = true;
        }

        return auth()->user()->geofences()->where('id', $id)->count() > 0;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $validations = [
            'app_id' => 'required',
            'name' => 'nullable',
            'webhook_url' => 'nullable|active_url',
            'geometry' => 'nullable|json',
        ];
        if ($this->isApiRequest) {
            return $validations;
        }
        $validations['id'] = 'required';

        return $validations;
    }
}
