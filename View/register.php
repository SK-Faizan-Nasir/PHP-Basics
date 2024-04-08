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
      <form action="/register" class="form" method="post" enctype="multipart/form-data">
        <h1 class="title">Sign up</h1>

        <div class="signUpDiv">
          <div class="inputContainer">
            <input type="text" class="input" name="fname" placeholder="a" pattern="^[a-z A-Z]+$" required />
            <label for="fname" class="label">First Name</label>
          </div>

          <div class="inputContainer">
            <input type="text" class="input" name="lname" placeholder="a" pattern="^[a-z A-Z]+$" required />
            <label for="lname" class="label">Last Name</label>
          </div>

          <div class="inputContainer">
            <input type="email" class="input" name="email" placeholder="a" required />
            <label for="email" class="label">Email</label>
          </div>

          <div class="inputContainer">
            <input type="password" class="input" name="password" placeholder="a" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" required />
            <label for="password" class="label">Password</label>
          </div>

          <div class="inputContainer">
            <input type="password" class="input" name="confirm" placeholder="a" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" required />
            <label for="confirm" class="label">Confirm Password</label>
          </div>
        </div>

        <div class="inputContainer" id="otp-box">
          <input type="text" class="input" name="otp" placeholder="a" pattern="^\d{4}$" required />
          <label for=" otp" class="label">OTP</label>
        </div>

        <div class="message">
          <?php
          if ($msg != '') {
          ?>
            <p class="<?= $cls ?>"><?= $msg ?></p>
          <?php
          }
          ?>
        </div>


        <div class="flex-all flex-between">
          <a href="/" id="loginBtn" class="submitBtn">Login</a>
          <button class="otpBtn submitBtn">Get OTP</button>
          <input type="submit" name="submit" class="submitBtn registerBtn" value="Sign up" />
        </div>
      </form>
    </div>
  </section>
</body>
<script src="View/js/register_script.js"></script>

</html>
