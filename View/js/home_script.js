let offset = 3;
let dark = false;

$(document).on("click", ".post-btn", function () {
  let content = $("#post-content").val();
  let file = $("#post-upload")[0].files[0];
  if (content != "") {
    let fd = new FormData();
    fd.append("file", file);
    fd.append("text", content);
    $.ajax({
      url: "Controller/ajax-post.php",
      type: "POST",
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        $("#post-content").val('');
        $("#post-upload").val('');
        if (data == "0") {
          alert("Error Encountered Try Again!");
        }
        location.reload();

      },
      error: function () {
        alert("error");
      },
    });
  }
  else {
    alert("Enter content to post");
  }
});

$(window).on("load", function () {
  $.ajax({
    url: "Controller/ajax-defaultload.php",
    type: "POST",
    success: function (data) {
      $(".post-container").val();
      $(".post-container").append(data);
    },
  });
});

$(document).on("click", ".searchBtn", function () {
  if (window.location.href == "http://mvc.in/home"){
    let search_term = $(".searchBar").val();
    $.ajax({
      url: 'Controller/ajax-search.php',
      type: 'POST',
      data: {
        search: search_term
      },
      success: function (data) {
        $(".searchBar").val('');
        $(".post-container").html(data);
      }
    });
  }
  else {
    alert("Go to home page to implement search!");
  }
});

$(document).on("click", ".loadBtn", function () {
  $.ajax({
    url: "Controller/ajax-load.php",
    type: "POST",
    data: {
      offset: offset
    },
    success: function (data) {
      if (data == '') {
        alert('No more posts!');
      }
      else {
        $(".post-container").append(data);
        offset += 3;
      }
    },
  });
});

$(document).on("click", ".themeBtn", function () {
  if (dark) {
    $('body').css('background-color','lightcyan');
    $('body').css('color','black');
  }
  else {
    $("body").css("background-color", "black");
    $("body").css("color", "white");
  }
  dark = !dark;
});
