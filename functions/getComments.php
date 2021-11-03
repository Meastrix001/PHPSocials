<?php

function getAllComments($id) {

  global $db;
  
      $sql = 'SELECT * 
      FROM `comment`
      WHERE posts_id = ?
      ORDER BY `comment`.`created_on` ASC';

  $stmnt = $db->prepare($sql);
  $stmnt->execute([ $id ]);
  $data = $stmnt->fetchAll();

  return $data;
}
?>