<?php

namespace App\Models;

use App\Models\Fuel;
use App\Models\User;
use App\Models\DocType;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'user_id',
        'doc_type_id',
        'fuel_id',
        'marka',
        'tip',
        'varijanta',
        'izvedba',
        'eu_odobrenie',
        'tip_motor',
        'cm3',
        'kw',
        'co2_nedc',
        'co2_wltp',
        'filepdf',
        'komercijalna_oznaka',
        'godina_na_proizvodstvo',
        'najgolema_konstruktivna_vkupna_masa',
        'najgolema_legalna_vkupna_masa',
        'najgolema_legalna_vkupna_masa_na_grupa_vozila',
        'masa_na_voziloto',
        'kategorija_i_vid',
        'oblik_i_namena',
        'broj_na_coc',
        'broj_na_oski',
        'dolzina',
        'sirina',
        'visina',
        'dozvoleni_pnevmatici_i_naplatki_1',
        'dozvoleni_pnevmatici_i_naplatki_2',
        'broj_na_vrtezi',
        'vin',
        'odnos_silina_masa',
        'boja_na_voziloto',
        'datum_na_dokument',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function docType()
    {
        return $this->belongsTo(DocType::class, 'doc_type_id'); // Make sure this matches your column name
    }

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }
}
