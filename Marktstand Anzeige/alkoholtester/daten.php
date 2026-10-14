<?php
// Kleiner JSON-Endpunkt für die automatische Aktualisierung (script.js).
require __DIR__ . '/sensor.php';

header('Content-Type: application/json; charset=utf-8');
echo json_encode(holeSensorDaten());
