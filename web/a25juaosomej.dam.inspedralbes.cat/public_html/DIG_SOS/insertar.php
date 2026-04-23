<?php
include("conexion.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titol      = trim($_POST['titol']);
    $developer  = trim($_POST['developer']);
    $any        = trim($_POST['any_llancament']);
    $plataforma = trim($_POST['plataforma']);
    $estat      = trim($_POST['estat']);
    $genere     = isset($_POST['genere']) ? implode(',', $_POST['genere']) : '';
    $puntuacio  = intval($_POST['puntuacio']);
    $notes      = trim($_POST['notes']);

    if (empty($titol) || empty($plataforma)) {
        $error = "El títol i la plataforma són obligatoris.";
    } else {
        $stmt = mysqli_prepare($conn,
            "INSERT INTO jocs (titol, developer, any_llancament, plataforma, estat, genere, puntuacio, notes)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "ssssssisi",
            $titol, $developer, $any, $plataforma, $estat, $genere, $puntuacio, $notes
        );
        mysqli_stmt_execute($stmt);
        header("Location: listar.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Afegir Joc — GAME VAULT</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
    font-family: 'Share Tech Mono', monospace;
    background: #050a14;
    color: #e0d4ff;
    min-height: 100vh;
}
body::before {
    content: '';
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: repeating-linear-gradient(0deg, transparent, transparent 3px, rgba(0,0,0,0.04) 3px, rgba(0,0,0,0.04) 4px);
    pointer-events: none;
    z-index: 999;
}
header {
    background: #050a14;
    border-bottom: 2px solid #a855f7;
    padding: 14px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
}
header::after {
    content: '';
    position: absolute;
    bottom: -6px; left: 0; right: 0;
    height: 2px;
    background: #ff6b00;
    opacity: .5;
}
.logo {
    font-family: 'Orbitron', monospace;
    font-size: 1rem;
    font-weight: 900;
    color: #a855f7;
    letter-spacing: 3px;
}
.logo span { color: #ff6b00; }
header a.btn-back {
    background: transparent;
    border: 1px solid #a855f7;
    color: #a855f7;
    text-decoration: none;
    padding: 6px 16px;
    font-family: 'Share Tech Mono', monospace;
    font-size: .8rem;
    letter-spacing: 1px;
    transition: background .2s;
}
header a.btn-back:hover { background: rgba(168,85,247,.1); }

.container { max-width: 540px; margin: 40px auto; padding: 0 20px; }
.eyebrow { font-size: .7rem; color: #a855f7; opacity: .6; letter-spacing: 3px; margin-bottom: 4px; }
.page-title {
    font-family: 'Orbitron', monospace;
    font-size: 1.1rem;
    font-weight: 900;
    color: #ff6b00;
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-bottom: 4px;
}
.page-subtitle {
    font-size: .72rem;
    color: #a855f7;
    opacity: .5;
    letter-spacing: 2px;
    margin-bottom: 28px;
}
.blink { animation: blink 1.2s step-end infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }

.error-box {
    background: rgba(248,113,113,.07);
    border: 1px solid #f87171;
    border-left: 3px solid #f87171;
    padding: 10px 14px;
    font-size: .8rem;
    color: #f87171;
    margin-bottom: 20px;
    letter-spacing: 1px;
}

.form-box {
    background: #07111f;
    border: 1px solid #a855f7;
    padding: 28px;
    position: relative;
}
.form-box::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #a855f7, #ff6b00);
}
.form-box::after {
    content: 'GAME_ENTRY_FORM_v2.4';
    position: absolute;
    top: 10px; right: 14px;
    font-size: .6rem;
    color: #a855f7;
    opacity: .3;
    letter-spacing: 2px;
}

label {
    display: block;
    font-size: .72rem;
    color: #a855f7;
    letter-spacing: 2px;
    margin-bottom: 5px;
    margin-top: 16px;
}
label:first-of-type { margin-top: 0; }

input[type="text"],
input[type="number"],
select,
textarea {
    width: 100%;
    background: #050a14;
    border: 1px solid #a855f730;
    border-left: 2px solid #a855f7;
    color: #e0d4ff;
    font-family: 'Share Tech Mono', monospace;
    font-size: .85rem;
    padding: 9px 12px;
    outline: none;
    transition: border .2s;
}
input[type="text"]:focus,
input[type="number"]:focus,
select:focus,
textarea:focus {
    border-color: #ff6b00;
    border-left-color: #ff6b00;
}
select option { background: #07111f; }

.genere-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    margin-top: 6px;
}
.genere-grid label {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: .72rem;
    color: #c4b5fd;
    letter-spacing: 1px;
    cursor: pointer;
}
.genere-grid input[type="checkbox"] {
    width: auto;
    accent-color: #a855f7;
}

.rating-row { display: flex; align-items: center; gap: 12px; margin-top: 6px; }
.rating-row input[type="range"] {
    flex: 1;
    accent-color: #ff6b00;
    border: none;
    background: transparent;
    padding: 0;
}
.rating-val {
    font-family: 'Orbitron', monospace;
    font-size: 1rem;
    font-weight: 900;
    color: #ff6b00;
    min-width: 24px;
    text-align: center;
}

.form-btns { display: flex; gap: 12px; margin-top: 24px; }
.btn-save {
    flex: 1;
    background: linear-gradient(90deg, #a855f7, #ff6b00);
    color: #fff;
    border: none;
    padding: 10px;
    font-family: 'Orbitron', monospace;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: 2px;
    cursor: pointer;
    text-transform: uppercase;
    transition: opacity .2s;
}
.btn-save:hover { opacity: .85; }
.btn-cancel {
    background: transparent;
    border: 1px solid #a855f730;
    color: #a855f7;
    padding: 10px 20px;
    font-family: 'Share Tech Mono', monospace;
    font-size: .8rem;
    cursor: pointer;
    text-decoration: none;
    transition: border-color .2s;
    display: inline-flex;
    align-items: center;
}
.btn-cancel:hover { border-color: #a855f7; }
</style>
</head>
<body>

<header>
    <div class="logo">GAME<span>VAULT</span></div>
    <a href="listar.php" class="btn-back">← TORNAR</a>
</header>

<div class="container">
    <div class="eyebrow">// NOU REGISTRE</div>
    <div class="page-title">Afegir Joc<span class="blink">_</span></div>
    <div class="page-subtitle">INTRODUEIX LES DADES DEL JOC</div>

    <?php if ($error): ?>
        <div class="error-box">⚠ <?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div class="form-box">
        <form method="POST" action="insertar.php">

            <label for="titol">TÍTOL DEL JOC *</label>
            <input type="text" id="titol" name="titol"
                   value="<?php echo htmlspecialchars($_POST['titol'] ?? ''); ?>"
                   placeholder="ex: Elden Ring" required>

            <label for="developer">DEVELOPER / ESTUDI</label>
            <input type="text" id="developer" name="developer"
                   value="<?php echo htmlspecialchars($_POST['developer'] ?? ''); ?>"
                   placeholder="ex: FromSoftware">

            <label for="any_llancament">ANY DE LLANÇAMENT</label>
            <input type="text" id="any_llancament" name="any_llancament"
                   value="<?php echo htmlspecialchars($_POST['any_llancament'] ?? ''); ?>"
                   placeholder="ex: 2022">

            <label for="plataforma">PLATAFORMA *</label>
            <select id="plataforma" name="plataforma">
                <option value="">— Selecciona —</option>
                <?php
                $plataformes = ['PC','PS5','PS4','Xbox Series','Xbox One','Nintendo Switch','Mòbil','Altres'];
                foreach ($plataformes as $p) {
                    $sel = (($_POST['plataforma'] ?? '') === $p) ? 'selected' : '';
                    echo "<option value=\"$p\" $sel>$p</option>";
                }
                ?>
            </select>

            <label for="estat">ESTAT</label>
            <select id="estat" name="estat">
                <?php
                $estats = ['Pendent','Jugant','Completat','Abandonat','Platejat'];
                foreach ($estats as $e) {
                    $sel = (($_POST['estat'] ?? 'Pendent') === $e) ? 'selected' : '';
                    echo "<option value=\"$e\" $sel>$e</option>";
                }
                ?>
            </select>

            <label>GÈNERE</label>
            <div class="genere-grid">
                <?php
                $generes = ['Acció','RPG','Estratègia','Aventura','Esports','Terror','Plataformes','Simulació','Puzle'];
                $seleccionats = $_POST['genere'] ?? [];
                foreach ($generes as $g) {
                    $checked = in_array($g, $seleccionats) ? 'checked' : '';
                    echo "<label><input type=\"checkbox\" name=\"genere[]\" value=\"$g\" $checked> $g</label>";
                }
                ?>
            </div>

            <label for="puntuacio">PUNTUACIÓ: <span id="pval"><?php echo intval($_POST['puntuacio'] ?? 5); ?></span>/10</label>
            <div class="rating-row">
                <input type="range" id="puntuacio" name="puntuacio" min="0" max="10"
                       value="<?php echo intval($_POST['puntuacio'] ?? 5); ?>"
                       oninput="document.getElementById('pval').textContent=this.value">
                <span class="rating-val"><?php echo intval($_POST['puntuacio'] ?? 5); ?></span>
            </div>

            <label for="notes">NOTES</label>
            <textarea id="notes" name="notes" rows="3"
                      placeholder="Impressions, spoilers, pròxims objectius..."><?php echo htmlspecialchars($_POST['notes'] ?? ''); ?></textarea>

            <div class="form-btns">
                <button type="submit" class="btn-save">🎮 Guardar Joc</button>
                <a href="listar.php" class="btn-cancel">Cancel·lar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
