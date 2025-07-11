<?php
require_once "./config/config.php";
require_once"./control/views_control.php";

$view = new viewsControl();
$mostrar = $view->getViewControl();

if ($mostrar == "login" or $mostrar == "404") {
    require_once "./views/".$mostrar.".php";
}else{
    include "./views/include/header.php"; // Cargamos el header
    include $mostrar;
    include "./views/include/footer.php"; // Cargamos el footer
}