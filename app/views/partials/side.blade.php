<aside class="sidebar">

<div class="media user-card">
  <img src="{{{ $user->gravatar() }}}" class="media__image user-card__avatar">
  <div class="media__body user-card__username">{{{ $user->username }}}</div>
</div>

  <nav class="navigation">
    <ul>
      @foreach ($cribbbs as $cribbb)
        <li>{{{ $cribbb }}}</li>
      @endforeach
    </ul>
  </nav>
</aside>
