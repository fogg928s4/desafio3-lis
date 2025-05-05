<?php
// app/Models/Survey.php
namespace App\Models;

use App\Database\DB;

class Survey
{
    private ?int $id = null;
    private string $title = '';
    private array $questions = [];
    
    public function getId(): ?int {
        return $this->id;
    }
    
    public function setTitle(string $title): void {
        $this->title = $title;
    }
    
    public function getTitle(): string {
        return $this->title;
    }
    
    public function setQuestions(array $questions): void {
        $this->questions = $questions;
    }
    
    public function getQuestions(): array {
        return $this->questions;
    }
    
    // Guarda la encuesta en la base de datos
    public function save(): void {
        $db = DB::getInstance();
        if ($this->id === null) {
            $stmt = $db->prepare("INSERT INTO surveys (title, questions) VALUES (?, ?)");
            // Se almacena el array de preguntas en formato JSON
            $questionsJson = json_encode($this->questions);
            $stmt->execute([$this->title, $questionsJson]);
            $this->id = (int)$db->lastInsertId();
        } else {
            // Lógica de actualización, si es necesaria
        }
    }
    
    // Busca una encuesta por ID
    public static function find(int $id): ?self {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM surveys WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }
        $survey = new self();
        $survey->id = (int)$row['id'];
        $survey->title = $row['title'];
        $survey->questions = json_decode($row['questions'], true);
        return $survey;
    }
    
    // Método de ejemplo para calcular estadísticas (dummy)
    public function calculateStatistics(): array {
        return [
            'total_responses' => 10,
            'average_score' => 4.5,
            'data' => [
                'labels' => ['Pregunta 1', 'Pregunta 2'],
                'datasets' => [
                    [
                        'label' => 'Respuestas',
                        'data' => [5, 7],
                        'backgroundColor' => [
                            'rgba(255,99,132,0.2)',
                            'rgba(54,162,235,0.2)'
                        ]
                    ]
                ]
            ]
        ];
    }
}
