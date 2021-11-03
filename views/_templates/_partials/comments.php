<?php
global $loggedIn_user;
?>
<?php
$RepliedUserobj = getUserById($commentKey['replied_user_id']);
?>
<p>At <?=$commentKey['created_on']?> | <?=$RepliedUserobj->username?> said: <?=$commentKey['message']?></p>
<?php if($loggedIn_user->username === $RepliedUserobj->username) : ''?>
<div class="account--details--form--container">
  <form class="account--details--form" method="post" >
    <input class="message--hidden" name="message_id" value=<?=$commentKey['id']?>>
    <input type="submit" value="remove message" name="delete_message">
  </form>
  <form class="account--details--form" method="post">
    <input class="message--hidden" name="message_id" value=<?=$commentKey['id']?>>
    <input type="text" name="message_update">
    <input type="submit" value="update" name="update_message">
  </form>
</div>
<?php endif?>
