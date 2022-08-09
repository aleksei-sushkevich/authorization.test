<?php
    session_start();
    require_once 'classes/User.php';
    if (!class_exists('User')) {
        die('Class User is not exist');
    }

    require_once 'classes/UserValidator.php';
    if (!class_exists('UserValidator')) {
        die('Class UserValidator is not exist');
    }

    require_once 'classes/Database.php';
    if (!class_exists('Database')) {
        die('Class Database is not exist');
    }
