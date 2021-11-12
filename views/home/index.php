<?php 
$title = 'Home';
$css = 'home';
include_once BASE_DIR . '/views/_templates/_partials/header.php';
global $loggedIn_user;

?>
  <?php if ($loggedIn_user) : ?>

  <form class="create--post" method="post" enctype="multipart/form-data">
    <input type="text" name="description" maxlenght="128" value='<?php echo $post->description ?? ''; ?>' required>
    <input type="file" name="file" id="file">
    <input type="submit" value="Post it!" name="create_post">
  </form>

<?php endif; ?>
<section class="home--posts">
  <?php if (count($posts) > 0) : "";?>
  <?php foreach($posts as $post => $postKey) :?>
  <?php 
  $comments = null;
  $comments = getAllComments($postKey['id']);
  ?>
  <?php foreach($comments as $comment => $commentKey) :?>
  <?php endforeach?>
  <?php require BASE_DIR . '/views/_templates/_partials/postsPage.php' ?>
  <?php endforeach?>
  <?php endif; ?>

</section>
<?php include_once BASE_DIR . '/views/_templates/_partials/footer.php'; ?>