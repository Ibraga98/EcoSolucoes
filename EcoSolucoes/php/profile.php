<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.html");
    exit();
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <h1>O Meu Perfil</h1>
    <nav>
        <ul>
            <li><a href="products.php">Produtos</a></li>
            <li><a href="../jobs.html">Vagas Disponíveis</a></li>
        </ul>
    </nav>
</header>
<main>
    <section>
        <h2>Bem-vindo, <?php echo htmlspecialchars($user['username']); ?>!</h2>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <a href="logout.php" class="logout-btn">Sair</a> <!-- Logout button -->
    </section>
</main>
<footer>
    <p>&copy; 2024 EcoSoluções</p>
</footer>
</body>
</html>
