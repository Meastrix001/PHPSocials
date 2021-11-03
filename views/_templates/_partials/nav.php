<?php
global $loggedIn_user;
?>
<nav>
  <ul>
    <li>
      <a href="../../home/index">Home</a>
    </li>
    <li>
      <a href="../../users/index">Users</a>
    </li>
    <li>
      <a href="../../posts">Posts</a>
    </li>
    <?php if($loggedIn_user) : ?>
      <li>
      <a class="user--image" href="../../account/detail/<?=$loggedIn_user->id?>">Account<img class="user--image" src="/images/users/<?=$loggedIn_user->image?>"></a>
      </li>
      <?php else: ?>
        <li>
        <a href="../../account/signUp">Sign up</a>
        </li>
        <li>
        <a href="../../account/signIn">Sign in</a>
        </li>
    <display an error>
    <?php endif; ?>
  </ul>
</nav>