<?php
function consultarPokemon($busqueda) {
$busqueda = strtolower(trim($busqueda));
$busqueda = urlencode($busqueda);


$url =
"https://pokeapi.co/api/v2/pokemon/"
. $busqueda;

$respuesta = @file_get_contents($url);

if ($respuesta === false) {
return null;
}

return json_decode($respuesta, true);
}
function nombreBonito($texto) {
return ucfirst(str_replace("-", " ", $texto));
}
?>