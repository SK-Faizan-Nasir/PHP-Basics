<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link rel="stylesheet" href="static/css/form_styles.css" />
  <script src="View/js/jquery.js"></script>
</head>

<body>
  <section class="container">
    <div class="signupFrm">
      <form action="/" class="form emailDiv" method="post">
        <h1 class="title">Reset Password</h1>
        <div class="inputContainer">
          <input type="email" class="input" name="email" placeholder="a" />
          <label for="email" class="label">Email</label>
        </div>
        <button name="mail" class="submitBtn otpBtn">Send OTP</button>
        <div class="message">
          <?php

          if ($msg != '') :
          ?>
            <p class="<?= $cls ?>"><?= $msg ?></p>
          <?php

          endif
          ?>
        </div>
      </form>
      <form action="/reset" class="form PasswordForm" method="post">
        <h1 class="title">Enter OTP</h1>
        <div class="inputContainer">
          <input type="number" maxlength="4" class="input" name="otp" placeholder="a" />
          <label for="otp" class="label">OTP</label>
        </div>
        <div class="inputContainer">
          <input type="password" class="input" name="new_password" placeholder="a" />
          <label for="new_password" class="label">New Password</label>
        </div>
        <div class="inputContainer">
          <input type="password" class="input" name="confirm_password" placeholder="a" />
          <label for="confirm_password" class="label">Confirm Password</label>
        </div>
        <input type="submit" name="submit" class="submitBtn" value="Submit" />
        <div class="message">
          <?php

          if ($msg != '') :
          ?>
            <p class="<?= $cls ?>"><?= $msg ?></p>
          <?php

          endif
          ?>
        </div>
      </form>
    </div>
  </section>
</body>
<script src="View/js/reset_script.js"></script>

</html>
