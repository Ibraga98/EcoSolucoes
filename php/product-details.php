<?php
session_start();
include_once 'db_connect.php';

// Get the product ID from the query string
if (!isset($_GET['product_id'])) {
    die("Produto não encontrado.");
}
$product_id = intval($_GET['product_id']);

// Fetch product details
$query = "SELECT id, name, price, image, description FROM products WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    die("Produto não encontrado.");
}

// Fetch comments for this product
$comment_query = "SELECT c.comment, u.username, c.created_at 
                  FROM comments c 
                  JOIN users u ON c.user_id = u.id 
                  WHERE c.product_id = ? ORDER BY c.created_at DESC";
$stmt = $conn->prepare($comment_query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$comments = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header style="background-color: #1b5e20; padding: 15px 0; text-align: center; color: white;">
    <h1><?php echo htmlspecialchars($product['name']); ?></h1>
</header>
<main style="background-color: #e8f5e9; padding: 25px; border-radius: 10px;">
    <div class="product-details">
        <img src="../images/products/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="max-width: 300px;">
        <h2 style="color: #1b5e20;">Preço: <?php echo number_format($product['price'], 2, ',', '.'); ?> €</h2>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
    </div>

    <!-- Comments Section -->
    <div style="margin-top: 20px;">
        <h3>Comentários:</h3>
        <?php if ($comments->num_rows > 0): ?>
            <?php while ($comment = $comments->fetch_assoc()): ?>
                <p><strong><?php echo htmlspecialchars($comment['username']); ?>:</strong> <?php echo htmlspecialchars($comment['comment']); ?> (<?php echo $comment['created_at']; ?>)</p>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Sem comentários ainda.</p>
        <?php endif; ?>

        <!-- Add Comment Form -->
        <form action="add-comment.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <textarea name="comment" placeholder="Deixe seu comentário..." required></textarea>
            <button type="submit">Enviar</button>
        </form>


    </div>
</main>
<footer style="background-color: #1b5e20; color: white; padding: 20px; text-align: center;">
    <p>&copy; 2024 EcoSoluções. Todos os direitos reservados.</p>
</footer>
</body>
</html>
