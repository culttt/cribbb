@extends('layouts.master')

@section('content')

  @if (Session::has('error'))
    <div class="wrapper">
      <div class="flash">
        <span class="error">{{ trans(Session::get('reason')) }}</span>
      </div>
    </div>
  @endif

  <section class="session-box">
    {{ Form::open(array('route' => array('password.update', $token))) }}

      <p>{{ Form::label('email', 'Email') }}
      {{ Form::text('email', null, array('class' => 'input-block')) }}</p>

      <p>{{ Form::label('password', 'Password') }}
      {{ Form::text('password', array('class' => 'input-block')) }}</p>

      <p>{{ Form::label('password_confirmation', 'Password confirm') }}
      {{ Form::text('password_confirmation', array('class' => 'input-block')) }}</p>

      {{ Form::hidden('token', $token) }}

      <p>{{ Form::submit('Submit', array('class' => 'btn')) }}</p>

    {{ Form::close() }}
  </section>
@stop
