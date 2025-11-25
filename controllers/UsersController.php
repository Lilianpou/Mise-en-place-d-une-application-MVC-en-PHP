<?php
require_once(ROOT . 'models/User.php');

class UsersController
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté et est admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . WEBROOT);
            exit();
        }

        $userModel = new User();
        $users = $userModel->getAll();

        $data = [
            'title' => 'Liste des utilisateurs',
            'users' => $users
        ];

        require_once(ROOT . 'views/users/index.php');
    }
}
