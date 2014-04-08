{{ Form::open(array('route' => 'invite.store')) }}

  <div>
  {{ Form::label('email', 'Email Address') }}
  {{ Form::text('email') }}
  </div>

  {{ Form::submit('Submit') }}

{{ Form::close() }}
