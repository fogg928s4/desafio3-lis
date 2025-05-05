<!-- app/Views/survey_create.php -->
<html>
<head>
    <title>Crear Encuesta</title>
</head>
<body>
    <h1>Crear Nueva Encuesta</h1>
    <form method="POST" action="/survey/create">
        <label>Título de la encuesta:</label>
        <input type="text" name="title" required /><br><br>
        
        <label>Preguntas (puedes usar JSON para múltiples preguntas):</label>
        <textarea name="questions" required placeholder='["Pregunta 1", "Pregunta 2"]'></textarea><br><br>
        
        <button type="submit">Crear Encuesta</button>
    </form>
</body>
</html>
