<?php

use App\Models\Type;
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
            /* NOME COLLONA, VALORE NON ABBLIGATORIO(NULL), POSIZIONE*/
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            /* CREO CHIAVE ESTERNA, PUNTO ALL'ID DELLA TABELLA TYPES, SE CANCELLO LA CATEGORIA METTI NULL */
            $table->foreign('type_id')->references('id')->on('types')->nullOnDelete();

            /* IL METODO CONSTRAINED --> CREA AUTOMATICAMENTE IL VINCOLO TRA LE DUE TABELLE */
            /* $table->foreignIdFor(Type::class)->after('id')->nullable()->constrained()->nullOnDelete(); */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            /* BOTTO GIU' AUTOMATICAMENTELA CHIAVE ESTERNA  */
            /* $table->dropForeignIdFor(Type::class); */
            
            /* BOTTO GIU' LA RELAZIONE (CHIAVE ESTERNA) */
            $table->dropForeign('projects_type_id_foreign');
            
            /* SMONTO LA COLLONA */
            $table->dropColumn('type_id');
        });
    }
};