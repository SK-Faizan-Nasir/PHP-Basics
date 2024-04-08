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
      <form action="/" class="form" method="post">
        <h1 class="title">Reset Password</h1>

        <div class="inputContainer">
          <input type="email" class="input" name="email" placeholder="a" />
          <label for="email" class="label">Email</label>
        </div>
        <button name="mail" class="submitBtn">Send OTP</button>
        <input type="submit" name="submit" class="submitBtn registerBtn" value="Reset Password" />
      </form>
    </div>
  </section>
</body>
<script src="View/js/reset_script.js"></script>

</html>
