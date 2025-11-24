<?php
class HomeController
{
    public function index()
    {
        // Exemple de passage de données à la vue
        $data = ['title' => 'Accueil'];

        // Inclusion de la vue
        require_once(ROOT . 'views/home/index.php');
    }
}
