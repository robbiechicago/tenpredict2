@extends('layouts.layout')

@section('content')
<div class="container-fluid">

    <h1>Admin Page, Bitches!</h1>

    <a href="admin/add_weekly_score_rank/" class="btn btn-warning btn-sm">ranker</a>

    <br /><br />

    Tick tock:  <span id="admin-clock"></span>

    <br /><br />

    <h2>Weeks</h2>

    <div class="row">
        <div class="col-md-6">

        
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Week ID</th>
                        <th>Week Num</th>
                        <th>Play Week Num</th>
                        <th>Num fixtures</th>
                        <th>Missing Abbrv</th>
                        <th>Calc Scores</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seasons as $season)
                        @foreach ($season->weeks as $week)
                            @php
                            $fixtures = count($week->games);
                            $calc_btn = $fixtures < 10 ? '' : '<a href="admin/calc_weekly_scores/' . $week->id . '" class="btn btn-info btn-sm">Calc</a>';
                            $missing_abbrv = 0;
                            foreach ($games as $game) {
                                if ($game->week_id == $week->id) {
                                    if ($game->home_abbrv == NULL) {
                                        $missing_abbrv++;
                                    }
                                    if ($game->away_abbrv == NULL) {
                                        $missing_abbrv++;
                                    }
                                }
                            }
                            if ($missing_abbrv == 0) {
                                $missing_abbrv_link = '';
                            } else {
                                $missing_abbrv_link = '<a href="admin/missing_abbrv/'.$week->id.'">'.$missing_abbrv.'</a>';
                            }
                            @endphp
                            <tr>
                                <td>{{ $week->id }}</td>
                                <td>{{ $week->week_num }}</td>
                                <td>{{ $week->play_week_num }}</td>
                                <td>{{ $fixtures }}</td>
                                <td>{!! $missing_abbrv_link !!}</td>
                                <td>{!! $calc_btn !!}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="col-md-6">

            <h2>Users</h2>

            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Paid</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->paid }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    {{-- <h2>Seasons</h2>

    @foreach ($seasons as $season)
        <h2>{{ $season->season }}</h2>
        @if($season->weeks->count() > 0))
            <ul>
            @foreach($season->weeks as $week)
                <li>{{ $week->week_num }}</li>
            @endforeach
            </ul>
        @else
            {!! Form::open(['action' => ['AdminController@create_weeks'], 'method' => 'POST']) !!}
                @csrf
                {{ Form::hidden('season_id', $season->id) }}
                {{ Form::submit('Create weeks?', ['class' => 'btn btn-primary']) }}
            {!! Form::close() !!}
        @endif
    @endforeach --}}





</div>

@endsection

@section('js')
<script src="{{ asset('js/moment.js') }}" defer></script>
<script src="{{ asset('js/clock.js') }}" defer></script>
@endsection