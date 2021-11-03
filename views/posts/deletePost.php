<?php
global $loggedIn_user;
session_destroy();
header("Location: /account/detail/$loggedIn_user->id");
?>

deleting