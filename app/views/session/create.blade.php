@extends('layouts.master')

@section('content')

  @if (Session::has('login_errors'))
    Username or password incorrect.
  @endif

  <section>
    {{ Form::open(array('route' => 'session.store')) }}

      {{ Form::label('email', 'Email') }}
      {{ Form::text('email') }}

      {{ Form::label('password', 'Password') }}
      {{ Form::password('password') }}

      {{ Form::submit('Submit') }}

      <a href="/password/reset">Forgot password?</a>

    {{ Form::close() }}
  </section>
@stop
