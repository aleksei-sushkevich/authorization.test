<?php

class Database{

    const FILE_DB = "../data/users.json";

    public static function checkUserLogin($login){
        foreach(Database::getUsersFromJsonDb() as $user){
            if($user->login === $login){
                return true;
            }
        }
        return false;
    }

    public static function checkUserEmail($email){
        foreach(Database::getUsersFromJsonDb() as $user){
            if($user->email === $email){
                return true;
            }
        }
        return false;
    }

    public static function createUser($user){
        $user->password = Database::hashPassword($user->password);
        $users = Database::getUsersFromJsonDb();
        array_push($users, $user);
        file_put_contents(Database::FILE_DB, json_encode($users));
    }

    public static function getUser($login){
        foreach(Database::getUsersFromJsonDb() as $user){
            if($user->login === $login){
                return $user;
            }
        }
        return null;
    }

    public static function hashPassword($password){
        return md5('1qwe3' . $password);
    }

    private static function getUsersFromJsonDb(){
        return json_decode(file_get_contents(Database::FILE_DB));
    }
}

?>