<?php
class BaseModel {

    protected $table;
    protected $pk;

    public static function __callStatic ($method, $arg) {
        $obj = new static;
        $result = call_user_func_array (array ($obj, $method), $arg);
        if (method_exists ($obj, $method))
            return $result;
        return $obj;
    }

    private function getAllById($param) {
        global $db;
        $sql = "SELECT * 
        FROM `comment` 
        WHERE `posts_id` = $param";
        print_r($sql);
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute( [ ':posts_id' => $param ] );

        return $pdo_statement->fetchAll();
    }

    private function getAll() {
        global $db;

        $sql = 'SELECT * FROM `' . $this->table . '`';
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute();
        return $pdo_statement->fetchAll();  
    }

    private function getAllFilteredPosts($param) {
        global $db;

        $sql = "SELECT * 
        FROM `posts` 
        WHERE `users_id` LIKE $param";

        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute( [ ':users_id' => $param ] );

        return $pdo_statement->fetchAll();
    }

    private function getById( int $id ) {
        global $db;

        $sql = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->pk . '` = :p_id';
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute( [ ':p_id' => $id ] );

        return $pdo_statement->fetchObject();
    }

    private function deleteById( int $id ) {
        global $db;

        $sql = 'DELETE FROM `' . $this->table . '` WHERE `' . $this->pk . '` = :p_id';
        $pdo_statement = $db->prepare($sql);
        return $pdo_statement->execute( [ ':p_id' => $id ] );
    }
    
}