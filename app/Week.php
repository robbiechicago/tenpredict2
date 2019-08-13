<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Week extends Model
{
    public function season() {
        return $this->belongsTo('App\Season', 'season_id', 'id');
    }

    public function games() {
        return $this->hasMany(Game::class);
    }

    public function current_week() {
        $season_id = Season::where('current', 1)->value('id');
        $weeks = $this->where('season_id', $season_id)->where('active', 1)->get();
        
        $now = Carbon::now()->toDateTimeString();
        $current_week = false;
        foreach ($weeks as $week) {
            $week_monday = Carbon::parse($week->week_saturday)->subDays(5)->toDateString();
            $week_sunday = Carbon::parse($week->week_saturday)->addDays(1)->toDateString();
            if ($now > Carbon::parse($week_monday)->startOfDay() && $now < Carbon::parse($week_sunday)->endOfDay()) {
                $current_week = $week;
            }
        }
        return $current_week;
    }
}
