<?php
session_start();
$_SESSION['equipo'] = [];
header("Location: equipo.php");
exit;
?>