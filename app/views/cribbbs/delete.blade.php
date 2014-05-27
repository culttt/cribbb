<div> Are you sure you want to delete {{ $cribbb->name }}?</div>

{{ Form::open(['route' => ['cribbbs.destroy', $cribbb->id], 'method' => 'delete']) }}
  <input type="submit" value="Delete">
{{ Form::close() }}
