<?php
    require 'connect.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $user = new User($data->login, $data->password, $data->email, $data->name);

    $user_validator = new UserValidator();
    
    $user_validator->validate($user, $data->password_confirm);

    if($user_validator->exist_errors){
        echo json_encode($user_validator->validate_errors);
    }else{
        Database::createUser($user);
        echo json_encode(array("message" => "success"));
    }

?>