<?php
/* ==========================================================================
   Atividade de Laboratório 09 - O Primeiro Back-End da Editora Br@sil
   Aluno(a): [Preencha seu Nome Completo]
   RA: [Preencha seu RA]
   ==========================================================================

   INSTRUÇÕES PARA O ALUNO (FAÇA AQUI NO TOPO DO ARQUIVO):

   🟢 PASSO 1 (Aquecimento - Superglobal $_POST e Variáveis):
   Crie 5 variáveis em PHP (lembre-se do cifrão $ e do ponto e vírgula ;)
   para receber os campos enviados pelo formulário 'cadastro.html':
   - $nome      -> deve receber $_POST['nome_assinante']
   - $email     -> deve receber $_POST['email_assinante']
   - $cidade    -> deve receber $_POST['cidade_assinante']
   - $plano     -> deve receber $_POST['plano_escolhido']
   - $pagamento -> deve receber $_POST['forma_pagamento']

   Crie também a variável $dataRegistro usando a função date("d/m/Y").

   🟡 PASSO 2 (Aplicação - Concatenação com Ponto):
   Crie uma variável chamada $resumoEntrega que junte (concatene com o ponto .)
   o nome do assinante, a cidade e o e-mail em uma única frase.
   Exemplo: "O assinante " . $nome . " receberá a revista em " . $cidade . "."

   🔴 PASSO 3 (Desafio Extra - Protocolo Dinâmico):
   Crie uma variável chamada $protocolo que concatene a sigla "BR-",
   o ano atual usando date("Y") e um número sorteado usando rand(1000, 9999).

   ========================================================================== */

// ESCREVA SEU CÓDIGO PHP ABAIXO DESTA LINHA:




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

        <!-- 🔴 PASSO 3: Substitua o texto fixo abaixo pelo comando PHP echo da variável $protocolo -->
        <div class="protocolo-destaque">
            Protocolo de Atendimento: <!-- Exiba aqui o $protocolo com <?php echo ...; ?> -->
        </div>

        <!-- 🟢 PASSO 1: Use <?php echo ...; ?> em cada linha abaixo para exibir as variáveis capturadas -->
        <div class="comprovante-box">
            <p><strong>Prezado(a):</strong> <!-- Exiba aqui a variável $nome --></p>
            <p><strong>E-mail Cadastrado:</strong> <!-- Exiba aqui a variável $email --></p>
            <p><strong>Cidade de Entrega:</strong> <!-- Exiba aqui a variável $cidade --></p>
            <p><strong>Plano Contratado:</strong> <!-- Exiba aqui a variável $plano --></p>
            <p><strong>Forma de Pagamento:</strong> <!-- Exiba aqui a variável $pagamento --></p>
            <p><strong>Data de Processamento:</strong> <!-- Exiba aqui a variável $dataRegistro --></p>
        </div>

        <!-- 🟡 PASSO 2: Exiba abaixo a frase concatenada na variável $resumoEntrega usando <?php echo ...; ?> -->
        <div class="aviso-sucesso">
            <strong>Resumo do Pedido:</strong><br>
            <em><!-- Exiba aqui a variável $resumoEntrega --></em>
        </div>

        <a href="cadastro.html" class="botao botao-voltar">&larr; Voltar ao formulário</a>
    </div>

</body>
</html>
