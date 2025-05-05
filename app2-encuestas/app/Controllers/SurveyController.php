<?php
require_once 'models/SurveyModel.php';
require_once 'helpers/ResponseHelper.php';

class SurveyController {
    private $model;

    public function __construct() {
        $this->model = new SurveyModel();
    }

    // Crear nueva encuesta
    public function createSurvey($title, $questions) {
        return $this->model->saveSurvey($title, $questions);
    }

    // Obtener una encuesta
    public function getSurvey($id) {
        return $this->model->fetchSurvey($id);
    }

    // Distribuir encuestas
    public function distributeSurvey($id) {
        $link = "https://myapp.com/survey.php?id=" . $id;
        return $link;
    }

    // Registrar respuesta
    public function submitResponse($surveyId, $answers) {
        return $this->model->saveResponse($surveyId, $answers);
    }

    // Analizar resultados
    public function analyzeResults($surveyId) {
        return ResponseHelper::generateStatistics($this->model->getResponses($surveyId));
    }
}

// Ejemplo de uso
$controller = new SurveyController();
$surveyId = $controller->createSurvey("Encuesta de Satisfacción", ["Pregunta 1", "Pregunta 2"]);
