<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

global $conn;
include_once 'db_connect.php';

if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']));

    if ($action === 'register') {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<script>alert('Email já registrado.');</script>";
                exit();
            }
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $username, $email, $hashedPassword);
            if ($stmt->execute()) {
                echo "<script>alert('Usuário registrado com sucesso!');</script>";
                header("Location: ../login.html");
                exit();
            } else {
                echo "Erro ao registrar usuário: " . $conn->error;
            }
        }
    } elseif ($action === 'login') {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password'])) {
                    // Store user details in session
                    $_SESSION['user'] = [
                        'id' => $user['id'],            // Store user ID
                        'username' => $user['username'], // Store username
                        'email' => $user['email'],      // Store email
                        'role' => $user['role']         // Store role (optional)
                    ];
                    header("Location: ../php/profile.php");
                    exit();
                } else {
                    echo "<script>alert('Senha incorreta!');</script>";
                }
            } else {
                echo "<script>alert('Conta não encontrada!');</script>";
            }
        }
    } else {
        echo "Ação inválida.";
        exit();
    }
}
?>
