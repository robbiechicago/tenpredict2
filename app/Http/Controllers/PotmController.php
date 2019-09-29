<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Week;
use App\Season;
use App\Weeklyscores;
use App\Traits\LeagueTrait;

class PotmController extends Controller
{
    use LeagueTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //GET LATEST MONTH
        $latest_completed_week_id = Weeklyscores::max('week_id');
        $season_id = Week::where('id', $latest_completed_week_id)->value('season_id');
        $season = Season::where('id', $season_id)->value('season');
        $latest_month = Week::where('id', $latest_completed_week_id)->value('month');

        return redirect('/potm/' . $season . '/' . $latest_month);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($season, $month)
    {
        $totScores = $this->get_potm_positions($season, $month);

        $months = [
            'jan' => 'January',
            'feb' => 'February',
            'mar' => 'March',
            'apr' => 'April',
            'may' => 'May',
            'jun' => 'June',
            'jul' => 'July',
            'aug' => 'August',
            'sep' => 'September',
            'oct' => 'October',
            'nov' => 'November',
            'dec' => 'December',
        ];

        return view('potm', [
            'totScores' => $totScores,
            'month' => $month,
            'months' => $months,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
