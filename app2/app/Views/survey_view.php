<!-- app/Views/survey_view.php -->
<html>
<head>
    <title>Ver Encuesta</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($survey->getTitle()); ?></h1>
    <h3>Preguntas:</h3>
    <ul>
    <?php foreach ($survey->getQuestions() as $question): ?>
        <li><?php echo htmlspecialchars($question); ?></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
