<?php

namespace App\Http\Requests\Weather;

use Illuminate\Foundation\Http\FormRequest;

class GetWeatherForDateRequest extends FormRequest
{
    public function rules(): array {
        return [
            'date' => ['required', 'date']
        ];
    }
}
