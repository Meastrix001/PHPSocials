<?php
function setUserCookie($email) {
    setcookie('email', $email, time() + (86400 * 30), "/");
}
function getUserCookie() {
  $data = getUserByEmail($_COOKIE['email']);
  return $data;
}

function deleteUserCookie() {
  if(isset($_COOKIE['email'])) {
    setcookie('email', null, time() + (86400 * 30), "/");
  } 
}
?>