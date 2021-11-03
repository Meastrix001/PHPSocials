<?php

class Posts extends BaseModel {

    protected $table = 'posts';
    protected $pk = 'id';

    function createPost($post) {
        global $db;
    
        foreach($post as $property => &$value) {
            //Transform special chars to html entities 
            //to prevent XSS attack
            if($property != ':pwd') {
                $value = htmlspecialchars($value);
            }
        }
    
        $sql = "INSERT INTO 
        `posts` (`media`, `description`, `created_on`, `users_id`)
        VALUES (:media, :description, :created_on, :users_id)";
       
        $stmnt = $db->prepare($sql);
        $stmnt->execute( 
            [   
                ':media' => $post->media,
                ':description' => $post->description,
                ':users_id' => $post->users_id,
                ':created_on' => $post->created_on
            ]
         );
    
        return $db->lastInsertId();
    }
    
}