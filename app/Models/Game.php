<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $fillable = [
        'team_home', 'team_away', 'match_date', 'venue',
        'score_home', 'score_away', 'status'
    ];

    public $timestamps = true;
    const UPDATED_AT = null;

    protected $casts = [
        'match_date' => 'datetime',
    ];

    public function teamHome()
    {
        return $this->belongsTo(Team::class, 'team_home');
    }

    public function teamAway()
    {
        return $this->belongsTo(Team::class, 'team_away');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}