<?php
class LoginController
{
    public static function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($username == 'admin' && $password == 'password') {
                $_SESSION['logged_in'] = true;
                header('Location: /dashboard');
            } else {
                echo 'Usuário ou senha incorretos!';
            }
        } else {
            require_once 'views/login-form.php';
        }
    }

    public static function dashboard()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
            echo 'Bem-vindo ao Dashboard!';
            echo '<br><a href="/logout">Logout</a>';
        } else {
            header('Location: /login');
        }
    }

    public static function logout()
    {
        session_destroy();
        header('Location: /login');
    }
}
