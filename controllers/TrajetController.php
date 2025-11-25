<?php
require_once(ROOT . 'models/Trajet.php');
require_once(ROOT . 'models/Agence.php');

class TrajetController
{
    public function create()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            header('Location: ' . WEBROOT . 'login');
            exit();
        }

        $agenceModel = new Agence();
        $agences = $agenceModel->getAll();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $agence_depart_id = $_POST['agence_depart_id'];
            $agence_arrivee_id = $_POST['agence_arrivee_id'];
            $date_heure_depart = $_POST['date_heure_depart'];
            $date_heure_arrivee = $_POST['date_heure_arrivee'];
            $places_totales = $_POST['places_totales'];
            $contact_id = $_SESSION['user']['id'];

            // Contrôles de cohérence
            if ($agence_depart_id == $agence_arrivee_id) {
                $error = "L'agence de départ et l'agence d'arrivée doivent être différentes.";
            } elseif (strtotime($date_heure_arrivee) <= strtotime($date_heure_depart)) {
                $error = "La date d'arrivée doit être postérieure à la date de départ.";
            } elseif (strtotime($date_heure_depart) < time()) {
                $error = "La date de départ ne peut pas être dans le passé.";
            } elseif ($places_totales < 1) {
                $error = "Le nombre de places doit être au moins de 1.";
            } else {
                // Création du trajet
                $trajetModel = new Trajet();
                $data = [
                    'agence_depart_id' => $agence_depart_id,
                    'agence_arrivee_id' => $agence_arrivee_id,
                    'date_heure_depart' => $date_heure_depart,
                    'date_heure_arrivee' => $date_heure_arrivee,
                    'places_totales' => $places_totales,
                    'places_prises' => 0,
                    'contact_id' => $contact_id
                ];

                if ($trajetModel->create($data)) {
                    header('Location: ' . WEBROOT);
                    exit();
                } else {
                    $error = "Une erreur est survenue lors de la création du trajet.";
                }
            }
        }

        $data = [
            'title' => 'Créer un trajet',
            'agences' => $agences,
            'user' => $_SESSION['user'],
            'error' => $error
        ];

        require_once(ROOT . 'views/trajet/create.php');
    }
}
