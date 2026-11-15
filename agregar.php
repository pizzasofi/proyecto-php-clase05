<?php
session_start();

//  Sanitización y captura de datos enviados por POST
$id = (int) ($_POST["id"] ?? 0);
$nombre = trim($_POST["nombre"] ?? "");
$imagen = trim($_POST["imagen"] ?? "");

//  Validación de campos obligatorios
if ($id <= 0 || $nombre === "") {
    $_SESSION["error"] = "Datos del Pokémon inválidos.";
    header("Location: index.php");
    exit;
}

//  Inicializar el array del equipo en la sesión si no existe
if (!isset($_SESSION["equipo"]) || !is_array($_SESSION["equipo"])) {
    $_SESSION["equipo"] = [];
}

$equipo = $_SESSION["equipo"];

//  Validación de límite de tamaño (Máximo 6 miembros)
if (count($equipo) >= 6) {
    $_SESSION["error"] = "El equipo ya está completo (máximo 6 Pokémon).";
    header("Location: equipo.php");
    exit;
}

//  Validación de duplicados (Evitar repetir el mismo ID)
foreach ($equipo as $miembro) {
    if (($miembro["id"] ?? null) === $id) {
        $_SESSION["error"] = "Este Pokémon ya forma parte de tu equipo.";
        header("Location: equipo.php");
        exit;
    }
}

// Insertar el nuevo Pokémon al array
$equipo[] = [
    "id" => $id,
    "nombre" => $nombre,
    "imagen" => $imagen
];

// Guardar de nuevo en la sesión y redirigir con éxito
$_SESSION["equipo"] = $equipo;
$_SESSION["exito"] = "¡" . ucfirst($nombre) . " ha sido añadido a tu equipo!";

header("Location: equipo.php");
exit;
