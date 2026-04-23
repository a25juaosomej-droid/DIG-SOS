<?php
include("conexion.php");

$sql    = "SELECT * FROM jocs ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="ca">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Game Vault — Biblioteca</title>
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
    font-size: 1.1rem;
    font-weight: 900;
    color: #a855f7;
    letter-spacing: 3px;
}
.logo span { color: #ff6b00; }
.btn-nou {
    background: transparent;
    border: 1px solid #ff6b00;
    color: #ff6b00;
    text-decoration: none;
    padding: 8px 18px;
    font-family: 'Share Tech Mono', monospace;
    font-size: .8rem;
    letter-spacing: 1px;
    transition: background .2s;
}
.btn-nou:hover { background: rgba(255,107,0,.12); }

.container { max-width: 960px; margin: 40px auto; padding: 0 20px; }

.top-bar {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    margin-bottom: 20px;
}
.section-title {
    font-family: 'Orbitron', monospace;
    font-size: .85rem;
    font-weight: 700;
    color: #a855f7;
    letter-spacing: 3px;
    text-transform: uppercase;
}
.count {
    font-size: .7rem;
    color: #a855f750;
    letter-spacing: 2px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: #07111f;
    border: 1px solid #a855f730;
}
thead { background: #050a14; }
th {
    padding: 12px 16px;
    text-align: left;
    font-size: .65rem;
    color: #a855f7;
    letter-spacing: .1em;
    text-transform: uppercase;
    border-bottom: 1px solid #a855f730;
}
td {
    padding: 12px 16px;
    font-size: .82rem;
    border-top: 1px solid #a855f715;
    color: #c4b5fd;
}
tbody tr:hover { background: #0a1628; }

.badge {
    display: inline-block;
    padding: 2px 8px;
    font-size: .65rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    border: 1px solid;
}
.badge-jugant   { border-color: #22d3ee; color: #22d3ee; }
.badge-completat { border-color: #4ade80; color: #4ade80; }
.badge-pendent  { border-color: #a855f7; color: #a855f7; }
.badge-abandonat { border-color: #f87171; color: #f87171; }
.badge-platejat { border-color: #fbbf24; color: #fbbf24; }

.score {
    font-family: 'Orbitron', monospace;
    font-weight: 700;
    font-size: .9rem;
    color: #ff6b00;
}

.btn-editar {
    background: transparent;
    border: 1px solid #a855f750;
    color: #a855f7;
    padding: 4px 12px;
    font-family: 'Share Tech Mono', monospace;
    font-size: .75rem;
    cursor: pointer;
    text-decoration: none;
    transition: all .2s;
    margin-right: 6px;
    letter-spacing: 1px;
}
.btn-editar:hover { border-color: #a855f7; background: rgba(168,85,247,.1); }

.btn-eliminar {
    background: transparent;
    border: 1px solid #f8717150;
    color: #f87171;
    padding: 4px 12px;
    font-family: 'Share Tech Mono', monospace;
    font-size: .75rem;
    cursor: pointer;
    text-decoration: none;
    transition: all .2s;
    letter-spacing: 1px;
}
.btn-eliminar:hover { border-color: #f87171; background: rgba(248,113,113,.1); }

.buit {
    text-align: center;
    padding: 60px;
    color: #a855f730;
    font-size: .85rem;
    letter-spacing: 2px;
}
.buit a { color: #a855f7; text-decoration: none; }
</style>
</head>
<body>

<header>
    <div class="logo">GAME<span>VAULT</span></div>
    <a href="insertar.php" class="btn-nou">+ AFEGIR JOC</a>
</header>

<div class="container">
    <div class="top-bar">
        <div class="section-title">// Biblioteca de Jocs</div>
        <div class="count"><?php echo mysqli_num_rows($result); ?> REGISTRES</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Títol</th>
                <th>Developer</th>
                <th>Any</th>
                <th>Plataforma</th>
                <th>Estat</th>
                <th>Puntuació</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) === 0): ?>
            <tr>
                <td colspan="8">
                    <div class="buit">
                        CAP JOC REGISTRAT. <a href="insertar.php">AFEGEIX EL PRIMER</a>
                    </div>
                </td>
            </tr>
        <?php else: ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo (int) $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['titol']); ?></td>
                <td><?php echo htmlspecialchars($row['developer'] ?? '—'); ?></td>
                <td><?php echo htmlspecialchars($row['any_llancament'] ?? '—'); ?></td>
                <td><?php echo htmlspecialchars($row['plataforma']); ?></td>
                <td>
                    <?php
                    $estat = strtolower($row['estat'] ?? '');
                    $cls   = match($estat) {
                        'jugant'    => 'badge-jugant',
                        'completat' => 'badge-completat',
                        'pendent'   => 'badge-pendent',
                        'abandonat' => 'badge-abandonat',
                        'platejat'  => 'badge-platejat',
                        default     => 'badge-pendent',
                    };
                    ?>
                    <span class="badge <?php echo $cls; ?>"><?php echo htmlspecialchars($row['estat'] ?? '—'); ?></span>
                </td>
                <td><span class="score"><?php echo (int)($row['puntuacio'] ?? 0); ?>/10</span></td>
                <td>
                    <a href="editar.php?id=<?php echo (int) $row['id']; ?>" class="btn-editar">EDITAR</a>
                    <a href="eliminar.php?id=<?php echo (int) $row['id']; ?>"
                       class="btn-eliminar"
                       onclick="return confirm('Segur que vols eliminar aquest joc?')">DELETE</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
