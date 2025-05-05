<?php
// index.php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\SurveyController;

// Obtenemos la URL sin parámetros GET
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
    case '/survey/create':
        $controller = new SurveyController();
        $controller->create();
        break;
    case '/survey/view':
        $controller = new SurveyController();
        $controller->view();
        break;
    case '/survey/analyze':
        $controller = new SurveyController();
        $controller->analyze();
        break;
    default:
        http_response_code(404);
        echo "Página no encontrada.";
        break;
}
