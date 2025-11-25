<?php
require_once(ROOT . 'models/User.php');

class LoginController
{
    public function index()
    {
        // Si déjà connecté, redirection vers l'accueil
        if (isset($_SESSION['user'])) {
            header('Location: ' . WEBROOT);
            exit();
        }

        $data = ['title' => 'Connexion'];
        require_once(ROOT . 'views/auth/login.php');
    }

    public function auth()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->getByEmail($email);

            // Vérification du mot de passe
            // On vérifie si le mot de passe correspond au hash (cas normal)
            // OU si le mot de passe correspond au texte clair (cas des données de test importées via SQL)
            if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {
                // Connexion réussie
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                header('Location: ' . WEBROOT);
                exit();
            } else {
                // Échec
                $data = ['title' => 'Connexion', 'error' => "Identifiants incorrects"];
                require_once(ROOT . 'views/auth/login.php');
            }
        }
    }
}
