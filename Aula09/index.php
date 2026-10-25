<?php
/* ==========================================================================
   Aula 09 - Introdução ao PHP no Servidor + Banco de Dados MySQL (PDO)
   Evolução da Aula 08: Agora os dados saem do navegador e são salvos no banco!
   ========================================================================== */

// 1. Inclui a conexão com o banco de dados MySQL (cria a variável $pdo)
require_once __DIR__ . '/conexao.php';

$mensagemFeedback = "";
$tipoFeedback     = ""; // "sucesso" ou "erro"

// 2. Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados enviados pelo formulário HTML e remove espaços extras com trim()
    $nome  = trim($_POST['txtNome'] ?? '');
    $email = trim($_POST['txtEmail'] ?? '');
    $curso = trim($_POST['selCurso'] ?? '');

    // 3. Validação no Back-end (Nunca confie apenas na validação JavaScript do navegador!)
    if ($nome === '' || $email === '' || $curso === '') {
        $mensagemFeedback = "Por favor, preencha todos os campos obrigatórios.";
        $tipoFeedback     = "erro";
    } elseif (! str_contains($email, '@')) {
        $mensagemFeedback = "Informe um endereço de e-mail válido (deve conter @).";
        $tipoFeedback     = "erro";
    } else {
        // 4. Segurança por Padrão: Usamos Prepared Statements (?) para evitar SQL Injection!
        $sqlInsert = "INSERT INTO usuarios (nome, email, curso) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->execute([$nome, $email, $curso]);

        $mensagemFeedback = "Aluno(a) " . htmlspecialchars($nome) . " cadastrado(a) com sucesso no MySQL!";
        $tipoFeedback     = "sucesso";
    }
}

// 5. Busca todos os usuários cadastrados no banco para exibir na tabela HTML abaixo
$listaUsuarios = $pdo->query("SELECT id, nome, email, curso, criado_em FROM usuarios ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aula 09 - Cadastro em PHP + MySQL (Codespaces)</title>
    <link rel="stylesheet" type="text/css" href="estilo.css" />
</head>
<body>

    <div id="conteudo">
        <!-- Barra superior com atalho para o Raio-X do ambiente -->
        <div class="barra-topo">
            <span><strong>Servidor PHP <?= PHP_VERSION ?></strong> | Banco: <code>aula_php</code></span>
            <a href="diagnostico.php">🔍 Ver Raio-X do Container (XAMPP vs Docker)</a>
        </div>

        <h2>Matrícula de Alunos (PHP + MySQL)</h2>
        <p class="subtitulo">
            Diferente da Aula 08 (onde os dados ficavam apenas na memória do navegador com JavaScript),
            este formulário envia os dados via <code>POST</code> para o <strong>PHP</strong> gravar no <strong>MySQL</strong>.
            Você pode conferir os dados salvos abrindo o <strong>phpMyAdmin na Porta 8080</strong>!
        </p>

        <!-- Exibe a caixa de feedback caso o PHP tenha processado um envio -->
        <?php if ($mensagemFeedback !== ""): ?>
            <div class="status-box <?= $tipoFeedback ?>">
                <?= $mensagemFeedback ?>
            </div>
        <?php endif; ?>

        <!-- Atenção aos atributos essenciais para o PHP: action="index.php", method="POST" e atributo "name" nos campos -->
        <form action="index.php" method="POST">
            <div class="grupo-campo">
                <label for="txtNome">Nome Completo:</label>
                <input type="text" id="txtNome" name="txtNome" class="campo" placeholder="Ex: João da Silva" required />
            </div>

            <div class="grupo-campo">
                <label for="txtEmail">E-mail Acadêmico:</label>
                <input type="email" id="txtEmail" name="txtEmail" class="campo" placeholder="Ex: joao.silva@claretiano.edu.br" required />
            </div>

            <div class="grupo-campo">
                <label for="selCurso">Curso:</label>
                <select id="selCurso" name="selCurso" class="campo" required>
                    <option value="">-- Selecione o curso --</option>
                    <option value="Análise e Desenvolvimento de Sistemas">Análise e Desenvolvimento de Sistemas (ADS)</option>
                    <option value="Engenharia de Software">Engenharia de Software</option>
                    <option value="Banco de Dados">Banco de Dados</option>
                    <option value="Redes de Computadores">Redes de Computadores</option>
                </select>
            </div>

            <div class="grupo-botoes">
                <button type="submit" class="botao botao-primario">Salvar no Banco de Dados</button>
                <a href="index.php" class="botao botao-secundario">Atualizar Lista</a>
            </div>
        </form>

        <!-- Listagem dinâmica gerada pelo PHP lendo direto do MySQL -->
        <h3>Alunos Cadastrados no Banco (Tabela: <code>usuarios</code>)</h3>

        <?php if (count($listaUsuarios) === 0): ?>
            <p class="subtitulo">Nenhum aluno cadastrado ainda. Use o formulário acima!</p>
        <?php else: ?>
            <table class="tabela-dados">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Curso</th>
                        <th>Data/Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaUsuarios as $usuario): ?>
                        <tr>
                            <td>#<?= $usuario['id'] ?></td>
                            <!-- htmlspecialchars evita ataques XSS caso alguém digite tags HTML no nome -->
                            <td><strong><?= htmlspecialchars($usuario['nome']) ?></strong></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td><?= htmlspecialchars($usuario['curso']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($usuario['criado_em'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>
</html>

