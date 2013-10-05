@extends('layouts.master')

@section('content')

  <div class="wrapper">
    <div class="flash">
      @if (Session::has('error'))
        <span class="error">{{ trans(Session::get('reason')) }}</span>
      @elseif (Session::has('success'))
        <span class="confirm">An email with the password reset has been sent.</span>
      @endif
    </div>
  </div>

  <section class="session-box">
    {{ Form::open(array('route' => 'password.request')) }}

      {{ Form::label('email', 'Email') }}
      {{ Form::text('email', null, array('class' => 'input-block')) }}

      {{ Form::submit('Submit', array('class' => 'btn')) }}

    {{ Form::close() }}
  </section>
@stop
