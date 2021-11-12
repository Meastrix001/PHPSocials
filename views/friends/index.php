<?php
$title = 'Users';
$css = 'users';
include_once BASE_DIR . '/views/_templates/_partials/header.php';
?>

<section class="users">
<?php if($friends < 0) {
echo "no users found";
} else {
  foreach($friends as $friend => $key) {
    $user = getUserById($key['follower_id']) ;
    include BASE_DIR . '/views/_templates/_partials/usersPage.php';
  }
}
   ?>
</section>
<?php 
include_once BASE_DIR . '/views/_templates/_partials/footer.php';
?>
