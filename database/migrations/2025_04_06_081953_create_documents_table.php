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
