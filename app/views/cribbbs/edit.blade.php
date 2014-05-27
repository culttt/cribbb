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

{{ Form::model($cribbb, ['route' => ['cribbbs.update', $cribbb->id],'method' => 'put']) }}
  <div>
    {{ Form::text('name', null, ['class' => 'form-control']) }}
  </div>
  <div>
    {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
  </div>
{{ Form::close() }}
