{{ Form::open(array('route' => 'session.store')) }}

  <h1>Sign in</h1>

  @if (Session::has('error'))
    <div>{{ Session::get('error') }}</div>
  @endif

  <div>
  {{ Form::label('email', 'Email') }}
  {{ Form::text('email') }}
  </div>

  <div>
  {{ Form::label('password', 'Password') }}
  {{ Form::text('password') }}
  </div>

  {{ Form::submit('Sign in') }}

{{ Form::close() }}
