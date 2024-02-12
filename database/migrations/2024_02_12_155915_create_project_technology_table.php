<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_technology', function (Blueprint $table) {
            // $table->id();

            //uso constrained, metodo ridotto
            //cascade va ad agire solo sulla tabella pivot quindi non va a eliminare i project collegati a quell' id
            //diverso rispetto al comportamento coi type
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('technology_id')->constrained()->cascadeOnDelete();

            //creo io l' indice della tabella, unione delle due key
            $table->primary(["project_id", "technology_id"]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
