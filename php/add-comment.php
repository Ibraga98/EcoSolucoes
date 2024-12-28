<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user']['id'])) {
    header("Location: login.php");
    exit("Por favor, faça login para acessar esta página.");
}

include_once 'db_connect.php';

// Enable error display for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the request is POST and contains required fields
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['comment'])) {
    $product_id = intval($_POST['product_id']);
    $comment = trim($_POST['comment']);

    // Ensure the comment is not empty
    if (empty($comment)) {
        die("Por favor, insira um comentário válido.");
    }

    // Ensure the product exists in the database
    $query = "SELECT id FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Produto não encontrado.");
    }

    // Insert the comment into the database
    $user_id = $_SESSION['user']['id'];
    $insert_query = "INSERT INTO comments (product_id, user_id, comment) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iis", $product_id, $user_id, $comment);

    if ($stmt->execute()) {
        // Redirect back to the product details page
        header("Location: product-details.php?product_id=$product_id");
        exit();
    } else {
        echo "Erro ao adicionar comentário: " . $conn->error;
    }
} else {
    echo "Dados inválidos. Por favor, tente novamente.";
    exit();
}
