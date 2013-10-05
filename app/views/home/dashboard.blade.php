@extends('layouts.master')

@section('content')
  <h1>Dashboard</h1>

  @foreach ($posts as $post)
    <article>
      <div>
        {{{ $post->body }}}
      </div>
      <p>Posted by {{{ $post->user->username }}}</p>
      <p>Posted at {{ $post->created_at }}</p>
    </article>
  @endforeach

@stop