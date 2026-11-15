<?php
session_start();
require_once "funciones.php";
$equipo = $_SESSION["equipo"] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi equipo Pokémon</title>
</head>
<body>
    <h1>Mi equipo Pokémon</h1>
    <p>Miembros: <?= count($equipo) ?> / 6</p>

    <?php if (count($equipo) > 0): ?>
        <form action="vaciar.php" method="POST" style="margin-top: 10px; margin-bottom: 10px;">
            <button type="submit" onclick="return confirm('¿Seguro que deseas vaciar todo el equipo?');">
                Vaciar equipo
            </button>
        </form>
    <?php endif; ?>

    <a href="index.php">Buscar otro Pokémon</a>
    <hr>

    <?php if (count($equipo) === 0): ?>
        <p>Tu equipo está vacío.</p>
    <?php else: ?>
        <?php foreach ($equipo as $miembro): ?>
            <h3><?= htmlspecialchars(nombreBonito($miembro["nombre"] ?? '')) ?></h3>
            
            <?php if (!empty($miembro["imagen"])): ?>
                <img src="<?= htmlspecialchars($miembro["imagen"]) ?>" alt="<?= htmlspecialchars($miembro["nombre"] ?? '') ?>" width="140">
            <?php endif; ?>

            <form action="eliminar.php" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($miembro["id"] ?? '') ?>">
                <button type="submit">Eliminar</button>
            </form>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
