<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoSoluções</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #e8f5e9;
            color: #1b5e20;
        }

        img.EcoSoluções {
            max-width: 100%;
            border: 5px solid #2e7d32;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        header {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style-type: none;
            display: flex;
            justify-content: center;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: 700;
        }

        nav ul li a:hover {
            color: #a5d6a7;
        }

        main {
            flex: 1;
            text-align: center;
            padding: 20px;
        }

        .image-container {
            margin: 20px auto;
        }

        footer {
            background-color: #1b5e20;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
<header>
    <h1>EcoSoluções</h1>
    <nav>
        <ul>
            <li><a href="login.html">Login</a></li>
            <li><a href="register.html">Registrar</a></li>
        </ul>
    </nav>
</header>
<div id="counter-container" style="text-align:center; padding:10px; background-color:#dcedc8; color:#33691e; font-weight:bold;"></div>
<main>
    <section class="welcome">
        <div class="image-container">
            <img src="images/index/ecosolucoeshome.jpg"
                 alt="Imagem ilustrativa representando soluções ecológicas e sustentáveis" class="EcoSoluções">
        </div>
        <h2>Bem-vindo à EcoSoluções!</h2>
        <p> A sua loja de produtos sustentáveis.</p>
    </section>
</main>
<footer>
    <p>&copy; 2024 EcoSoluções</p>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            const response = await fetch('php/contador.php');
            if (response.ok) {
                const count = await response.text();
                document.getElementById('counter-container').innerHTML = `<strong id='contador'>Visitas: ${count}</strong>`;
            } else {
                console.error('Erro ao carregar o contador.');
            }
        } catch (error) {
            console.error('Erro:', error);
        }
    });
</script>
<script src="js/auth.js" defer></script>
</body>
</html>

