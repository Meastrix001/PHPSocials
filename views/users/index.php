<?php 
$title = 'Users';
$css = 'users';
include_once BASE_DIR . '/views/_templates/_partials/header.php';

$search_str = $_GET['search'] ?? '';
$users = getUser($search_str);
?>
<form class="users-search" action="users.php" method="GET">
  <input id="search" name="search" type="text" placeholder="Type here">
  <input id="submit" type="submit" value="Search">
  <input id="submit" type="submit" value="Clear">
  </form>
<section class="users">
<?php if($users < 0) {
echo "no users found";
} else {
  foreach($users as $user => $key) {
    require BASE_DIR . '/views/_templates/_partials/usersPage.php';
  }
}
   ?>
</section>

<?php 
include_once BASE_DIR . '/views/_templates/_partials/footer.php';
?>
