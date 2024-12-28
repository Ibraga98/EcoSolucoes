<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']); // Sanitize product ID

    // Check if the cart exists
    if (isset($_SESSION['cart'])) {
        // Loop through the cart and remove the item with the matching ID
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] === $product_id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }

        // Re-index the cart array to prevent gaps
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Redirect back to the cart page
header("Location: cart.php");
exit();
