<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservedVehicleRequest extends FormRequest
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
            'starting_at' => 'required|date|after_or_equal:today',
            'ending_at' => 'required|date|after_or_equal:starting_at',
        ];
    }
}
