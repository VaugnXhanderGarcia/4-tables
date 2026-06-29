<?php
session_start();

function isLoggedIn()
{
    return isset($_SESSION['user']) && $_SESSION['user'] === 'localadmin';
}

function requireLogin()
{
    if (!isLoggedIn()) {
        header('Location: /Garcia/login.php');
        exit;
    }
}

function attemptLogin($username, $password)
{
    $validUsername = 'localadmin';
    $validPassword = 'Admin123!';

    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['user'] = 'localadmin';
        return true;
    }

    return false;
}
?>
