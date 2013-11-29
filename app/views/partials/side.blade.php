<aside class="sidebar">

<div class="media user-card">
  <img src="{{{ $user->gravatar() }}}" class="media__image user-card__avatar">
  <div class="media__body user-card__username">{{{ $user->username }}}</div>
</div>

  <nav class="navigation site-navigation">
    <ul>
      <li><a href="#">Feed</a></li>
      <li><a href="#">Profile</a></li>
      <li><a href="#">Following</a></li>
      <li><a href="#">Favourites</a></li>
    </ul>
  </nav>

  <nav class="navigation cribbbs-list">
    <span class="navigation__title">Your Cribbbs</span>
    <ul>
      @foreach ($cribbbs as $cribbb)
        <li><a href="#">{{{ $cribbb }}}</a></li>
      @endforeach
    </ul>
  </nav>
</aside>
