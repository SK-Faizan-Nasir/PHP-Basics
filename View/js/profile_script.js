function checkDark() {
  if (localStorage.getItem("isDarkMode") === "true") {
    document.body.classList.add("dark-mode");
  }
}

$(document).ready(checkDark);

function setAvatar(e) {
  if (e.target.files.length == 0) {
    return;
  }
  let file = e.target.files[0];
  let url = URL.createObjectURL(file);
  document.querySelector("#avatar").src = url;
}

document.querySelector("#image").addEventListener("change", setAvatar);

function changeTheme() {
  $("body").toggleClass("dark-mode");
  if (localStorage.getItem("isDarkMode") === "true") {
    localStorage.setItem("isDarkMode", false);
  } else {
    localStorage.setItem("isDarkMode", true);
  }
}

$(document).on("click", ".themeBtn", changeTheme);

function updateProfile() {
  let fname = $('input[name="fname"]').val();
  let lname = $('input[name="lname"]').val();

  if (fname == "" || lname == "") {
    alert("Fill the fields to submit!");
  } else {
    let fd = new FormData();
    let files = $("#image")[0].files[0];
    fd.append("file", files);
    fd.append("fname", fname);
    fd.append("lname", lname);
    $.ajax({
      url: "Controller/ajax-update.php",
      type: "POST",
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        location.reload();
      },
      error: function () {
        alert("error");
      },
    });
  }
}

$(document).on("click", ".loadBtn", updateProfile);
