<?php

class User{
    
    public $login;
    public $password;
    public $email;
    public $name;

    public function __construct($login, $password, $email, $name){
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
    }

}