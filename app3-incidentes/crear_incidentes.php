<?php
session_start();
require_once 'controllers/IncidentController.php';

// Verificar si el usuario tiene el rol adecuado
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'usuario') {
    die("Acceso denegado.");
}

$controller = new IncidentController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"] ?? '';
    $description = $_POST["description"] ?? '';

    if ($title && $description) {
        $userId = $_SESSION['user']['username']; // Simulación de ID de usuario
        $controller->createIncident($userId, $title, $description);
        echo "✅ Incidente registrado correctamente.";
    } else {
        echo "❌ Completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Incidente</title>
</head>
<body>
    <h2>Registrar un nuevo incidente</h2>
    <form method="post">
        <label>Título:</label>
        <input type="text" name="title" required