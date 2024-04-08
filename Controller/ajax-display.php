<?php

foreach ($res as $i) {
  echo "
  <div class='post-item'>
        <div class='flex-all space-between'>";
  if (!empty($i['image_source'])) {
    echo "<img class='nav-logo' src='static/images/{$i['image_source']}' alt='user'>";
  }
  else{
    echo "<img class='nav-logo' src='static/images/user_avatar.png' alt='user'>";
  }
  echo "<p>Posted by {$i['first_name']} {$i['last_name']}</p>
        </div>
        <p style='text-align:right;'>at {$i['time']}</p>
        <p>{$i['content']}</p>";
  if (!empty($i['image'])) {
    echo "<img class='post-img' src='static/images/{$i['image']}' alt='TEA'>";
  }
  echo "</div>";
}
