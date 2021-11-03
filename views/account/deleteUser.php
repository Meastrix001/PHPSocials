<?php
session_destroy();
deleteUserCookie();
header("Location: /home");
?>