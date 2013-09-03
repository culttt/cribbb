<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cribbb</title>
  <?= stylesheet_link_tag() ?>
  <?= javascript_include_tag() ?>
</head>
<body>

  <nav>
    <ul>
      <li><a href="/post/create">New post</a></li>
    </ul>
  </nav>

  <div class="container">
    @yield('content')
  </div>

</body>
</html>
