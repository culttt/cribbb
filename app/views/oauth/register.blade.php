{{ Form::open(array('route' => 'oauth.store')) }}

  @if($errors->any())
    <ul>
      {{ implode('', $errors->all('<li>:message</li>'))}}
    </ul>
  @endif

  <div>
  {{ Form::label('email', 'Email Address') }}
  {{ Form::text('email') }}
  </div>

  {{ Form::submit('Complete') }}

{{ Form::close() }}
