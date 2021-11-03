<?php
$css = "users"
?>
  <div class="users--content">
  <a href="/account/detail/<?= $key['id']; ?>" class="">
  <img src="<?="/images/users/" . $key['image']?>" height="512px">
    <h4>email:<?= $key['email']; ?></h4>
    <div>username: <?= $key['username']; ?></div>
    <div>firstname: <?=$key['firstname']; ?> lastname:<?= $key['lastname']; ?></div>
  </a>
</div>
