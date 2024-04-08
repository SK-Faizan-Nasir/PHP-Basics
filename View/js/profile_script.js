let dark = false;

document.querySelector("#image").addEventListener("change", function (e) {
  if (e.target.files.length == 0) {
    return;
  }
  let file = e.target.files[0];
  let url = URL.createObjectURL(file);
  document.querySelector("#avatar").src = url;
});

$(document).on("click", ".themeBtn", function () {
  if (dark) {
    $("body").css("background-color", "lightcyan");
    $("body").css("color", "black");
  } else {
    $("body").css("background-color", "black");
    $("body").css("color", "white");
  }
  dark = !dark;
});

$(document).on("click", ".loadBtn", function () {
  let fname = $('input[name="fname"]').val();
  let lname = $('input[name="lname"]').val();

  if (fname == "" || lname == "") {
    alert("Fill the fields to submit!");
  }
  else {
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
});
