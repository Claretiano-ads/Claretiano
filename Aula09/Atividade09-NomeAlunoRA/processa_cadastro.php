<?php
/* ==========================================================================
   Atividade de Laboratório 09 - O Primeiro Back-End da Editora Br@sil
   Aluno(a): [Preencha seu Nome Completo]
   RA: [Preencha seu RA]
   ========================================================================== */

// --- 🟢 DESAFIO 1 (Aquecimento): Recebimento de Dados com $_POST ---
// Capture os 5 campos enviados pelo arquivo cadastro.html usando $_POST['nome_do_campo']
$nome      = $_POST['nome_assinante'] ?? '';
$email     = $_POST['email_assinante'] ?? '';
$cidade    = $_POST['cidade_assinante'] ?? '';
$plano     = $_POST['plano_escolhido'] ?? '';
$pagamento = $_POST['forma_pagamento'] ?? '';

// Data atual gerada pelo servidor PHP
$dataRegistro = date("d/m/Y");

// --- 🟡 DESAFIO 2 (Aplicação): Concatenação com Ponto (.) ---
// Crie uma frase concatenando o nome, a cidade e o e-mail do assinante usando o operador ponto (.)
$resumoEntrega = "O assinante " . $nome . " receberá os exemplares em " . $cidade . " e as notificações no e-mail " . $email . ".";

// --- 🔴 DESAFIO 3 (Desafio Extra): Protocolo Dinâmico de Assinatura ---
// Gere um protocolo juntando a sigla "BR-", o ano atual date("Y") e um número aleatório rand(1000, 9999)
$protocolo = "BR-" . date("Y") . "-" . rand(1000, 9999);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante de Assinatura - Editora Br@sil</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

    <div id="conteudo">
        <h2>Comprovante de Assinatura - Editora Br@sil</h2>
        <hr>

        <!-- Exibição do Protocolo gerado no Desafio 3 -->
        <div class="protocolo-destaque">
            Protocolo de Atendimento: <?php echo $protocolo; ?>
        </div>

        <!-- Exibição dos dados capturados no Desafio 1 usando echo -->
        <div class="comprovante-box">
            <p><strong>Prezado(a):</strong> <?php echo $nome; ?></p>
            <p><strong>E-mail Cadastrado:</strong> <?php echo $email; ?></p>
            <p><strong>Cidade de Entrega:</strong> <?php echo $cidade; ?></p>
            <p><strong>Plano Contratado:</strong> <?php echo $plano; ?></p>
            <p><strong>Forma de Pagamento:</strong> <?php echo $pagamento; ?></p>
            <p><strong>Data de Processamento:</strong> <?php echo $dataRegistro; ?></p>
        </div>

        <!-- Exibição da frase concatenada no Desafio 2 -->
        <div class="aviso-sucesso">
            <strong>Resumo do Pedido:</strong><br>
            <em><?php echo $resumoEntrega; ?></em>
        </div>

        <a href="cadastro.html" class="botao botao-voltar">&larr; Voltar ao formulário</a>
    </div>

</body>
</html>

