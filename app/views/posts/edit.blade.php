@if($errors->any())
  <ul>
    {{ implode('', $errors->all('<li>:message</li>'))}}
  </ul>
@endif

{{ Form::model($post, array('route' => array('posts.update', $post->id), 'method' => 'PUT')) }}

  <p>{{ Form::label('body', 'Body') }}
  {{ Form::textarea('body') }}</p>

  <p>{{ Form::submit('Submit') }}</p>

{{ Form::close() }}