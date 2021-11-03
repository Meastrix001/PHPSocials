<?php 
global $loggedIn_user;
$css = "posts";
$title = "posts";
include_once BASE_DIR . '/views/_templates/_partials/header.php';
shuffle($posts)
?>
<section class="posts--posts">
<?php if(count($posts) < 0) {
echo "no posts found";
} else {
  foreach($posts as $post => $postKey) {
    $comments = getAllComments($postKey['id']);
    require BASE_DIR . '/views/_templates/_partials/postsPage.php';
  }
}
?>
</section>
<?php include_once BASE_DIR . '/views/_templates/_partials/footer.php'; ?>