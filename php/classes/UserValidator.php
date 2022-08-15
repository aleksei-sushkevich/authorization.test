<?php

class UserValidator{

    public $validate_errors;
    public $exist_errors;

    public function validate($user, $password_confirm){
        $this->validate_errors = new stdClass();
        $this->exist_errors = false;
        $this->checkLogin($user->login);
        $this->checkPassword($user->password);
        $this->checkConfirmPassword($user->password, $password_confirm);
        $this->checkEmail($user->email);
        $this->checkName($user->name);
    }

    private function checkLogin($value){
        if($value == ''){
            $this->validate_errors->login_msg = 'The Login field must be filled in';
            $this->exist_errors = true;
            return;
        }

        if(strlen($value) <= 6){
            $this->validate_errors->login_msg = 'The Login must be longer than 6 characters';
            $this->exist_errors = true;
            return;
        }

        if(strpos($value, ' ') || $value[0] === ' '){
            $this->validate_errors->login_msg = 'The Login cannot contain a space';
            $this->exist_errors = true;
            return;
        }

        if(preg_match('/^\s+$/', $value) == 1){
            $this->validate_errors->login_msg = 'The Login cannot consist only of spaces';
            $this->exist_errors = true;
            return ;
        }

        if(Database::checkUserLogin($value)){
            $this->validate_errors->login_msg = 'The User with this Login exists';
            $this->exist_errors = true;
            return;
        }

        $this->validate_errors->login_msg = '';
    }

    private function checkPassword($value){
        if($value == ''){
            $this->validate_errors->password_msg = 'The Password field must be filled in';
            $this->exist_errors = true;
            return;
        }

        if(strlen($value) <= 6){
            $this->validate_errors->password_msg = 'The Password must be longer than 6 characters';
            $this->exist_errors = true;
            return;
        }

        if(strpos($value, ' ') || $value[0] === ' '){
            $this->validate_errors->password_msg = 'The Password cannot contain a space';
            $this->exist_errors = true;
            return;
        }

        if (!preg_match("#[0-9]+#", $value)) {
            $this->validate_errors->password_msg = "The Password must include at least one number";
            $this->exist_errors = true;
            return;
        }
    
        if (!preg_match("#[a-zA-Z]+#", $value)) {
            $this->validate_errors->password_msg = "The Password must include at least one letter";
            $this->exist_errors = true;
            return;
        }

        if(preg_match('/^\s+$/', $value) == 1){
            $this->validate_errors->password_msg = 'The Password cannot consist only of spaces';
            $this->exist_errors = true;
            return;
        }

        $this->validate_errors->password_msg = '';
    }

    private function checkConfirmPassword($password, $confirm){
        if($password != $confirm){
            $this->validate_errors->password_confirm_msg = 'The Passwords must match';
            $this->exist_errors = true;
            return ;
        }

        $this->validate_errors->password_confirm_msg = '';
    }

    private function checkEmail($value){
        if($value == ''){
            $this->validate_errors->email_msg = 'The Email field must be filled in';
            $this->exist_errors = true;
            return ;
        }
        if(substr_count($value, '@') > 1){
            $this->validate_errors->email_msg = 'The Email can contain only one character "%"';
            $this->exist_errors = true;
            return ;
        }
        if(substr_count($value, '@') < 1){
            $this->validate_errors->email_msg = 'The Email must contain the domain part';
            $this->exist_errors = true;
            return ;
        }

        if(strpos($value, ' ') || $value[0] === ' '){
            $this->validate_errors->email_msg = 'The Email cannot contain a space';
            $this->exist_errors = true;
            return;
        }

        if(preg_match("/^([a-zA-Z0-9\.]+@)$/",$value)){
            $this->validate_errors->email_msg = 'The Email must contain the domain part';
            $this->exist_errors = true;
            return ;
        }

        if(!preg_match("/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/",$value)){
            $this->validate_errors->email_msg = 'The domain part should be separated by a dot and its second part consists of 2 or 3 letters';
            $this->exist_errors = true;
            return ;
        }

        if(Database::checkUserEmail($value)){
            $this->validate_errors->email_msg = 'User with such an email exists';
            $this->exist_errors = true;
            return ;
        }
        
        $this->validate_errors->email_msg = '';
    }

    private function checkName($value){
        if($value == ''){
            $this->validate_errors->name_msg = 'The Name field must be filled in';
            $this->exist_errors = true;
            return;
        }

        if(strlen($value) <= 1){
            $this->validate_errors->name_msg = 'The Name must be longer than 1 characters';
            $this->exist_errors = true;
            return;
        }

        if(strlen($value) > 10){
            $this->validate_errors->name_msg = 'The Name must be smaller than 10 characters';
            $this->exist_errors = true;
            return;
        }

        if(strpos($value, ' ') || $value[0] === ' '){
            $this->validate_errors->name_msg = 'The Name cannot contain a space';
            $this->exist_errors = true;
            return;
        }

        if(preg_match('/^\s+$/', $value) == 1){
            $this->validate_errors->name_msg = 'The Name cannot consist only of spaces';
            $this->exist_errors = true;
            return ;
        }

        $this->validate_errors->name_msg = '';
    }

}
