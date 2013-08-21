@extends('layouts.master')

@section('content')
  @if($errors->any())
    <ul>
      {{ implode('', $errors->all('<li>:message</li>'))}}
    </ul>
  @endif

  {{ Form::model($post, array('route' => array('post.update', $post->id), 'method' => 'PUT')) }}

    <p>{{ Form::label('body', 'Body') }}
    {{ Form::text('body', 'Body') }}</p>

    <p>{{ Form::submit('Submit') }}</p>

  {{ Form::close() }}
@stop