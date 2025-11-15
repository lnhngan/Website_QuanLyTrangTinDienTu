<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'sport_type', 'country'];

    public $timestamps = false;

    public function homeGames()
    {
        return $this->hasMany(Game::class, 'team_home');
    }

    public function awayGames()
    {
        return $this->hasMany(Game::class, 'team_away');
    }
}