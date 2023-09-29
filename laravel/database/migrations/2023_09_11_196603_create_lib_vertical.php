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
        Schema::create('lib_vertical', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_midia_id');
            $table->string('descricao');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable(true);
            $table->foreign('tipo_midia_id')->references('id')->on('lib_tipo_midia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lib_vertical');
    }
};
