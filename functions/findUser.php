<?php

function getUser($name = '') {

    global $db;
    
    $exec_var = [];

    if($name) {
        $sql = "SELECT * 
        FROM `users` 
        WHERE `username` LIKE ? 
        ORDER BY `users`.`username` ASC";

        $exec_var[] = "%$name%";

    } else {
        $sql = 'SELECT * 
        FROM `users` 
        ORDER BY `users`.`username` ASC';
    }


    $stmnt = $db->prepare($sql);
    $stmnt->execute($exec_var);
    $data = $stmnt->fetchAll();

    return $data;
}

function getUserById($id) {
    global $db;
    if($id) {
        $sql = "SELECT * 
        FROM users
        WHERE id = ?";
    }

    $stmnt = $db->prepare($sql);
    $stmnt->execute( [ $id ] );
    $data = $stmnt->fetchObject();
    return $data;
}

function getUserByCred($email, $password) {


    global $db;
    $sql = "SELECT * 
    FROM users 
    WHERE email = '$email'";

    $stmnt = $db->prepare($sql);
    $stmnt->execute([ $email ]);
    $data = $stmnt->fetchObject();
        if(password_verify($password, $data->password)){
        return $data;
        }
        else{
        echo "Wrong Password";
        }
        $stmnt = $db->prepare($sql);
        $stmnt->execute([ $email ]);
        $data = $stmnt->fetchObject();
}  
function getUserByEmail($email) {
    global $db;
    $sql = "SELECT * 
    FROM users 
    WHERE email = '$email'";

    $stmnt = $db->prepare($sql);
    $stmnt->execute([ $email ]);
    $data = $stmnt->fetchObject();
    return $data;
}
function checkIfFriends(int $id) {
    
    global $db;
    
        $sql = "SELECT * 
        FROM `followers` 
        WHERE `follower_id` LIKE ?";

    $stmnt = $db->prepare($sql);
    $stmnt->execute( [ $id ] );
    $data = $stmnt->fetchAll();

    return $data;
}