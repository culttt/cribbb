@if($errors->any())
  <ul>
    {{ implode('', $errors->all('<li>:message</li>'))}}
  </ul>
@endif

{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}

  <p>{{ Form::label('username', 'Username') }}
  {{ Form::text('username') }}</p>

  <p>{{ Form::label('email', 'Email') }}
  {{ Form::text('email') }}</p>

  <p>{{ Form::submit('Submit') }}</p>

{{ Form::close() }}