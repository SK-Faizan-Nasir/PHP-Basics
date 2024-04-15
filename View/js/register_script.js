function sendOtp(e) {
    e.preventDefault();
    let fname = $('input[name="fname"]').val();
    let lname = $('input[name="lname"]').val();
    let email = $('input[name="email"]').val();
    let password = $('input[name="password"]').val();
    let confirm = $('input[name="confirm"]').val();

    if (fname != "" && lname != "" && email!="" && password != "" && confirm != "") {
      if (
        email.match(
          /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
        ) &&
        fname.match(/^[a-z A-Z]+$/) &&
        lname.match(/^[a-z A-Z]+$/) &&
        password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/)
      ) {
        if (password == confirm) {
          alert("wait for few seconds");
          $.ajax({
            url: "Controller/ajax-register.php",
            data: {
              fname: fname,
              lname: lname,
              email: email,
              password: password,
              confirm: confirm,
            },
            type: "POST",
            success: function (result) {
              if (result == "<p class='green'>Check Mail for OTP</p>"){
                $(".signUpDiv").hide();
                $(".registerBtn").css("display", "block");
                $(".otpBtn").hide();
                $("#otp-box").css("display", "block");
              }
              $(".message").html(result);
            },
          });
        }
        else {
          alert('Password does not match.');
        }
      }
      else {
        alert("Please Fill Data as instructed!");
      }
    } else {
      alert("All fields are required!");
    }
  }

$(document).on("click", ".otpBtn", sendOtp);
