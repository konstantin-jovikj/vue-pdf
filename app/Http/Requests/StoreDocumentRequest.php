<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'auth()->user.id',
            'marka' => 'required',
            'doctype' => 'required|exists:doc_types,id',
            'fuel' => 'exists:fuels,id',
            'tip' => 'required',
            'varijanta' => 'required',
            'izvedba' => 'required',
            'eu_odobrenie' => '',
            'tip_motor' => '',
            'cm3' => 'max:10000|integer',
            'kw' => 'max:10000|integer',
            'co2_nedc' => 'max:500|nullable|integer|required_without:co2_wltp',
            'co2_wltp' => 'max:500|nullable|integer|required_without:co2_nedc',
            'file' => 'required|mimes:pdf|max:10240',
        ];
    }
}
