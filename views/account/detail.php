<?php 
$title = 'Users';
$css = 'account';
$css2 = 'posts';
global $loggedIn_user;
include_once BASE_DIR . '/views/_templates/_partials/header.php';
$_F
?>
<div class="account--details">
  <figure>
    <img src="<?="/images/users/" . $user->image?>" height="512px">
  </figure>
  <div>
    <section>
      <p class="text_white">email: <?= $user->email; ?></p>
      <p class="text_white">username: <?= $user->username; ?></p>
    </section>
    <section>
      <p class="text_white">firstname: <?=$user->firstname; ?></p>
      <p class="text_white">lastname: <?= $user->lastname; ?></p>
    </section>
  <?php if ($loggedIn_user->email === $user->email) : ?>
    <section>
      <p><a class="text_white" href="/account/logout">Log out</a></p>
      <p ><a href="/account/updateInfo/<?=$user->id;?>" class="text_white">Update info</a></p>
      <p class="warned"><a class="warned"href="/account/deleteUser/<?=$user->id;?>">Delete account</a></p>
    </section>
    <?php endif; ?>
  </div>
  <?php if ($loggedIn_user->email === $user->email) : ?>

    <form class="account--details--form" method="post" enctype="multipart/form-data">
      <input type="text" name="description" maxlenght="128" value='<?php echo $post->description ?? ''; ?>' required>
      <input type="file" name="file" id="file"><br><br>
      <input type="submit" value="Post it!" name="create_post">
    </form>

<?php endif; ?>
</div>
</div>
<div class="posts--posts">

<?php if(count($posts) < 0) {
  echo "you have no posts";
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
