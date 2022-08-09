<?php
    session_start();
    unset($_SESSION['auth']);
    setcookie('name', null, 0, '/');
?>