<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: url("https://images.pexels.com/photos/417074/pexels-photo-417074.jpeg") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: rgba(0, 0, 0, 0.6);
            width: 350px;
            padding: 40px;
            border-radius: 10px;
            color: #fff;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .login-box .input-box {
            position: relative;
            margin-bottom: 25px;
        }

        .login-box .input-box input {
            width: 100%;
            padding: 10px;
            background: transparent;
            border: none;
            border-bottom: 2px solid #fff;
            outline: none;
            color: #fff;
            font-size: 16px;
        }

        .login-box .input-box label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            pointer-events: none;
            transition: 0.5s;
            color: #ccc;
        }

        .login-box .input-box input:focus~label,
        .login-box .input-box input:valid~label {
            top: -18px;
            left: 0;
            color: #03a9f4;
            font-size: 12px;
        }

        .login-box button {
            width: 100%;
            background: #03a9f4;
            border: none;
            padding: 10px;
            border-radius: 25px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-box button:hover {
            background: #0288d1;
        }

        .login-box a {
            display: block;
            text-align: center;
            color: #ccc;
            font-size: 14px;
            text-decoration: none;
            margin-top: 15px;
        }

        .login-box a:hover {
            color: #03a9f4;
        }
    </style>
    <!-- Variable base_url (de tu código) -->
    <script>
        const base_url = '<?= BASE_URL; ?>';
    </script>
</head>

<body>

    <div class="login-box">
        <h2>Sistema de Ventas</h2>
        <form action="validar_login.php" method="POST" id="frm_login" name="frm_login">
            <div class="input-box">
                <input type="text" name="usuario" id="usuario" required>
                <label>Username</label>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" required>
                <label>Password</label>
            </div>
            <button type="button" onclick="iniciar_sesion();">Iniciar Sesión</button>
            <a href="#">¿Olvidaste tu contraseña?</a>
        </form>
    </div>
    <!-- Script de tu lógica (de tu código) -->
    <script src="<?php echo BASE_URL; ?>views/function/user.js"></script>
</body>

</html>