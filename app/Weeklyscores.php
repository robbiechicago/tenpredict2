<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weeklyscores extends Model
{
    protected $table = 'weekly_scores';
    public $timestamps = false;

    public function week() {
        return $this->hasOne('App\Week', 'id', 'week_id');
    }
}
