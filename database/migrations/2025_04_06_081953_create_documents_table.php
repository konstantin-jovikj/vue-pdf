<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('doc_type_id');
            $table->foreignId('fuel_id')->nullable();
            $table->string('marka');
            $table->string('tip');
            $table->string('varijanta');
            $table->string('izvedba');
            $table->string('eu_odobrenie')->nullable();
            $table->string('tip_motor')->nullable();
            $table->integer('cm3')->nullable();
            $table->integer('kw')->nullable();
            $table->integer('co2_nedc')->nullable();
            $table->integer('co2_wltp')->nullable();
            $table->string('komercijalna_oznaka')->nullable();
            $table->integer('godina_na_proizvodstvo')->nullable();
            $table->integer('najgolema_konstruktivna_vkupna_masa')->nullable();
            $table->integer('najgolema_legalna_vkupna_masa')->nullable();
            $table->integer('najgolema_legalna_vkupna_masa_na_grupa_vozila')->nullable();
            $table->integer(column: 'masa_na_voziloto')->nullable();
            $table->string('kategorija_i_vid')->nullable();
            $table->string('oblik_i_namena')->nullable();
            $table->string('broj_na_coc')->nullable();
            $table->integer(column: 'broj_na_oski')->nullable();
            $table->integer(column: 'dolzina')->nullable();
            $table->integer(column: 'sirina')->nullable();
            $table->integer(column: 'visina')->nullable();
            $table->string('dozvoleni_pnevmatici_i_naplatki_1')->nullable();
            $table->string('dozvoleni_pnevmatici_i_naplatki_2')->nullable();
            $table->integer(column: 'broj_na_vrtezi')->nullable();
            $table->string('vin')->nullable();
            $table->string('odnos_silina_masa')->nullable();
            $table->string('boja_na_voziloto')->nullable();
            $table->date('datum_na_dokument');


            $table->string('filepdf');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
