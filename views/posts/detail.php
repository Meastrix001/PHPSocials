<?php 
$css = "home";
$css2 = "account";
$userObj = getUserById($post->users_id);
$title = "post details";
include_once BASE_DIR . '/views/_templates/_partials/header.php';
?>
  <div class="posts--content">
    <div>
      <a href="/posts/detail/<?= $post->id; ?>">
      <h4><?= $post->description; ?></h4>
    </a>
  </div>
  <img src="<?="/images/posts/" . $post->media?>" height="512px">
  <div>
      <a href="/account/detail/<?= $post->users_id; ?>">
        <div class="posts--content--bottom">
          <p class="text_white">posted by: <?=$userObj->username ?></p>
          <p class="text_white">posted on: <?= $post->created_on; ?></p> 
        </div>
    </a>
    <div class="posts--content--bottom">

    <?php if($comments < 0) {
      echo "no users found";
      } else {
        foreach($comments as $comment => $commentKey) {
          require BASE_DIR . '/views/_templates/_partials/comments.php';
        }
      }
   ?>
          <?php if (isset($loggedIn_user)) : "";?>
              <form class="account--details--form" method="post">
                  <input type="text" id="message" name="message" maxlenght="128" value='<?php echo $comment->message ?? ''; ?>' required>
                  <input type="submit" value="Post it!" name="create_message">
              </form>
          <?php elseif (!isset($loggedIn_user)): ""?>
            <p>please log in to place comments</p>
          <?php endif; ?>
          <?php if ($loggedIn_user->username === $userObj->username) : "";?>

<a class="warned" href="/posts/deletePost/<?=$postKey['id']?>" class="warned">Delete</a>
<?php endif; ?>
    </div>
  </div>
</div>

<?php include_once BASE_DIR . '/views/_templates/_partials/footer.php'; ?>
