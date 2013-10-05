@extends('layouts.master')

@section('content')

  @if (Session::has('login_errors'))
    <div class="wrapper">
      <div class="flash">
        <span class="error">Username or password incorrect.</span>
      </div>
    </div>
  @endif

  <section class="session-box">
    {{ Form::open(array('route' => 'session.store')) }}

      {{ Form::label('email', 'Email') }}
      {{ Form::text('email', null, array('class' => 'input-block')) }}

      {{ Form::label('password', 'Password') }}
      {{ Form::password('password', array('class' => 'input-block')) }}

      {{ Form::submit('Submit', array('class' => 'btn')) }}

      <div class="password-reset"><a href="/password/reset" class="text-link">Forgot password?</a></div>

    {{ Form::close() }}
  </section>
@stop
