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
    Schema::create('urls', function (Blueprint $table) {
        $table->id();
        $table->text('original_url');
        $table->string('short_code', 10)->unique();
        $table->unsignedBigInteger('visits')->default(0);
        $table->timestamps();
    });
}

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urls');
    }
};
