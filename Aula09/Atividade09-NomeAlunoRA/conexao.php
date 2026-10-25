<?php
/* ==========================================================================
   Atividade 09 - Conexão PDO com o MySQL do Container (GitHub Codespaces)
   ========================================================================== */

$host    = '127.0.0.1';
$banco   = 'aula_php';
$usuario = 'root';
$senha   = 'root';

try {
    $dsn = "mysql:host=$host;dbname=$banco;charset=utf8mb4";
    $pdo = new PDO($dsn, $usuario, $senha, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Cria a tabela 'chamados_suporte' caso ainda não exista no banco 'aula_php'
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS chamados_suporte (
            id INT AUTO_INCREMENT PRIMARY KEY,
            solicitante VARCHAR(100) NOT NULL,
            setor VARCHAR(60) NOT NULL,
            prioridade VARCHAR(30) NOT NULL,
            descricao TEXT NOT NULL,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
} catch (PDOException $erro) {
    die("Erro na conexão com o banco: " . htmlspecialchars($erro->getMessage()));
}

