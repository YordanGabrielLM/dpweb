<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error 404 - Página no encontrada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
  
    <script src="https://unpkg.com/lottie-web@5.7.4/build/player/lottie.min.js"></script>

    <style>
        body {
            background: linear-gradient(to right, #f1f5f8, #f2f4f5);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }

        #robot-404 {
            width: 250px;
            height: 250px;
            animation: flotar 4s ease-in-out infinite;
        }

        @keyframes flotar {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        h1 {
            font-size: 5rem;
            color:rgba(15, 14, 14, 0.7);
            margin-bottom: 0;
        }

        p {
            font-size: 1.3rem;
            color: #6c757d;
            margin-bottom: 30px;
        }

        a {
            padding: 10px 20px;
            background-color:rgb(33, 95, 36);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }

        a:hover {
            background-color:rgb(20, 20, 20);
        }
    </style>
</head>
<body>

    <!-- Animación de robot triste -->
    <div id="robot-404"></div>

    <h1>ERROR</h1>
    <p> Página no encontrada.</p>
    <a href="login">Volver al inicio</a>

    <script>
        lottie.loadAnimation({
            container: document.getElementById('robot-404'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'https://assets7.lottiefiles.com/packages/lf20_d7wph3ua.json'
        });
    </script>
</body>
</html>



