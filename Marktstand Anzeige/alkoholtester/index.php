<?php
require __DIR__ . '/sensor.php';
$daten = holeSensorDaten();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alkoholtester</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Alkoholtester</h1>



        <section id="messwert">
            <p>
                <span id="wert"><?= isset($daten['wert']) ? number_format($daten['wert'], 2, '.', '') : '–' ?></span>
                <span id="einheit"><?= htmlspecialchars($daten['einheit'] ?? '') ?></span>
            </p>

        </section>
        <p>Zeit: <span id="zeit"><?= htmlspecialchars($daten['zeit'] ?? '–') ?></span></p>
    </main>

    <p id="fehler" class="fehler">
        <?= isset($daten['fehler']) ? htmlspecialchars($daten['fehler']) : '' ?>
    </p>
    <script src="script.js"></script>
</body>
</html>
