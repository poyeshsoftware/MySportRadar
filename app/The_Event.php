<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class The_Event extends Model
{
    protected $fillable = [
        'date', '_sport_id', '_team_id_1', '_team_id_2',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class, '_sport_id');
    }

    public function team_1()
    {
        return $this->hasOne(Team::class, 'id', '_team_id_1');
    }

    public function team_2()
    {
        return $this->hasOne(Team::class, 'id', '_team_id_2');
    }
}
