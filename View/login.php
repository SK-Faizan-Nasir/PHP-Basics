<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link rel="stylesheet" href="static/css/form_styles.css" />
</head>

<body>
  <section class="container">
    <div class="signupFrm">
      <form action="/" class="form" method="post">
        <h1 class="title">Log in</h1>
        <?php if ($msg != ''):?>
        <p class="<?=$cls?>"><?=$msg?></p>
        <?php endif; ?>
        <div class="inputContainer">
          <input type="email" class="input" name="email" placeholder="a" />
          <label for="email" class="label">Email</label>
        </div>

        <div class="inputContainer">
          <input type="password" class="input" name="password" placeholder="a" />
          <label for="password" class="label">Password</label>
        </div>

        <div class="flex-all flex-between">
          <a href="/register" id="loginBtn" class="submitBtn">Sign Up</a>
          <input type="submit" name="submit" class="submitBtn" value="Log in" />
        </div>
        <a href="<?php
        echo $google->authUrl();
        $google->authenticate();
        ?>"><img class="googleBtn" src="static/images/google_signin.png" alt="Google Sign In"></a>
        <a href="/reset" id="loginBtn" class="submitBtn">Forgot Password</a>
      </form>
    </div>
  </section>
</body>
</html>
