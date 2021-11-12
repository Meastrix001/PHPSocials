<?php
global $loggedIn_user;
?>
<?php
$RepliedUserobj = getUserById($commentKey['replied_user_id']);
?>
<?php if($loggedIn_user->username === $RepliedUserobj->username) : ''?>

<div class="account--details--form--container comment--box">
  <p>At <?=$commentKey['created_on']?> | <img  class="user_profile" src="/images/users/<?=$RepliedUserobj->image?>"><?=$RepliedUserobj->username?> said: <?=$commentKey['message']?></p>
  
  <form class="account--details--form" method="post">
    <input class="message--hidden" name="message_id" value=<?=$commentKey['id']?>>
    <input type="text" placeholder="update comment" name="message_update">
    <input class="comment--submit-button" type="submit" value="update" name="update_message">
  </form>

  <form class="account--details--form" method="post" >
    <input class="message--hidden" name="message_id" value=<?=$commentKey['id']?>>
    <input type="submit" value="remove message" class="warned deleteButton" name="delete_message">
  </form>
</div>
<?php else : ;?>
<p>At <?=$commentKey['created_on']?> | <img  class="user_profile" src="/images/users/<?=$RepliedUserobj->image?>"> <?=$RepliedUserobj->username?> said: <?=$commentKey['message']?></p>
<?php endif?>
