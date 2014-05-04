{{ Form::open(array('route' => 'register.store')) }}

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
  {{ Form::text('username') }}
  </div>

  <div>
  {{ Form::label('password', 'Password') }}
  {{ Form::text('password') }}
  </div>

  {{ Form::submit('Complete') }}

{{ Form::close() }}
