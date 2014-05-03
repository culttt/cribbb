{{ Form::open(array('route' => 'invite.store')) }}

  @if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
  @endif

  @if($errors->any())
  <div>
    <ul>
      {{ implode('', $errors->all('<li>:message</li>'))}}
    </ul>
  </div>
  @endif

  <div>
  {{ Form::label('email', 'Email Address') }}
  {{ Form::text('email') }}
  </div>

  {{ Form::submit('Submit') }}

{{ Form::close() }}
