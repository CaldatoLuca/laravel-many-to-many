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
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->after('id');

            //tramite type_id mi riferisco all' id della tabella types e al cancellare di un type lo rendo null nei project associati
            $table->foreign('type_id')->references('id')->on('types')->nullOnDelete();

            //stessa cosa ma abbraviata
            // $table->foreignId('type_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //rimuovo la relazione tra projects e type
            $table->dropForeign('projects_type_id_foreign');

            //rimuovo la colonna
            $table->dropColumn('type_id');
        });
    }
};
