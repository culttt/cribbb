@extends('layouts.master')

@section('content')

  <div>
    <div>
      @if (Session::has('error'))
        <span>{{ trans(Session::get('reason')) }}</span>
      @elseif (Session::has('success'))
        <span>An email with the password reset has been sent.</span>
      @endif
    </div>
  </div>

  <section>
    {{ Form::open(array('route' => 'password.request')) }}

      {{ Form::label('email', 'Email') }}
      {{ Form::text('email') }}

      {{ Form::submit('Submit') }}

    {{ Form::close() }}
  </section>
@stop
