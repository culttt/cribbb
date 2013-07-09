@if($errors->any())
  <ul>
    {{ implode('', $errors->all('<li>:message</li>'))}}
  </ul>
@endif

{{ Form::open(array('route' => 'users.store')) }}

  <p>{{ Form::label('username', 'Username') }}
  {{ Form::text('username') }}</p>

  <p>{{ Form::label('email', 'Email') }}
  {{ Form::text('email') }}</p>

  <p>{{ Form::label('password', 'Password') }}
  {{ Form::text('password') }}</p>

  <p>{{ Form::label('password_confirmation', 'Password confirm') }}
  {{ Form::text('password_confirmation') }}</p>

  <p>{{ Form::submit('Submit') }}</p>

{{ Form::close() }}