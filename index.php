<?php
    session_start();

    if($_SESSION['auth']){
        include_once('html/profile.html');
        return;
    }
    
    $url_requested = $_SERVER['REQUEST_URI'];
    $url_len = strlen($url_requested);
    $actual_path = substr($url_requested,strpos($url_requested,'/'),$url_len); 

    if($actual_path == "/"){
        header('Location: /login');
    }else if($actual_path == "/signup"){     
        include_once('html/signup.html');
    }else if($actual_path == "/login"){
        include_once('html/login.html');
    }else if($actual_path == "/success"){
        include_once('html/success.html');
    }else if($actual_path == "/noscript"){
        include_once('html/noscript.html');
    }else{
        header('Location: ./');
    }
?>