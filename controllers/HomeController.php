<?php
require_once(ROOT . 'models/Trajet.php');

class HomeController
{
    public function index()
    {
        $trajetModel = new Trajet();
        $trajets = $trajetModel->getAvailableTrajets();

        // Passage des données à la vue
        $data = [
            'title' => 'Accueil',
            'trajets' => $trajets
        ];

        // Inclusion de la vue
        require_once(ROOT . 'views/home/index.php');
    }
}
