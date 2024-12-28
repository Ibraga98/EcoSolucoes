<?php
session_start();
// Temporary fix: Ensure every cart item has an 'id'
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as &$item) {
        if (!isset($item['id'])) {
            $item['id'] = uniqid(); // Assign a unique ID to old items
        }
    }
    unset($item); // Break the reference to avoid unexpected behavior
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="../js/cart-handler.js" defer></script>
    <title>Carrinho Ecológico</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            background-color: #F0FFF0;
            font-family: Arial, sans-serif;
        }

        header, footer {
            background-color: #2E8B57;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        #checkout:hover {
            background-color: #228B22;
        }
    </style>
</head>
<body>
<header>
    <h1 style="color: #2E8B57;">O seu Carrinho</h1>
</header>
<main>
    <div id="cart">
        <h2 style="color: #227D51;">Produtos no Carrinho</h2>
        <table id="cart-items" style="width:100%; border-collapse: collapse; text-align: left;">
            <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px;">Produto</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Preço</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => $item) {
                    echo "<tr>";
                    echo "<td style='border: 1px solid #ddd; padding: 8px;'>🌿 " . htmlspecialchars($item['name']) . "</td>";
                    echo "<td style='border: 1px solid #ddd; padding: 8px;'>€" . number_format((float)$item['price'], 2, '.', '') . "</td>";
                    echo "<td style='border: 1px solid #ddd; padding: 8px; text-align: center;'>";
                    echo "<form action='remove-from-cart.php' method='POST' style='display:inline;'>";
                    echo "<input type='hidden' name='product_id' value='" . $item['id'] . "'>";
                    echo "<button type='submit' style='background-color: red; color: white; border: none; padding: 5px; border-radius: 5px;'>Remover</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td colspan='3' style='border: 1px solid #ddd; padding: 8px; text-align: center;'>Carrinho vazio</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <button id="checkout"
                style="background-color: #32CD32; color: white; border: none; padding: 10px; border-radius: 5px; margin-top: 10px;">
            Finalizar Compra
        </button>
        <button onclick="location.href='products.php'"
                style="background-color: #90EE90; color: white; border: none; padding: 10px; border-radius: 5px; margin-left: 5px;">
            Voltar para Produtos
        </button>
    </div>
</main>
<footer>
    <p style="color: #006400;">&copy; 2024 EcoSoluções. Todos os direitos reservados.</p>
</footer>
</body>
</html>
