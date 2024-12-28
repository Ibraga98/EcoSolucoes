<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    // Retrieve and sanitize product details from the form submission
    $product_id = intval($_POST['product_id']); // Ensure ID is an integer
    $product_name = htmlspecialchars(trim($_POST['product_name'])); // Sanitize name
    $product_price = floatval($_POST['product_price']); // Ensure price is a float

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in the cart
    $already_in_cart = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $product_id) {
            // Optionally increment quantity or handle logic here
            $already_in_cart = true;
            break;
        }
    }

    // Add product to the cart if not already present
    if (!$already_in_cart) {
        $_SESSION['cart'][] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
        ];
    }

    // Redirect back to the products page
    header("Location: products.php");
    exit();
}
