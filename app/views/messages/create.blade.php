@extends('layouts.default')

@section('content')


{{Form::open(['route' => 'messages.store'])}}
<div class="col-sm-offset-2 col-md-6">
    <h3>Create a new message</h3>
    <br>
    <!-- Subject Form Input -->
    <div class="form-group">
        {{ Form::label('subject', 'Subject', ['class' => 'control-label']) }}
        {{ Form::text('subject', null, ['class' => 'form-control']) }}
    </div>

    <!-- Message Form Input -->
    <div class="form-group">
        {{ Form::label('message', 'Message', ['class' => 'control-label']) }}
        {{ Form::textarea('message', null, ['class' => 'form-control']) }}
    </div>



    @if($users->count() > 0)
    <div class="checkbox">
        @foreach($users as $user)
            <label title="{{$user->name}}"><input type="checkbox" name="recipients[]" value="{{$user->id}}">{{$user->name}}</label>
        @endforeach
    </div>
    @endif

    <br>

    <!-- Submit Form Input -->
    <div class="form-group">
        {{ Form::submit('Submit', ['class' => 'btn btn-primary form-control']) }}
    </div>
</div>
{{Form::close()}}




@stop



