<?php
$userObj = getUserById($postKey['users_id']);
global $loggedIn_user;
if(isset($comments)){
  foreach ($comments as $comment => $commentKey);
}
?>
  <div class="posts--content">
    <div>
      <a href="/posts/detail/<?= $postKey['id']; ?>" class="">
      <h4><?= $postKey['description']; ?></h4>
    </a>
  </div>
  <img src="<?="/images/posts/" . $postKey['media']?>" height="512px">
  <div>
      <a href="/account/detail/<?= $userObj->id; ?>" class="">
        <div class="posts--content--bottom">
          <p>posted by: <?=$userObj->username ?></p>
          <p>posted on: <?= $postKey['created_on']; ?></p>
          <?php if ($loggedIn_user) : "";?>
            <?php if ($loggedIn_user->username === $userObj->username) : "";?>

            <a  href="/posts/deletePost/<?=$postKey['id']?>" class="warned">Delete</a>
            <?php endif; ?>
          <?php endif; ?>

          <?php if (count($comments)) : "";?>
            <?php if ( count($comments) === 1) : "";?>
              <p><a href="/posts/detail/<?=$postKey['id']?>">1 comment</a></p>  
            <?php elseif (count($comments) !== 0) : ""?>
              <p><a href="/posts/detail/<?=$postKey['id']?>"><?=count($comments) . " comments";?></a></p>
              <?php endif; ?>
              <?php else :?>
                <p>No comment yet</p>
          <?php endif; ?>
        </div>
    </a>
  </div>
</div>
