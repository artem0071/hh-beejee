<?php


namespace App\Controllers;


use Kernel\App;

class AuthController
{
    public function login()
    {

        if ($_SESSION['is_auth']) {
            go('/');
        }

        $validated = App::$Router->checkData(['email', 'password']);

        if ($validated['email'] != AUTH_LOGIN || $validated['password'] != AUTH_PASS) {
            go('/login');
        }

        $_SESSION['is_auth'] = true;

        go('/');
    }

    public function showForm()
    {
        if ($_SESSION['is_auth']) {
            go('/');
        }

        echo view('page.login');
    }
}