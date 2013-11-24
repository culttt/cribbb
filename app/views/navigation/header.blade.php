<header>
  <nav>
    @if (Auth::check())
      {{{ $user->username }}}
    @else
      <a href="/login" class="button button-grey">Sign in</a>
    @endif
  </nav>
</header>
