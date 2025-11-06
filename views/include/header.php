<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yordan</title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>views/bootstrap/css/bootstrap.min.css">
    <!-- SweetAlert2 CSS (¡Añade esta línea para las animaciones y estilos!) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Font Awesome para iconos (usado en tienda.php, mejor cargarlo globalmente) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
       const base_url = "<?php echo BASE_URL; ?>";
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL ?>dashboard">Logo</a> <!-- Enlace el logo al dashboard -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php $current_view = isset($_GET['views']) ? explode('/', $_GET['views'])[0] : 'dashboard'; ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_view == 'dashboard') ? 'active' : ''; ?>" aria-current="page" href="<?= BASE_URL ?>dashboard"><i class="fas fa-home me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_view == 'users' || $current_view == 'new-user' || strpos($current_view, 'edit-user') !== false) ? 'active' : ''; ?>" href="<?= BASE_URL ?>users"><i class="fas fa-users me-1"></i> Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_view == 'products' || $current_view == 'new-product' || strpos($current_view, 'edit-product') !== false) ? 'active' : ''; ?>" href="<?= BASE_URL ?>products"><i class="fas fa-box me-1"></i> Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_view == 'new-categoria' || $current_view == 'categoria-lista' || strpos($current_view, 'categoria-edit') !== false) ? 'active' : ''; ?>" href="<?= BASE_URL ?>categoria-lista"><i class="fas fa-tags me-1"></i> Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_view == 'clientes' || $current_view == 'new-clientes' || strpos($current_view, 'edit-clientes') !== false) ? 'active' : ''; ?>" href="<?= BASE_URL ?>clientes"><i class="fas fa-handshake me-1"></i> Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_view == 'proveedor' || $current_view == 'new-proveedor' || strpos($current_view, 'edit-proveedor') !== false) ? 'active' : ''; ?>" href="<?= BASE_URL ?>proveedor"><i class="fas fa-truck me-1"></i> Proveedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_view == 'tienda') ? 'active' : ''; ?>" href="<?= BASE_URL ?>tienda"><i class="fas fa-store me-1"></i> Shops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_view == 'sales') ? 'active' : ''; ?>" href="#"><i class="fas fa-cash-register me-1"></i> Sales</a>
                    </li>


                </ul>
                <!-- Menú de Perfil a la derecha (corregido) -->
                <ul class="navbar-nav"> <!-- Usar ul.navbar-nav para alinear a la derecha -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user-circle me-1"></i> PERFIL</a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-1"></i> <?php echo isset($_SESSION['ventas_usuario']) ? $_SESSION['ventas_usuario'] : 'Mi Perfil'; ?></a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>control/logoutController.php"><i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>