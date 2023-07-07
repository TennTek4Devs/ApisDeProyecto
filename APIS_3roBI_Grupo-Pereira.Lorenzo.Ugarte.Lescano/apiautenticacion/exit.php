<?php

session_start();

// Limpiar variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redireccionar al inicio de sesión
header('Location: /apiautenticacion');
exit();

?>