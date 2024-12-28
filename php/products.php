<?php
session_start();
include_once 'db_connect.php';

// Handle the search query
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($search_query) {
    $query = "SELECT id, name, price, image FROM products WHERE name LIKE ? OR description LIKE ?";
    $stmt = $conn->prepare($query);
    $search_term = '%' . $search_query . '%';
    $stmt->bind_param("ss", $search_term, $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $query = "SELECT id, name, price, image FROM products";
    $result = $conn->query($query);
}

// Check for query errors
if (!$result) {
    die("Erro ao buscar produtos: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        /* Grid layout for products */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 20px;
            padding: 20px;
        }

        .product {
            border: 2px solid #1b5e20;
            border-radius: 6px;
            padding: 10px;
            background-color: #f1f8e9;
            text-align: center;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer; /* Indicates that the image is clickable */
        }

        .product h2 {
            color: #1b5e20;
        }

        .product p {
            font-weight: bold;
        }

        .product form button {
            background-color: #2e7d32;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
        }

        .product form button:hover {
            background-color: #1b5e20;
        }

        .product a {
            text-decoration: none;
            color: #1b5e20;
        }

        .product a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header style="background-color: #1b5e20; padding: 15px 0; text-align: center; color: white;">
    <h1>Produtos Disponíveis</h1>
    <nav>
        <ul>
            <li><a href="../index.php">Página inicial</a></li>
            <li><a href="cart.php">Carrinho</a></li>
            <li><a href="profile.php">O Meu Perfil</a></li>
        </ul>
    </nav>
</header>
<main style="background-color: #e8f5e9; padding: 25px; border-radius: 10px;">
    <!-- Search Form -->
    <form method="GET" action="products.php" style="margin-bottom: 20px; text-align: center;">
        <input type="text" name="search" placeholder="Buscar produtos..." value="<?php echo htmlspecialchars($search_query); ?>" style="padding: 7px; width: 60%; border: 1px solid #1b5e20; border-radius: 4px;">
        <button type="submit" style="padding: 7px 15px; background-color: #1b5e20; color: white; border: none; border-radius: 4px;">Buscar</button>
    </form>

    <div class="grid-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="product">
                    <!-- Clickable image redirects to product-details.php -->
                    <a href="product-details.php?product_id=<?php echo $product['id']; ?>">
                        <div class="product-image">
                            <img src="../images/products/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    </a>
                    <p>Preço: <?php echo number_format($product['price'], 2, ',', '.'); ?> €</p>
                    <form action="add-to-cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                        <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                        <button type="submit">Adicionar ao Carrinho</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center; color: #1b5e20;">Nenhum produto encontrado para "<?php echo htmlspecialchars($search_query); ?>"</p>
        <?php endif; ?>
    </div>
</main>
<footer style="background-color: #1b5e20; color: white; padding: 20px; text-align: center;">
    <p>&copy; 2024 EcoSoluções. Todos os direitos reservados. | <a href="../privacy.html" style="color: #a5d6a7;">Política de Privacidade</a></p>
</footer>
</body>
</html>
