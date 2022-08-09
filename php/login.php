<?php
    require 'connect.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $user = Database::getUser($data->login);

    if($user !== null && $user->password === Database::hashPassword($data->password)){
        $_SESSION['auth'] = true;
        setcookie('name', $user->name, 0, '/');
        echo json_encode(array("message" => "success"));
    }else{
        if($user === null){
            echo json_encode(array("message" => "unsuccess login"));
        }else{
            echo json_encode(array("message" => "unsuccess password"));
        }
    }
?>