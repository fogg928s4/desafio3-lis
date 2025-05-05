<?php

class ResponseHelper {

    // Calcular porcentaje de cada respuesta
    public static function calculatePercentages($responses) {
        $totalResponses = count($responses);
        $stats = [];

        foreach ($responses as $answer) {
            if (!isset($stats[$answer])) {
                $stats[$answer] = 0;
            }
            $stats[$answer]++;
        }

        foreach ($stats as $option => $count) {
            $stats[$option] = round(($count / $totalResponses) * 100, 2);
        }

        return $stats;
    }

    // Generar estadísticas básicas (promedio, moda, mediana)
    public static function generateStatistics($responses) {
        $count = count($responses);
        $sum = array_sum($responses);
        $average = $count ? round($sum / $count, 2) : 0;

        // Moda (respuesta más frecuente)
        $mode = array_search(max(array_count_values($responses)), array_count_values($responses));

        // Mediana
        sort($responses);
        $middle = floor($count / 2);
        $median = ($count % 2) ? $responses[$middle] : (($responses[$middle - 1] + $responses[$middle]) / 2);

        return [
            "average" => $average,
            "mode" => $mode,
            "median" => $median
        ];
    }

    // Generar datos en formato JSON para gráficos
    public static function formatDataForChart($responses) {
        return json_encode(self::calculatePercentages($responses));
    }
}

?>
