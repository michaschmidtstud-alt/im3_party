// Aktualisiert die Werte alle 5 Sekunden über daten.php, ohne die Seite neu zu laden.
const INTERVALL_MS = 5000;

async function aktualisieren() {
    const fehlerEl = document.getElementById('fehler');
    try {
        const antwort = await fetch('daten.php');
        const daten = await antwort.json();

        if (daten.fehler) {
            fehlerEl.textContent = daten.fehler;
            return;
        }

        fehlerEl.textContent = '';
        document.getElementById('wert').textContent = Number(daten.wert).toFixed(2);
        document.getElementById('einheit').textContent = daten.einheit;
        document.getElementById('sensor').textContent = daten.sensor;
        document.getElementById('zeit').textContent = daten.zeit;
    } catch (e) {
        fehlerEl.textContent = 'Aktualisieren';
    }
}

setInterval(aktualisieren, INTERVALL_MS);
