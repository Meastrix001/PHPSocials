<?php 
$title = 'Users';
$css = 'users';
include_once BASE_DIR . '/views/_templates/_partials/header.php';
?>
users page
<div class="users--content">
  <a href="detail.php?id=<?=$user['id']?>">
  <img src="<?="/images/" . $user['image']?>" height="512px">
    <h4>email:<?= $user['email']; ?></h4>
    <div>username: <?= $user['username']; ?></div>
    <div>firstname: <?=$user['firstname']; ?> lastname:<?= $user['lastname']; ?></div>
  </a>
  
</div>

<?php 
include_once BASE_DIR . '/views/_templates/_partials/footer.php';
?>
