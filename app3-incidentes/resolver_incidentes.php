<?php
session_start();
require_once 'controllers/IncidentController.php';

// Verificar si el usuario es técnico
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'tecnico') {
    die("Acceso denegado.");
}

$controller = new IncidentController();
$incidentes = $controller->getAllIncidents();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $incidentId = $_POST["incident_id"] ?? 0;
    $resolution = $_POST["resolution"] ?? '';

    if ($incidentId && $resolution) {
        $controller->closeIncident($incidentId, $resolution);
        echo "✅ Incidente resuelto correctamente.";
    } else {
        echo "❌ Completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resolver Incidente</title>
</head>
<body>
    <h2>Resolver Incidente</h2>
    <form method="post">
        <label>Seleccionar Incidente:</label>
        <select name="incident_id">
            <?php foreach ($incidentes as $incidente) : ?>
                <option value="<?= $incidente['id']; ?>"><?= $incidente['title']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Solución:</label>
        <textarea name="resolution" required></textarea><br>

        <button type="submit">Cerrar Incidente</button>
    </form>
</body>
</html>
