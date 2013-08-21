@extends('layouts.master')

@section('content')
  @if (Session::has('login_errors'))
    <span class="error">Username or password incorrect.</span>
  @endif

  {{ Form::open(array('route' => 'session.store')) }}

    <p>{{ Form::label('email', 'Email') }}
    {{ Form::text('email') }}</p>

    <p>{{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}</p>

    <p>{{ Form::submit('Submit') }}</p>

  {{ Form::close() }}
@stop