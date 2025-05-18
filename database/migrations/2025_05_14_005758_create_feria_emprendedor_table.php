<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('feria_emprendedor', function (Blueprint $table) {
        // LÍNEAS MODIFICADAS (agregar onDelete cascade)
        $table->foreignId('feria_id')->constrained('ferias')->onDelete('cascade');  
        $table->foreignId('emprendedor_id')->constrained('emprendedores')->onDelete('cascade');  
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feria_emprendedor');
    }
};
