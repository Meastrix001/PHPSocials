<?php

class Follower extends BaseModel {

    protected $table = 'Liked';
    protected $pk = 'id';

    function createFollows($like) {
        global $db;
        $sql = "INSERT INTO 
        `followers` (`users_id`, `follower_id`, `date_following`)
        VALUES (:users_id, :follower_id, :date_following)";
       
        $stmnt = $db->prepare($sql);
        $stmnt->execute( 
            [   
                ':users_id' => $like->users_id,
                ':follower_id' => $like->follower_id,
                ':date_following' => $like->date_following
            ]
        );
    
        return $db->lastInsertId();
    }

    function deleteById( int $follower_id ) {
        global $db;
        $sql = 'DELETE FROM `followers` WHERE `follower_id` = :follower_id';
        $pdo_statement = $db->prepare($sql);
        return $pdo_statement->execute( [ ':follower_id' => $follower_id ] );
    }

}