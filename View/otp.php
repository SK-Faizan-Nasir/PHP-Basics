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
        <h1 class="title">Enter OTP</h1>

        <div class="inputContainer">
          <input type="otp" class="input" name="email" placeholder="a" />
          <label for="otp" class="label">OTP</label>
        </div>
        <div class="inputContainer">
          <input type="otp" class="input" name="new_password" placeholder="a" />
          <label for="otp" class="label">New Password</label>
        </div>
        <div class="inputContainer">
          <input type="otp" class="input" name="confirm_password" placeholder="a" />
          <label for="otp" class="label">Confirm Password</label>
        </div>
        <input type="submit" name="submit" class="submitBtn" value="Submit" />
      </form>
    </div>
  </section>
</body>

</html>
