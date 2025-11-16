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
    // Tên bảng là 'games' (số nhiều của Game)
    Schema::create('games', function (Blueprint $table) {
        $table->id();
        
        // Khóa ngoại tới bảng 'teams'
        $table->foreignId('team_home')->constrained('teams')->onDelete('cascade');
        $table->foreignId('team_away')->constrained('teams')->onDelete('cascade');
        
        $table->dateTime('match_date');
        $table->string('venue', 150)->nullable();
        $table->integer('score_home')->nullable();
        $table->integer('score_away')->nullable();
        $table->enum('status', ['upcoming','ongoing','finished'])->default('upcoming');
        
        // File SQL của bạn CÓ 'created_at'
        $table->timestamp('created_at')->nullable()->default(now());
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
