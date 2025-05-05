<!-- app/Views/survey_analysis.php -->
<html>
<head>
    <title>Análisis de Encuesta</title>
    <!-- Se incluye Chart.js desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Análisis de Encuesta</h1>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
        // Se pasa la información analizada a JavaScript
        var chartData = <?php echo json_encode($statistics['data']); ?>;
        var ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: chartData
        });
    </script>
</body>
</html>
