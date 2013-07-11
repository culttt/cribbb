@if($errors->any())
  <ul>
    {{ implode('', $errors->all('<li>:message</li>'))}}
  </ul>
@endif

{{ Form::open(array('route' => 'login.attempt')) }}

  <p>{{ Form::label('email', 'Email') }}
  {{ Form::text('email') }}</p>

  <p>{{ Form::label('password', 'Password') }}
  {{ Form::text('password') }}</p>

  <p>{{ Form::submit('Submit') }}</p>

{{ Form::close() }}