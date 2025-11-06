<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lottie CDN (de tu código) -->
    <script src="https://unpkg.com/lottie-web@5.7.4/build/player/lottie.min.js"></script>

    <!-- Google Font: Inter (para una tipografía más limpia) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Usamos Inter como fuente principal */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Mantenemos tu animación de "flotar" original */
        #robot-container {
            animation: flotar 3s ease-in-out infinite;
        }

        @keyframes flotar {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
    
    <!-- Variable base_url (de tu código) -->
    <script>
        const base_url = '<?=BASE_URL; ?>';
    </script>
</head>
<body class="bg-gray-100 flex flex-col justify-center items-center min-h-screen p-4">

    <!-- Animación Lottie del robot (mantenemos tu ID y tamaño) -->
    <div id="robot-container" class="w-[150px] h-[150px] mb-5"></div>

    <!-- Formulario de login (rediseñado con Tailwind) -->
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-sm">
        
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Iniciar Sesión</h2>
        
        <!-- Este es un buen lugar para que tu user.js muestre mensajes de error -->
        <!-- <div id="message-box" class="hidden text-red-600 text-sm text-center mb-4"></div> -->

        <form action="validar_login.php" method="POST" id="frm_login" name="frm_login">
            
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

    <!-- Script para cargar animación de robot (de tu código) -->
    <script>
        lottie.loadAnimation({
            container: document.getElementById('robot-container'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'https://assets3.lottiefiles.com/packages/lf20_tno6cg2w.json' // Robot animado
        });
    </script>
    
    <!-- Script de tu lógica (de tu código) -->
    <script src="<?php echo BASE_URL; ?>views/function/user.js"></script>
    
</body>
</html>
