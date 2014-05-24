{{ Form::open(['route' => ['session.destroy'], 'method' => 'delete']) }}
  <button type="submit">Logout</button>
{{ Form::close() }}

<h1>Dashboard</h1>
<p><a href="{{ URL::route('cribbbs.create') }}">Create a new Cribbb</a></p>
