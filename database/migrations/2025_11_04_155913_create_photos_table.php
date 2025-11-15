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
    Schema::create('photos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('article_id')->constrained('articles')->onDelete('cascade');
        $table->string('url', 255);
        $table->string('caption', 255)->nullable();
        // Bảng này không cần timestamps
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
