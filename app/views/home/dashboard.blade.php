@extends('layouts.master')

@section('content')
  <h1>Dashboard</h1>

  @foreach ($posts as $post)
      <div>{{ $post->body }}</div>
  @endforeach

@stop