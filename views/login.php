<?php
// 🔐 CÓDIGO DE LOGOUT - Agregar al INICIO
require_once "./config/config.php";

// Manejar cierre de sesión
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    // Verificar si la sesión no está activa antes de iniciarla
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Limpiar todas las variables de sesión
    $_SESSION = array();
    
    // Destruir la sesión
    session_destroy();
    
    // Redirigir al login
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

// Si ya está logueado, redirigir al dashboard
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['ventas_id']) && isset($_SESSION['ventas_usuario'])) {
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lottie CDN -->
    <script src="<?php echo BASE_URL ?>views/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        #robot-container {
            animation: flotar 3s ease-in-out infinite;
        }
        @keyframes flotar {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
    
    <script>
        const base_url = '<?=BASE_URL; ?>';
    </script>
</head>
<body class="bg-gray-100 flex flex-col justify-center items-center min-h-screen p-4">

    <div id="robot-container" class="w-[150px] h-[150px] mb-5"></div>

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-sm">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Iniciar Sesión</h2>

        <form id="frm_login" name="frm_login">
            <input 
                type="text" 
                name="usuario" 
                placeholder="Usuario" 
                id="usuario" 
                class="w-full p-3 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                required>
            
            <input 
                type="password" 
                name="password" 
                placeholder="Contraseña" 
                id="password" 
                class="w-full p-3 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                required>
            
            <button 
                type="button" 
                class="w-full p-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-all duration-300 shadow-md hover:shadow-lg" 
                onclick="iniciar_sesion();">
                Ingresar
            </button>
        </form>
    </div>

    <script>
        lottie.loadAnimation({
            container: document.getElementById('robot-container'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'https://assets3.lottiefiles.com/packages/lf20_tno6cg2w.json'
        });
    </script>
    
    <script src="<?php echo BASE_URL; ?>views/function/user.js"></script>
</body>
</html>