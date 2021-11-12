<?php

class Likes extends BaseModel {

    protected $table = 'Liked';
    protected $pk = 'id';

    function createLike($like) {
        global $db;
        $sql = "INSERT INTO 
        `liked` (`users_id`, `posts_id`, `created_on`)
        VALUES (:users_id, :posts_id, :created_on)";
       
        $stmnt = $db->prepare($sql);
        $stmnt->execute( 
            [   
                ':users_id' => $like->users_id,
                ':posts_id' => $like->posts_id,
                ':created_on' => $like->created_on,
            ]
        );
    
        return $db->lastInsertId();
    }

    function deleteById( int $postId ) {
        global $db;
        $sql = 'DELETE FROM `liked` WHERE `posts_id` = :posts_id';
        $pdo_statement = $db->prepare($sql);
        return $pdo_statement->execute( [ ':posts_id' => $postId ] );
    }

}