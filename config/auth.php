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
        session_regenerate_id(true);
        $_SESSION['user'] = 'localadmin';
        return true;
    }

    return false;
}

function logout()
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
    }

    session_destroy();
}
?>
