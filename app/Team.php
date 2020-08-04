<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name', 'id'
    ];

    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'sport_team', '_team_id', '_sport_id');
    }
}
