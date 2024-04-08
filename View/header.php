<nav class="container navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/home">
    MVC Social
    <img class="nav-logo" src="static/images/mvc_logo.png" alt="logo" />
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/home">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/profile">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/">Logout</a>
      </li>
      <input class="searchBar form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
      <button class="searchBtn  btn btn-outline-success my-2 my-sm-0">Search</button>
      <a class="navbar-brand" href="/profile">
        <?= $name ?>
        <?php
        if ($img == '') :
        ?>
          <img class="nav-logo" src="static/images/user_avatar.png" alt="logo" />
        <?php
        else :
        ?>
          <img class="nav-logo" src="static/images/<?= $img ?>" alt="user_img">
        <?php endif; ?>
      </a>
      <button class="themeBtn"><img src="static/images/theme.png" alt="theme change"></button>
    </ul>
  </div>
</nav>
