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
        Schema::table('types', function (Blueprint $table) {
            /* AGGIUNGO SLUG ALLA TABELLA */
            $table->string('slug', 30)->unique()->after('label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('types', function (Blueprint $table) {
            /* BOTTO GIU' LA COLLONA */
            $table->dropColumn('slug');
        });
    }
};