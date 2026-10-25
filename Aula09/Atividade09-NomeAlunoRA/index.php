<?php
/* ==========================================================================
   Atividade de Laboratório 09 - Help Desk em PHP + MySQL (Codespaces)
   Aluno(a): [Preencha seu Nome Completo]
   RA: [Preencha seu RA]
   ========================================================================== */

require_once __DIR__ . '/conexao.php';

$mensagemFeedback = "";
$tipoFeedback     = ""; // "sucesso" ou "erro"

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- 🟢 DESAFIO 1 (Aquecimento): Captura de Dados via $_POST ---
    // Capture os 4 campos do formulário HTML abaixo usando $_POST e trim()
    $solicitante = trim($_POST['txtSolicitante'] ?? '');
    $setor       = trim($_POST['selSetor'] ?? '');
    $prioridade  = trim($_POST['selPrioridade'] ?? '');
    $descricao   = trim($_POST['txtDescricao'] ?? '');

    // --- 🟡 DESAFIO 2 (Aplicação): Validação Back-end e Gravação no MySQL ---
    // Regra A: Nenhum dos 4 campos pode estar vazio ('')
    // Regra B: A descrição do problema deve ter no mínimo 10 caracteres (use strlen($descricao) < 10)
    if ($solicitante === '' || $setor === '' || $prioridade === '' || $descricao === '') {
        $mensagemFeedback = "Preencha todos os campos obrigatórios do chamado!";
        $tipoFeedback     = "erro";
    } elseif (strlen($descricao) < 10) {
        $mensagemFeedback = "A descrição do problema deve ter pelo menos 10 caracteres.";
        $tipoFeedback     = "erro";
    } else {
        // Grave o chamado na tabela 'chamados_suporte' usando Prepared Statement ($pdo->prepare)
        $sql = "INSERT INTO chamados_suporte (solicitante, setor, prioridade, descricao) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$solicitante, $setor, $prioridade, $descricao]);

        $mensagemFeedback = "Chamado aberto com sucesso para " . htmlspecialchars($solicitante) . "!";
        $tipoFeedback     = "sucesso";
    }
}

// Busca todos os chamados salvos no MySQL para listar na tabela abaixo
$listaChamados = $pdo->query("SELECT * FROM chamados_suporte ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Atividade 09 - Help Desk PHP + MySQL</title>
    <link rel="stylesheet" type="text/css" href="estilo.css" />
</head>
<body>

    <div id="conteudo">
        <h2>Atividade 09: Central de Chamados (Help Desk)</h2>
        <p class="instrucao">
            Preencha o formulário abaixo para registrar um chamado técnico no banco <code>aula_php</code>.
            Depois, confira os registros diretamente no <strong>phpMyAdmin (Porta 8080)</strong>!
        </p>

        <?php if ($mensagemFeedback !== ""): ?>
            <div class="status-box <?= $tipoFeedback ?>">
                <?= $mensagemFeedback ?>
            </div>
        <?php endif; ?>

        <form action="index.php" method="POST">
            <div class="grupo-campo">
                <label for="txtSolicitante">Nome do Solicitante:</label>
                <input type="text" id="txtSolicitante" name="txtSolicitante" class="campo" placeholder="Digite seu nome completo" />
            </div>

            <div class="grupo-campo">
                <label for="selSetor">Setor / Departamento:</label>
                <select id="selSetor" name="selSetor" class="campo">
                    <option value="">-- Selecione o setor --</option>
                    <option value="Financeiro">Financeiro</option>
                    <option value="Recursos Humanos">Recursos Humanos</option>
                    <option value="TI / Desenvolvimento">TI / Desenvolvimento</option>
                    <option value="Comercial">Comercial</option>
                </select>
            </div>

            <div class="grupo-campo">
                <label for="selPrioridade">Prioridade do Chamado:</label>
                <select id="selPrioridade" name="selPrioridade" class="campo">
                    <option value="">-- Selecione a prioridade --</option>
                    <option value="Baixa">Baixa</option>
                    <option value="Média">Média</option>
                    <option value="Alta">Alta (Urgente)</option>
                </select>
            </div>

            <div class="grupo-campo">
                <label for="txtDescricao">Descrição do Problema (mínimo 10 caracteres):</label>
                <textarea id="txtDescricao" name="txtDescricao" class="campo" placeholder="Descreva detalhadamente o problema ocorrido..."></textarea>
            </div>

            <div class="grupo-botoes">
                <button type="submit" class="botao botao-primario">Registrar Chamado</button>
                <a href="index.php" class="botao botao-secundario">Recarregar</a>
            </div>
        </form>

        <!-- 🔴 DESAFIO 3 (Extra): Exibição dos Chamados + Teste no phpMyAdmin -->
        <h3>Chamados Registrados no MySQL (Tabela: <code>chamados_suporte</code>)</h3>

        <?php if (count($listaChamados) === 0): ?>
            <p class="instrucao">Nenhum chamado registrado ainda.</p>
        <?php else: ?>
            <table class="tabela-dados">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Solicitante</th>
                        <th>Setor</th>
                        <th>Prioridade</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaChamados as $chamado): ?>
                        <?php
                        // Define a cor do badge conforme a prioridade
                        $classeBadge = 'badge-ok';
                        if ($chamado['prioridade'] === 'Média') {
                            $classeBadge = 'badge-alerta';
                        } elseif ($chamado['prioridade'] === 'Alta') {
                            $classeBadge = 'badge-erro';
                        }
                        ?>
                        <tr>
                            <td>#<?= $chamado['id'] ?></td>
                            <td><strong><?= htmlspecialchars($chamado['solicitante']) ?></strong></td>
                            <td><?= htmlspecialchars($chamado['setor']) ?></td>
                            <td><span class="badge <?= $classeBadge ?>"><?= htmlspecialchars($chamado['prioridade']) ?></span></td>
                            <td><?= htmlspecialchars($chamado['descricao']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>
</html>

