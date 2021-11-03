<?php

class Comments extends BaseModel {

    protected $table = 'comment';
    protected $pk = 'id';

    function updateComment($comment) {
        global $db;
    
        $sql = "UPDATE `comment` 
                SET
                `message` = :message,
                `id` = :id
                WHERE `id` = :id";
                
    
        $stmnt = $db->prepare($sql);
        return $stmnt->execute( 
            [
            ':message' => $comment->message,
            ':id' => $comment->id
        ]
         );
    }

    function createComment($comment) {
        global $db;
    
        $sql = "INSERT INTO 
        `comment` (`message`, `replied_user_id`, `created_on`, `posts_id`)
        VALUES (:message, :replied_user_id, :created_on, :posts_id)";
       
        $stmnt = $db->prepare($sql);
        $stmnt->execute( 
            [   
                ':message' => $comment->message,
                ':replied_user_id' => $comment->replied_user_id,
                ':created_on' => $comment->created_on,
                ':posts_id' => $comment->posts_id
            ]
         );
    
        return $db->lastInsertId();
    }

    function deleteById( int $id ) {
        global $db;

        $sql = 'DELETE FROM `comment` WHERE `id` = :id';
        $pdo_statement = $db->prepare($sql);
        return $pdo_statement->execute( [ ':id' => $id ] );
    }

}