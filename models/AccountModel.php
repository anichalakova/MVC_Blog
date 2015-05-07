<?php
/**
 * Created by PhpStorm.
 * User: Ani
 * Date: 5/3/15
 * Time: 11:00 PM
 */

class AccountModel extends BaseModel {


    public function register($username, $password){
        $statement = self::$db->prepare("SELECT COUNT(Id) FROM Users WHERE Username = ?");
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        if ($result['COUNT(Id)']) {
            return false;
        } else {
            $password_hashed = password_hash($password, PASSWORD_BCRYPT);
            $statement = self::$db->prepare("INSERT INTO Users (username, pass_hash) VALUES(?,?)");
            $statement->bind_param('ss', $username, $password_hashed);
            $statement->execute();
            return true;
        }
    }

    public function login($username, $password){
        $statement = self::$db->prepare("SELECT id, username, pass_hash FROM Users WHERE username = ?");
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        if (password_verify($password, $result['pass_hash'])) {
            return true;
        }
        return false;

    }
} 