<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <link rel="stylesheet" href="static/css/user_styles.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <title>Profile</title>
</head>

<body>
  <header>
    <?php require 'View/header.php'; ?>
  </header>
  <main class="container">
    <div class="profile-view">
      <h2>Profile Overview</h2>
      <div class="dp">
        <img src="static/images/<?= $img ?>" alt="User Image">
      </div>
      <p>Name: <?= $fname ?> <?= $lname ?></p>
      <p>Email: <?= $email ?></p>
    </div>
    <div class="profile-view flex-all flex-column">
      <div class="dp">
        <img id="avatar" src="static/images/user_avatar.png" alt="avatar">
      </div>
      <label for="fname">First Name: </label>
      <input name="fname" type="text" value="<?= $fname ?>">
      <label for="lname">Last Name: </label>
      <input name="lname" type="text" value="<?= $lname ?>">
      <label for="image">Upload Image:</label>
      <input id="image" type="file" name="image" accept="image/png, image/jpeg, image/svg, image/webp">
      <button class="loadBtn">Update</button>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="View/js/profile_script.js"></script>
</body>

</html>
