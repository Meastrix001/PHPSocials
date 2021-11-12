<?php 
global $loggedIn_user;
$title = 'Users';
$css = 'account';
$css2 = 'posts';
$isFriend = null;
$isFriend = checkIfFriends($user->id);
include_once BASE_DIR . '/views/_templates/_partials/header.php';
?>
<div class="account--details">
  <figure>
    <img src="<?="/images/users/" . $user->image?>" height="512px">
  </figure>
    <div>
      <section class="account--details--followers">
        <p class="text_white">email: <?= $user->email; ?></p>
        <p class="text_white">username: <?= $user->username; ?></p>
        <p class="text_white"><span><?=count($following)?></span> following <span><?=count($followers)?></span> followers</p>
      </section>
      <section>
        <p class="text_white">firstname: <?=$user->firstname; ?></p>
        <p class="text_white">lastname: <?= $user->lastname; ?></p>

        <?php if ($loggedIn_user) : "";?>
            
          <p><a href="/account/updateInfo/<?=$user->id;?>" class="text_white">Update info</a></p>

        <?php endif?>

      </section>
      <?php if ($loggedIn_user) : "";?>

        <?php if ($loggedIn_user->email === $user->email) : ?>
          <section>
        
            <?php if ( $loggedIn_user->username === $user->username )?>

              <?php if (empty($isFriend)) : "";?>
                <form class="account--details--form" method="post" >
                  <input class="message--hidden" name="user_id" value="<?=$user->id?>">
                  <input type="submit" value="Follow" class="text_blue unliked " name="follow_user">
                </form>

              <?php else : ""?>
                <form class="account--details--form" method="post" >
                  <input class="message--hidden" name="user_id" value="<?=$user->id?>">
                  <input type="submit" value="Unfollow" class="text_blue liked" name="unFollow_user">
                </form>

              <?php endif?>


            <form class="account--details--form text_white " method="post" >
              <input type="submit" value="Log out" class="text_white" name="log_out">
            </form>
            
            <form class="account--details--form" method="post" >
              <input class="message--hidden" name="user_id" value=<?=$user->id?>>
              <input type="submit" value="Delete account" class="warned deleteButton" name="delete_account">
            </form>
        
          </section>
        <?php endif; ?>
      <?php endif; ?>
  </div>
</div>
</div>
<div class="posts--posts">

<?php if(count($posts) < 0) {
  } else {
    foreach($posts as $post => $postKey) {
      require BASE_DIR . '/views/_templates/_partials/postsPage.php';
    }
  }
?>
</div>
<?php 
include_once BASE_DIR . '/views/_templates/_partials/footer.php';
?>
