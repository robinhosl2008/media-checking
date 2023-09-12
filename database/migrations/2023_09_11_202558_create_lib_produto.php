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
        Schema::create('lib_produto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vertical_id');
            $table->string('descricao');
            $table->unsignedDecimal('area_lar');
            $table->unsignedDecimal('area_alt');
            $table->unsignedDecimal('visual_lar');
            $table->unsignedDecimal('visual_alt');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable(true);
            $table->foreign('vertical_id')->references('id')->on('lib_vertical');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lib_produto');
    }
};
