<?php
// Définition de la racine du projet
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

// Routing simple
$params = explode('/', $_GET['url'] ?? '');

if ($params[0] != "") {
    $controller = ucfirst($params[0]) . "Controller";
    $action = isset($params[1]) ? $params[1] : 'index';

    if (file_exists(ROOT . 'controllers/' . $controller . '.php')) {
        require_once(ROOT . 'controllers/' . $controller . '.php');
        $instance = new $controller();

        if (method_exists($instance, $action)) {
            unset($params[0]);
            unset($params[1]);
            call_user_func_array([$instance, $action], $params);
        } else {
            http_response_code(404);
            echo "La page demandée n'existe pas";
        }
    } else {
        http_response_code(404);
        echo "Ce contrôleur n'existe pas";
    }
} else {
    // Contrôleur par défaut
    require_once(ROOT . 'controllers/HomeController.php');
    $instance = new HomeController();
    $instance->index();
}
