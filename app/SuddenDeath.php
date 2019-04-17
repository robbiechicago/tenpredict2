<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuddenDeath extends Model
{
    protected $table = 'sudden_death';
    public $timestamps = false;

    public function picks() {
        return $this->hasMany('App\SuddenDeathPicks');
    }

    public function myCurrentSdStatus($user_id) {
        $sd_id = $this->getCurrentRound();
        return $sd_id;
    }

    private function getCurrentRound() {
        $week = $this->getCurrentWeekId();
        dd($week);
    }

    private function getCurrentWeekId() {
        $week = new Week;
        return $week->current_week()->id;
    }

}
