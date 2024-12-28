<?php
$arquivo = 'C:\xampp\htdocs\EcoSolucoes\contador.txt';

// Verifica se o arquivo existe
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, 0); // Cria o arquivo, se não existir
}

// Lê o valor atual
$visitas = (int)file_get_contents($arquivo);

// Incrementa o valor
$visitas++;

// Atualiza o arquivo com o novo valor
file_put_contents($arquivo, $visitas);

// Exibe o valor
echo $visitas;


