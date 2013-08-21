@extends('layouts.master')

@section('content')
  @if($errors->any())
    <ul>
      {{ implode('', $errors->all('<li>:message</li>'))}}
    </ul>
  @endif

  {{ Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT')) }}

    <p>{{ Form::label('username', 'Username') }}
    {{ Form::text('username', 'Username') }}</p>

    <p>{{ Form::label('email', 'Email') }}
    {{ Form::text('email', 'Email') }}</p>

    <p>{{ Form::submit('Submit') }}</p>

  {{ Form::close() }}
@stop