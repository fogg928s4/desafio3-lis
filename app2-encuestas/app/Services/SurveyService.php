<?php
// app/Services/SurveyService.php
namespace App\Services;

use App\Models\Survey;

class SurveyService
{
    // Crea y guarda una nueva encuesta
    public function createSurvey(array $data): Survey
    {
        $survey = new Survey();
        $survey->setTitle($data['title']);
        $survey->setQuestions($data['questions']);
        $survey->save();
        return $survey;
    }
    
    public function getSurveyById(int $id): ?Survey
    {
        return Survey::find($id);
    }
    
    // Método para analizar la encuesta (por ejemplo, computar estadísticas)
    public function analyzeSurvey(int $id): array
    {
        $survey = $this->getSurveyById($id);
        if (!$survey) {
            return [];
        }
        // Se calculan estadísticas; en un caso real, se obtendrían datos de respuestas
        return $survey->calculateStatistics();
    }
}
