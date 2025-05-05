<?php
require_once 'models/IncidentModel.php';

class IncidentController {
    private $model;

    public function __construct() {
        $this->model = new IncidentModel();
    }

    // Crear un nuevo incidente
    public function createIncident($userId, $title, $description) {
        return $this->model->registerIncident($userId, $title, $description);
    }

    // Asignar técnico al incidente
    public function assignIncident($incidentId, $technicianId) {
        return $this->model->setTechnician($incidentId, $technicianId);
    }

    // Resolver y cerrar incidente
    public function closeIncident($incidentId, $resolution) {
        return $this->model->resolveIncident($incidentId, $resolution);
    }
    // Obtener todos los incidentes
    public function getAllIncidents() {
        return $this->model->getAllIncidents();
    }
}
?>
