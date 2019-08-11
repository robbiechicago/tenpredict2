@extends('layouts.layout')

@section('content')
<div class="container">

    <h1>Forum</h1>

    @auth
        @if (Auth::user()->paid)
        <div class="row">
            <div class="col-lg-12">
                {!! Form::open(array('action' => 'ForumController@store', 'method', 'POST')) !!}

                    <div class="row">
                        <div class="col-lg-12">
                            {{ Form::textarea('post', '', ['class' => 'form-control', 'placeholder' => 'Chat here...', 'rows' => 4]) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            {{ Form::submit('Submit', ['class' => 'btn btn-primary float-right']) }}
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
        @endif
    @endauth

    @foreach ($posts as $post)
    <div class="row forum-post">
        <div class="col-md-3"><strong>{{ $post->user->name }}</strong> <small>({{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_date))->diffForHumans() }})</small>&nbsp;&nbsp;</div>
        <div class="col-md-9">{!! nl2br($post->post) !!}</div>
    </div>
    @endforeach

    {{ $posts->links() }} 
</div>
@endsection
