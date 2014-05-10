{{ Form::open(array('route' => 'authenticate.store')) }}

  @if($errors->any())
    <ul>
      {{ implode('', $errors->all('<li>:message</li>'))}}
    </ul>
  @endif

  <div>
  {{ Form::label('email', 'Email Address') }}
  {{ Form::text('email') }}
  </div>

  <div>
  {{ Form::label('username', 'Username') }}
  {{ Form::text('username', $username) }}
  </div>

  {{ Form::submit('Complete') }}

{{ Form::close() }}
