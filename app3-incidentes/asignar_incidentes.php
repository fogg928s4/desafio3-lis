<?php
session_start();
require_once 'controllers/IncidentController.php';

// Verificar si el usuario es supervisor
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'supervisor') {
    die("Acceso denegado.");
}

$controller = new IncidentController();
$incidentes = $controller->getAllIncidents();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $incidentId = $_POST["incident_id"] ?? 0;
    $technicianId = $_POST["technician_id"] ?? '';

    if ($incidentId && $technicianId) {
        $controller->assignIncident($incidentId, $technicianId);
        echo "✅ Incidente asignado correctamente.";
    } else {
        echo "❌ Selecciona un incidente y un técnico.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Incidente</title>
</head>
<body>
    <h2>Asignar Incidente a Técnico</h2>
    <form method="post">
        <label>Seleccionar Incidente:</label>
        <select name="incident_id">
            <?php foreach ($incidentes as $incidente) : ?>
                <option value="<?= $incidente['id']; ?>"><?= $incidente['title']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>ID Técnico:</label>
        <input type="text" name="technician_id" required><br>

        <button type="submit">Asignar</button>
    </form>
</body>
</html>
