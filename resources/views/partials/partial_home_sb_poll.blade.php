<div class="col-md-12 poll-container">
    <div class="poll-inner-div">
        <h3 id="poll-title" data-csrf="{{ csrf_token() }}">Poll</h3>
        <h6><em>{{ $poll->title }}</em></h6>

        <hr>
        
        @php
        $voted = false;   
        $tot_votes = 0;
        
        foreach ($poll->answers as $ans) {
            $tot_votes += count($ans->votes);
            if (count($ans->votes) > 0) {
                foreach ($ans->votes as $vote) {
                    if ($vote->user_id == Auth::id()) {
                        $voted = true;
                    }
                }
            }
        }
        @endphp

        @foreach ($poll->answers as $answer)

            @php
                if (count($answer->votes) == 0) {
                    $vote_percent = 0;
                } else {
                    $vote_percent = round((count($answer->votes) / $tot_votes) * 100);
                }
            @endphp
            
            @if ($loop->index == 0 || $loop->index % 2 == 0)
                <div class="row"> 
            @endif

                <div class="col-xl-6">
                    @if ($voted)
                        <div>
                            {{ $answer->answer }}
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: {{ $vote_percent }}%" aria-valuenow="{{ $vote_percent }}" aria-valuemin="0" aria-valuemax="100">{{ count($answer->votes) > 0 ? $vote_percent . '%' : '' }}</div>
                        </div>
                    @else
                    <label>{{ Form::radio('poll_' . $poll->id, $answer->id, '', ['class' => 'poll-radio']) }}&nbsp;{{ $answer->answer }}</label>
                    @endif
                </div>

            @if ($loop->index % 2 != 0 || $loop->last)
                </div>
            @endif

        @endforeach
        
        <hr>

        <button id="poll-submit" class="btn btn-warning border-dark float-right" style="visibility: hidden;">Vote!</button>
        <div style="clear: both;"></div>
    </div>
</div> 