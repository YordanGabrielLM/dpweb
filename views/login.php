<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Lottie -->
    <script src="https://unpkg.com/lottie-web@5.7.4/build/player/lottie.min.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #e0f7fa, #e1f5fe);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .login-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-box input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .login-box button {
            width: 100%;
            padding: 10px;
            background-color: #0077b6;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .login-box button:hover {
            background-color: #023e8a;
        }

        #robot-container {
            width: 150px;
            height: 150px;
            margin-bottom: 20px;
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
<body>

    <!-- Animación Lottie del robot -->
    <div id="robot-container" class="animate__animated animate__fadeInDown"></div>

    <!-- Formulario de login -->
    <div class="login-box animate__animated animate__fadeInUp">
        <h2>Iniciar Sesión</h2>
        <form action="validar_login.php" method="POST" id="frm_login" name="frm_login">
            <input type="text" name="usuario" placeholder="Usuario" id="usuario" required>
            <input type="password" name="password" placeholder="Contraseña" id="password" required>
            <button type="button" class="btn btn-primary w-100" onclick="iniciar_sesion();">Ingresar</button>
        </form>
    </div>

    <!-- Script para cargar animación de robot -->
    <script>
        lottie.loadAnimation({
            container: document.getElementById('robot-container'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'https://assets3.lottiefiles.com/packages/lf20_tno6cg2w.json' // Robot animado
        });
    </script>
    <script src="<?php echo BASE_URL; ?>views/function/user.js"></script>
</body>
</html>
