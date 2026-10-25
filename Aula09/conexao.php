<?php
/* ==========================================================================
   Aula 09 - Conexão com o Banco de Dados MySQL (MariaDB) via PDO
   Substituindo o MySQL local do XAMPP pelo Container do GitHub Codespaces
   ========================================================================== */

$host    = '127.0.0.1'; // Endereço interno do container (também aceita 'localhost')
$banco   = 'aula_php';  // Criado automaticamente pelo Dockerfile
$usuario = 'root';      // Usuário padrão configurado no container
$senha   = 'root';      // Senha padrão configurada no container

try {
    // DSN (Data Source Name): informa qual driver (mysql), onde está o banco e o charset UTF-8
    $dsn = "mysql:host=$host;dbname=$banco;charset=utf8mb4";

    // Instancia o objeto PDO (PHP Data Objects) habilitado lá no nosso php.ini
    $pdo = new PDO($dsn, $usuario, $senha, [
        // Lança exceções detalhadas caso haja erro de SQL (fundamental para aprender e debugar)
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        // Traz os resultados do banco como Array Associativo ($linha['nome'])
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Garante que a tabela 'usuarios' exista mesmo se o aluno ainda não importou o banco.sql no phpMyAdmin
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(120) NOT NULL,
            curso VARCHAR(80) NOT NULL,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");

} catch (PDOException $erro) {
    // Em ambiente de aula, exibimos o motivo técnico caso o serviço MariaDB esteja parado
    die("<div style='background:#fff2f2;color:#d9534f;padding:15px;border:1px solid #d9534f;font-family:sans-serif;'>
            <strong>❌ Erro ao conectar no MySQL do Container:</strong> " . htmlspecialchars($erro->getMessage()) . "<br>
            <small>Dica: No terminal do Codespaces, verifique se o banco está rodando com: <code>service mariadb status</code></small>
         </div>");
}

