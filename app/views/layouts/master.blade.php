@include('partials.header')

  <div class="site-container">

    @section('sidebar')
      @include('navigation.header')
    @show

    @yield('content')
  </div>

@include('partials.footer')
