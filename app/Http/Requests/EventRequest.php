<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'date' => 'required|date',
            '_sport_id' => 'required|numeric|exists:sports,id',
            '_team_id_1' => 'required|numeric|exists:teams,id',
            '_team_id_2' => 'required|numeric|exists:teams,id',
        ];
    }
}
