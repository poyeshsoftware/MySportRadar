<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $fillable = [
        'name', 'id'
    ];

    public function events()
    {
        return $this->hasMany(TheEvent::class)->orderBy('date', 'desc');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'sport_team', '_sport_id', '_team_id')->orderBy('id', 'desc');
    }
}
