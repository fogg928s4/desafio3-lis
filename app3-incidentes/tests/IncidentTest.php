<?php
use PHPUnit\Framework\TestCase;
require_once 'models/IncidentModel.php';

class IncidentTest extends TestCase {
    public function testCreateIncident() {
        $model = new IncidentModel();
        $result = $model->registerIncident(1, "Error en servidor", "No responde el API");
        $this->assertTrue($result);
    }
}
?>
