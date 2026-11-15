<?php

session_start();

// 2. Captura y sanitización del ID
$id = (int) ($_POST["id"] ?? 0);

if ($id <= 0) {
    $_SESSION["error"] = "ID de Pokémon inválido.";
    header("Location: equipo.php");
    exit;
}

// 3. Inicializar el equipo si no existe en la sesión
if (!isset($_SESSION["equipo"]) || !is_array($_SESSION["equipo"])) {
    $_SESSION["equipo"] = [];
}

// 4. Filtrar el arreglo para excluir el ID seleccionado
$nuevoEquipo = [];
$encontrado = false;

foreach ($_SESSION["equipo"] as $miembro) {
    if (($miembro["id"] ?? null) !== $id) {
        $nuevoEquipo[] = $miembro;
    } else {
        $encontrado = true;
    }
}

// 5. Guardar el nuevo arreglo y definir la retroalimentación
$_SESSION["equipo"] = $nuevoEquipo;

if ($encontrado) {
    $_SESSION["exito"] = "El Pokémon ha sido eliminado de tu equipo.";
}

// 6. Redirigir de vuelta a la interfaz del equipo
header("Location: equipo.php");
exit;
?>
