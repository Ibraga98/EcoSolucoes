<?php

// Configuração de conexão ao banco de dados
$server = "localhost"; // Endereço do servidor (localhost no XAMPP)
$username = "root";    // Nome de usuário do banco (padrão no XAMPP é "root")
$password = "";        // Senha do banco (vazia no XAMPP por padrão)
$database = "negocio_eletronico"; // Nome do banco de dados

// Criar conexão
$conn = new mysqli($server, $username, $password, $database);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>