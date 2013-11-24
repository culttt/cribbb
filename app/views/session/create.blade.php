@extends('layouts.master')

@section('content')

  @if (Session::has('login_errors'))
    <div class="flash flash-error">
      Username or password incorrect.
    </div>
  @endif

  <div class="auth-form">
    <div class="auth-form-header">
      <h1>Sign in</h1>
    </div>
    <div class="auth-form-body">
      {{ Form::open(array('route' => 'session.store')) }}

        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', null, array('class' => 'email', 'autocorrect' => 'off', 'autocapitalize' => 'off')) }}

        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', array('class' => 'password')) }}

        {{ Form::submit('Sign in', array('class' => 'submit button button-green')) }}

        <p><a href="/password/reset">Forgot password?</a></p>

      {{ Form::close() }}
    </div>
  </div>

@stop
