<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $this->io->post('username');
            $password = $this->io->post('password');

            if ($username === 'admin' && $password === 'admin123') {

                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;

                redirect('login/products');

            } else {

                $data['message'] = 'Invalid username or password.';
                $this->call->view('login', $data);
            }

        } else {

            $this->call->view('login');
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        redirect('login');
    }
}