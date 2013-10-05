<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cribbb</title>
  <?= stylesheet_link_tag() ?>
  <?= javascript_include_tag() ?>
</head>
<body>

  <header>
    <a href="/"><h1>Cribbb</h1></a>
      <nav>
        <a href="/login" class="btn">Login</a>
      </nav>
  </header>

  <div class="container">
    @yield('content')
  </div>

</body>
</html>
