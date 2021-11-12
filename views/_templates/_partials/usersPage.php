<?php
$css = "users";
?>
<div class="users--content">
  <a href="/account/detail/<?= $key['id'] ?? $user->id; ?>" class="">
    <img src="/images/users/<?=$key['image'] ?? $user->image;?>" height="512px">
    <div> <p class="text_white"> username: <?= $key['username'] ?? $user->username; ?></p></div>
    <div> <p class="text_white"> firstname: <?= $key['firstname'] ?? $user->firstname; ?></p><p class="text_white">lastname:<?= $key['lastname'] ?? $user->lastname; ?></p></div>
  </a>
</div>
