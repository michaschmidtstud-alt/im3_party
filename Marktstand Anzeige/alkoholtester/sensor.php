<?php
// Holt die Sensordaten von der API und gibt sie als Array zurück.
// Bei einem Fehler enthält das Array den Schlüssel "fehler".

const API_URL = 'https://sensorbox.fiessling.ch/api/get.php?boxid=5&sensor=alkohol';

// Korrekturwert: wird vom gemessenen Alkoholwert abgezogen (Kalibrierung).
const KORREKTUR = 0.50;

function holeSensorDaten(): array
{
    $ch = curl_init(API_URL);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 5,
        CURLOPT_CONNECTTIMEOUT => 3,
    ]);

    $antwort = curl_exec($ch);
    $status  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErr = curl_error($ch);
    curl_close($ch);

    if ($antwort === false || $status !== 200) {
        return ['fehler' => 'API nicht erreichbar' . ($curlErr ? ': ' . $curlErr : '')];
    }

    $daten = json_decode($antwort, true);
    if (!is_array($daten) || !isset($daten['wert'])) {
        return ['fehler' => 'Ungültige Antwort von der API'];
    }

    // Korrektur abziehen, nicht unter 0 fallen lassen, mit 2 multiplizieren (mg/L -> Promille)
    // und erst ganz am Schluss auf 2 Nachkommastellen runden
    $daten['wert']    = round(max(0, $daten['wert'] - KORREKTUR) * 2, 2);
    $daten['einheit'] = '‰';

    return $daten;
}
