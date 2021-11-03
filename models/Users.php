<?php

class Users extends BaseModel {

    protected $table = 'users';
    protected $pk = 'id';

    function emailExists($email) {
        echo "running email";
        global $db;
        $sql = "SELECT COUNT(email) FROM users WHERE email = ?";
        $stmnt = $db->prepare($sql);
        $stmnt->execute( [ $email ] );
        $numberOfUsers = (int) $stmnt->fetchColumn();
        return ( $numberOfUsers > 0 ) ;
    }

    public function getFullName() {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getAge() {
        return $this->calculateAge() . ' jaar';
    }

    private function calculateAge() {
        return 21;
    }

    function updateUser($user) {
        global $db;
    
        foreach($user as $property => &$value) {
            //Transform special chars to html entities 
            //to prevent XSS attack
            if($property != ':pwd') {
                $value = htmlspecialchars($value);
            }
        }
    
        $sql = "UPDATE `users` 
                SET
                `username` = :username,
                `firstname` = :firstname, 
                `lastname` = :lastname,
                `email` = :email
                WHERE `id` = :id";
                
    
        $stmnt = $db->prepare($sql);
        return $stmnt->execute( 
            [
            ':username' => $user->username,
            ':firstname' => $user->firstname,
            ':lastname' => $user->lastname,
            ':email' => $user->email,
            ':id' => $user->id
        ]
         );
    }

    function createUser($user) {
        global $db;
    
        foreach($user as $property => &$value) {
            //Transform special chars to html entities 
            //to prevent XSS attack
            if($property != ':pwd') {
                $value = htmlspecialchars($value);
            }
        }
    
        $sql = "INSERT INTO 
        `users` (`username`, `firstname`, `lastname`, `email`, `password`, `image`)
        VALUES (:username, :firstname, :lastname, :email, :pwd, :image)";
       
        $stmnt = $db->prepare($sql);
        $stmnt->execute( 
            [   ':username' => $user->username,
                ':firstname' => $user->firstname,
                ':lastname' => $user->lastname,
                ':email' => $user->email,
                ':pwd' => $user->password,
                ':image' => $user->image
            ]
         );
    
        return $db->lastInsertId();
    }
    

}