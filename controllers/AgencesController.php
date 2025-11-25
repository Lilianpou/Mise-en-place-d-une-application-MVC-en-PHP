<?php
require_once(ROOT . 'models/Agence.php');

class AgencesController
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté et est admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . WEBROOT);
            exit();
        }

        $agenceModel = new Agence();
        $agences = $agenceModel->getAll();

        $data = [
            'title' => 'Gestion des agences',
            'agences' => $agences
        ];

        require_once(ROOT . 'views/agences/index.php');
    }

    public function create()
    {
        // Vérifier si l'utilisateur est connecté et est admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . WEBROOT);
            exit();
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';

            if (!empty($nom)) {
                $agenceModel = new Agence();
                if ($agenceModel->create($nom)) {
                    header('Location: ' . WEBROOT . 'agences');
                    exit();
                } else {
                    $error = "Erreur lors de la création de l'agence.";
                }
            } else {
                $error = "Le nom de l'agence est obligatoire.";
            }
        }

        $data = [
            'title' => 'Créer une agence',
            'error' => $error
        ];

        require_once(ROOT . 'views/agences/create.php');
    }

    public function edit($id)
    {
        // Vérifier si l'utilisateur est connecté et est admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . WEBROOT);
            exit();
        }

        $agenceModel = new Agence();
        $agence = $agenceModel->getById($id);

        if (!$agence) {
            header('Location: ' . WEBROOT . 'agences');
            exit();
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';

            if (!empty($nom)) {
                if ($agenceModel->update($id, $nom)) {
                    header('Location: ' . WEBROOT . 'agences');
                    exit();
                } else {
                    $error = "Erreur lors de la modification de l'agence.";
                }
            } else {
                $error = "Le nom de l'agence est obligatoire.";
            }
        }

        $data = [
            'title' => 'Modifier une agence',
            'agence' => $agence,
            'error' => $error
        ];

        require_once(ROOT . 'views/agences/edit.php');
    }

    public function delete($id)
    {
        // Vérifier si l'utilisateur est connecté et est admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . WEBROOT);
            exit();
        }

        $agenceModel = new Agence();
        $agenceModel->delete($id);

        header('Location: ' . WEBROOT . 'agences');
        exit();
    }
}
