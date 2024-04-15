let offset = 3;

function checkDark() {
  if (localStorage.getItem("isDarkMode") === "true") {
    document.body.classList.add("dark-mode");
  }
}

$(document).ready(checkDark);

function createPost() {
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
        if (data != "1") {
          alert("Error Encountered Try Again!");
        }
        else {
          location.reload();
        }

      },
      error: function () {
        alert("error");
      },
    });
  }
  else {
    alert("Enter content to post");
  }
}

$(document).on("click", ".post-btn", createPost);

function defaultLoad() {
  $.ajax({
    url: "Controller/ajax-defaultload.php",
    type: "POST",
    success: function (data) {
      $(".post-container").val();
      $(".post-container").append(data);
    },
  });
}

$(window).on("load", defaultLoad);

function search() {
  if (window.location.href == "http://mvc.in/home"){
    let search_term = $(".searchBar").val();
    if (search_term != '') {
      $.ajax({
        url: "Controller/ajax-search.php",
        type: "POST",
        data: {
          search: search_term,
        },
        success: function (data) {
          $(".searchBar").val("");
          $(".post-container").html(data);
        },
      });
    }
    else {
      alert("Enter a term to search!");
    }
  }
  else {
    alert("Go to home page to implement search!");
  }
}

$(document).on("click", ".searchBtn", search);

function loadMoreData() {
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
}

$(document).on("click", ".loadBtn", loadMoreData);

function changeTheme() {
  $("body").toggleClass("dark-mode");
  if (localStorage.getItem("isDarkMode") === "true") {
    localStorage.setItem("isDarkMode", false);
  }
  else {
    localStorage.setItem("isDarkMode", true);
  }
}

$(document).on("click", ".themeBtn", changeTheme);

