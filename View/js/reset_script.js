$(document).ready(function () {
  $(".PasswordForm").hide();
});

$(document).on("click", ".otpBtn", function (e) {
  e.preventDefault();
  let email = $('input[name="email"]').val();
  if (email == "") {
    alert("Fill email field first");
  }
  else {
    if (
      email.match(
        /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
      )
    ) {
      $.ajax({
        url: "Controller/ajax-reset.php",
        data: {
          email: email,
        },
        type: "POST",
        success: function (data) {
          if (data == "<p class='green'>Check Mail for OTP</p>") {
            $(".emailDiv").hide();
            $(".PasswordForm").show();
          }
          $(".message").html(result);
        },
      });
    } else {
      alert("Please enter a valid email");
    }
  }
});
