<?php
// tests/Unit/SurveyServiceTest.php
use PHPUnit\Framework\TestCase;
use App\Services\SurveyService;
use App\Models\Survey;

class SurveyServiceTest extends TestCase
{
    public function testCreateSurvey(): void
    {
        $data = [
            'title'     => 'Encuesta de prueba',
            'questions' => ['¿Cómo calificarías nuestro servicio?']
        ];
        $service = new SurveyService();
        $survey = $service->createSurvey($data);
        
        $this->assertInstanceOf(Survey::class, $survey);
        $this->assertEquals('Encuesta de prueba', $survey->getTitle());
        $this->assertIsArray($survey->getQuestions());
    }
    
    public function testAnalyzeSurvey(): void
    {
        // Primero creamos la encuesta
        $data = [
            'title'     => 'Encuesta para análisis',
            'questions' => ['Pregunta de análisis']
        ];
        $service = new SurveyService();
        $survey = $service->createSurvey($data);
        
        // Luego analizamos los datos (en este ejemplo, se retornan datos dummy)
        $stats = $service->analyzeSurvey($survey->getId());
        $this->assertArrayHasKey('total_responses', $stats);
    }
}
