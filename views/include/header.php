<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yordan</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>views/bootstrap/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Estilos específicos para el dropdown */
        .dropdown-menu {
            min-width: 200px;
            display: none; /* Bootstrap lo mostrará cuando sea necesario */
        }
        .dropdown-menu.show {
            display: block;
        }
        .navbar-nav .dropdown-menu {
            position: absolute;
        }
    </style>
    
    <script>
       const base_url = "<?php echo BASE_URL; ?>";
    </script>
</head>

<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $nombre_usuario = isset($_SESSION['ventas_usuario']) ? $_SESSION['ventas_usuario'] : 'Usuario';
    ?>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL ?>dashboard">
                <i class="fas fa-store me-2"></i>Logo
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarMain">
                <!-- Menú principal -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>dashboard">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>users">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>products">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>new-categoria">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>clientes">Clients</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>proveedor">Proveedores</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>tienda">Tienda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sales</a></li>
                </ul>
                
                <!-- MENÚ SIMPLE SIN DROPDOWN COMPLEJO -->
            <div class="navbar-nav ms-auto">
                <div class="nav-item">
                    <a class="nav-link" href="#" onclick="toggleMenu()">
                        <i class="fas fa-user me-1"></i><?= $nombre_usuario ?>
                    </a>
                    <div id="userMenu" style="display: none; position: absolute; right: 0; background: white; border: 1px solid #ccc; padding: 10px; z-index: 1000;">
                        <a class="d-block text-decoration-none text-dark mb-2" href="#">
                            <i class="fas fa-user me-2"></i>Perfil
                        </a>
                        <a class="d-block text-decoration-none text-danger mb-2" href="#" onclick="cerrarSesion()">
                            <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                        </a>
                        <hr>
                        <a class="d-block text-decoration-none text-dark" href="#">
                            <i class="fas fa-cog me-2"></i>Configuración
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
    function toggleMenu() {
        var menu = document.getElementById('userMenu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
        return false;
    }

    function cerrarSesion() {
        if (confirm('¿Cerrar sesión?')) {
            window.location.href = '<?= BASE_URL ?>login.php?logout=true';
        }
    }

    // Cerrar menú al hacer clic fuera
    document.addEventListener('click', function(e) {
        var menu = document.getElementById('userMenu');
        var trigger = document.querySelector('.navbar-nav .nav-item');
        if (menu && !trigger.contains(e.target)) {
            menu.style.display = 'none';
        }
    });
    </script>
</body>
</body>
</html>