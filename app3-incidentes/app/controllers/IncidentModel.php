<?php

class IncidentModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "usuario", "contraseña", "incidentes_db");

        if ($this->db->connect_error) {
            die("Error de conexión a la base de datos: " . $this->db->connect_error);
        }
    }

    // Registrar un nuevo incidente
    public function registerIncident($userId, $title, $description) {
        $stmt = $this->db->prepare("INSERT INTO incidents (user_id, title, description, status) VALUES (?, ?, ?, 'pendiente')");
        $stmt->bind_param("iss", $userId, $title, $description);
        return $stmt->execute();
    }

    // Asignar un técnico a un incidente
    public function setTechnician($incidentId, $technicianId) {
        $stmt = $this->db->prepare("UPDATE incidents SET technician_id = ?, status = 'en proceso' WHERE id = ?");
        $stmt->bind_param("ii", $technicianId, $incidentId);
        return $stmt->execute();
    }

    // Resolver y cerrar incidente
    public function resolveIncident($incidentId, $resolution) {
        $stmt = $this->db->prepare("UPDATE incidents SET resolution = ?, status = 'cerrado' WHERE id = ?");
        $stmt->bind_param("si", $resolution, $incidentId);
        return $stmt->execute();
    }

    // Obtener todos los incidentes
    public function getAllIncidents() {
        $result = $this->db->query("SELECT * FROM incidents");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener incidente por ID
    public function getIncidentById($id) {
        $stmt = $this->db->prepare("SELECT * FROM incidents WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}

?>
