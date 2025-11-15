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
    Schema::create('tags', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 150)->unique();
        // Bảng tags thường không cần timestamps, nhưng nếu muốn thì:
        // $table->timestamps(); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
