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
    Schema::create('matches', function (Blueprint $table) {
        $table->id();
        $table->foreignId('team_home')->constrained('teams')->onDelete('cascade');
        $table->foreignId('team_away')->constrained('teams')->onDelete('cascade');
        $table->dateTime('match_date');
        $table->string('venue', 150)->nullable();
        $table->integer('score_home')->nullable();
        $table->integer('score_away')->nullable();
        $table->enum('status', ['upcoming','ongoing','finished'])->default('upcoming');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
