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
    Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
        $table->string('title', 200);
        $table->string('slug', 200)->unique();
        $table->text('summary')->nullable();
        $table->longText('content')->nullable();
        $table->string('thumbnail', 255)->nullable();
        $table->enum('status', ['draft','published','archived'])->default('draft');
        $table->integer('views')->default(0);
        $table->dateTime('published_at')->nullable();
        $table->timestamps();
        // Migration
        $table->boolean('featured')->default(false);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
