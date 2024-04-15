<?php

// Display All Post in the $res array
foreach ($res as $i){
  ?>
  <div class='post-item'>
        <div class='flex-all space-between'>
  <?php
  if (!empty($i['image_source'])) {
    ?>
    <img class='nav-logo' src='static/images/<?=$i['image_source']?>' alt='user'>
  <?php
  }
  else{
    ?>
    <img class='nav-logo' src='static/images/user_avatar.png' alt='user'>
  <?php
  }
  ?>
    <p>Posted by <?=$i['first_name']?> <?=$i['last_name']?></p>
        </div>
        <p style='text-align:right;'>at <?=$i['time']?></p>
        <p><?=$i['content']?></p>
  <?php
  if (!empty($i['image'])) {
  ?>
    <img class='post-img' src='static/images/<?=$i['image']?>' alt='TEA'>
  <?php
  }
  ?>
  </div>
<?php
}
