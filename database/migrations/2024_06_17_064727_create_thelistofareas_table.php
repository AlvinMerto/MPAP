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
        Schema::create('thelistofareas', function (Blueprint $table) {
            $table->increments("specificareaid");
            $table->integer("areaid");
            $table->string("thespecareaname");
            $table->string("lat");
            $table->string("lng");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thelistofareas');
    }
};
