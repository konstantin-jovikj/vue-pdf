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
            'komercijalna_oznaka' => 'nullable',
            'godina_na_proizvodstvo' => ['nullable', 'digits:4', 'integer', 'min:1900', 'max:' . date('Y')],
            'najgolema_konstruktivna_vkupna_masa' => 'nullable|integer',
            'najgolema_legalna_vkupna_masa' => 'nullable|integer',
            'najgolema_legalna_vkupna_masa_na_grupa_vozila' => 'nullable|integer',
            'masa_na_voziloto' => 'nullable|integer',
            'kategorija_i_vid' => 'nullable',
            'oblik_i_namena' => 'nullable',
            'broj_na_coc' => 'nullable',
            'broj_na_oski' => 'nullable|integer',
            'dolzina' => 'nullable|integer',
            'sirina' => 'nullable|integer',
            'visina' => 'nullable|integer',
            'dozvoleni_pnevmatici_i_naplatki_1' => 'nullable',
            'dozvoleni_pnevmatici_i_naplatki_2' => 'nullable',
            'broj_na_vrtezi' => 'nullable|integer',
            'vin' => ['nullable', 'regex:/^[A-HJ-NPR-Z0-9]{17}$/'],
            'odnos_silina_masa' => 'nullable',
            'boja_na_voziloto' => 'nullable',
            'datum_na_dokument' => 'date|nullable',
        ];
    }
}
