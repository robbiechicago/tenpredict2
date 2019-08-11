<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    public function season() {
        return $this->belongsTo('App\Season', 'season_id', 'id');
    }

    public function games() {
        return $this->hasMany(Game::class);
    }
}
