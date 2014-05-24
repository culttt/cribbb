<h1>Create a new cribbb</h1>

{{ Form::open(array('route' => 'cribbbs.store')) }}

  @if($errors->any())
  <ul>
    {{ implode('', $errors->all('<li>:message</li>'))}}
  </ul>
  @endif

  <div>
  {{ Form::label('name', 'Name') }}
  {{ Form::text('name') }}
  </div>

  {{ Form::submit('Create') }}

{{ Form::close() }}
