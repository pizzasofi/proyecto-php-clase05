<?php
require_once 'funciones.php';

$busqueda = trim($_GET['pokemon'] ?? '');
$error = '';
$pokemon = null;

if ($busqueda === '') {
    $error = 'Debes escribir el nombre o ID de un Pokémon para realizar la consulta.';
} else {
    $pokemon = consultarPokemon($busqueda);
    if ($pokemon === null || !isset($pokemon['name'])) {
        $error = 'No se encontró el Pokémon "' . htmlspecialchars($busqueda) . '" o la API no responde en este momento.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado Pokémon</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .tarjeta {
            background-color: #ffffff;
            width: 100%;
            max-width: 420px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 24px;
            text-align: center;
        }
        .alerta-error {
            background-color: #ffe6e6;
            color: #b30000;
            border: 1px solid #ffcccc;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }
        ul {
            text-align: left;
            background: #f8f9fa;
            padding: 12px 24px;
            border-radius: 8px;
        }
        button, .btn-volver {
            display: inline-block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        button {
            background-color: #e3350d;
            color: white;
        }
        button:hover {
            background-color: #c22b09;
        }
        .btn-volver {
            background-color: #2a75bb;
            color: white;
        }
        .btn-volver:hover {
            background-color: #1e578c;
        }
    </style>
</head>
<body>
    <div class="tarjeta">
        <?php if ($error !== ''): ?>
            <div class="alerta-error">
                <h3>Aviso de consulta</h3>
                <p><?= $error ?></p>
            </div>
            <a class="btn-volver" href="index.php">Volver a buscar</a>
        <?php else: ?>
            <h1><?= htmlspecialchars(nombreBonito($pokemon['name'] ?? '')) ?></h1>
            <p><strong>ID:</strong> <?= htmlspecialchars($pokemon['id'] ?? '') ?></p>
            <p><strong>Altura:</strong> <?= isset($pokemon['height']) ? ($pokemon['height'] / 10) : 0 ?> m</p>
            <p><strong>Peso:</strong> <?= isset($pokemon['weight']) ? ($pokemon['weight'] / 10) : 0 ?> kg</p>
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
                <img src="<?= htmlspecialchars($imagen) ?>" alt="<?= htmlspecialchars($pokemon['name'] ?? '') ?>" width="220">
            <?php else: ?>
                <p><em>Imagen no disponible para este Pokémon.</em></p>
            <?php endif; ?>

            <form action="agregar.php" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($pokemon['id'] ?? '') ?>">
                <input type="hidden" name="nombre" value="<?= htmlspecialchars($pokemon['name'] ?? '') ?>">
                <input type="hidden" name="imagen" value="<?= htmlspecialchars($imagen) ?>">
                <button type="submit">Agregar a mi equipo</button>
            </form>

            <a class="btn-volver" href="index.php">Hacer otra búsqueda</a>
        <?php endif; ?>
    </div>
</body>
</html>
