<?php
session_start(); // Inicia la sesión si aún no está iniciada

// Destruye todas las variables de sesión
$_SESSION = array();

// Destruye la sesión
session_destroy();

header("Location: ../login"); // Redirige al usuario a la página de login
exit();