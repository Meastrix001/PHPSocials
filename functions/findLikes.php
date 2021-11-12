<?php
  function checkIfLiked($id) {
      global $db;
      global $loggedIn_user;
          $sql = 'SELECT * 
          FROM `liked`
          WHERE posts_id = ? ';
    

      $stmnt = $db->prepare($sql);
      $stmnt->execute([ $id ]);
      $data = $stmnt->fetchObject();
      if($data){
        if($data->users_id === $loggedIn_user->id){

          return $data;
        }
      }
  }
?>