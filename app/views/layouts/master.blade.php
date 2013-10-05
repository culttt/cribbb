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
    <span>Cribbb</span>
  </headeR>

  <div class="container">
    @yield('content')
  </div>

</body>
</html>
