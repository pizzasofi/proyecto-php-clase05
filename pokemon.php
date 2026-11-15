
<?php
require_once 'funciones.php';

$busqueda = trim($_GET['pokemon'] ?? '');
if ($busqueda === '') {
    die('Debe escribir un nombre o ID');
}

$pokemon = consultarPokemon($busqueda);
if ($pokemon === null) {
    die('Pokémon no encontrado');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado Pokémon</title>
</head>
<body>
    <h1><?= htmlspecialchars(nombreBonito($pokemon['name'] ?? '')) ?></h1>
    <p>ID: <?= htmlspecialchars($pokemon['id'] ?? '') ?></p>
    <p>Altura: <?= isset($pokemon['height']) ? ($pokemon['height'] / 10) : 0 ?> m</p>
    <p>Peso: <?= isset($pokemon['weight']) ? ($pokemon['weight'] / 10) : 0 ?> kg</p>
    <p><strong>Experiencia Base:</strong> <?= htmlspecialchars($pokemon['base_experience'] ?? 0) ?> XP</p>

    <?php 
    $ataque = 0; 
    $defensa = 0; 
    if (isset($pokemon['stats']) && is_array($pokemon['stats'])) { 
        foreach ($pokemon['stats'] as $stat) { 
            if (($stat['stat']['name'] ?? '') === 'attack') { 
                $ataque = $stat['base_stat'] ?? 0; 
            } 
            if (($stat['stat']['name'] ?? '') === 'defense') { 
                $defensa = $stat['base_stat'] ?? 0; 
            } 
        } 
    } 
    ?>

    <h3>Estadísticas:</h3>
    <ul>
        <?php if (isset($pokemon['stats']) && is_array($pokemon['stats'])): ?>
            <?php foreach ($pokemon['stats'] as $stat): ?>
                <li>
                    <strong><?= htmlspecialchars(nombreBonito($stat['stat']['name'] ?? '')) ?>:</strong> 
                    <?= htmlspecialchars($stat['base_stat'] ?? 0) ?>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <?php 
    $imagen = $pokemon['sprites']['other']['official-artwork']['front_default'] 
              ?? $pokemon['sprites']['front_default'] 
              ?? ''; 
    ?>

    <?php if ($imagen !== ''): ?>
        <img src="<?= htmlspecialchars($imagen) ?>" alt="<?= htmlspecialchars($pokemon['name'] ?? '') ?>" width="250">
    <?php endif; ?>

    <form action="agregar.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($pokemon['id'] ?? '') ?>">
        <input type="hidden" name="nombre" value="<?= htmlspecialchars($pokemon['name'] ?? '') ?>">
        <input type="hidden" name="imagen" value="<?= htmlspecialchars($imagen) ?>">
        <button type="submit">Agregar a mi equipo</button>
    </form>
</body>
</html>
