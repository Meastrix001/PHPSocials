<?php 
$title = 'Home';
$css = 'home';
include_once BASE_DIR . '/views/_templates/_partials/header.php';
shuffle($posts);
global $loggedIn_user;

?>

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