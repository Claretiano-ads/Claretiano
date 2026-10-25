<?php
/* ==========================================================================
   Aula 09 - Laboratório 06: O Primeiro Back-End da Editora Br@sil
   Conceitos: Delimitadores <?php ?>, Variáveis ($), Concatenação (.), echo e $_POST
   ========================================================================== */

// 1. Recebendo os dados enviados pelo formulário HTML através da Superglobal $_POST
// O índice entre colchetes deve ser idêntico ao atributo name="" do <input> no HTML!
$nome = $_POST['nome_assinante'] ?? 'Assinante não informado';
$plano = $_POST['plano_escolhido'] ?? 'Plano não selecionado';

// 2. Criando variáveis de controle e boas-vindas no Servidor
$dataRegistro = date("d/m/Y"); // Função nativa do PHP para pegar a data atual do servidor
$horaRegistro = date("H:i:s"); // Hora exata do processamento no servidor

// 3. Exemplo de Concatenação em PHP: usamos o ponto (.) para juntar textos e variáveis
$mensagemBoasVindas = "Olá, " . $nome . "! Seu pedido foi recebido pelo servidor da Editora Br@sil.";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Assinatura - Editora Br@sil</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

    <div id="conteudo">
        <h2>Assinatura Recebida com Sucesso!</h2>
        <hr>

        <!-- Exibindo a variável concatenada com o comando echo -->
        <p class="subtitulo">
            <?php echo $mensagemBoasVindas; ?>
        </p>

        <div class="comprovante-box">
            <p><strong>Prezado(a):</strong> <?php echo $nome; ?></p>
            <p><strong>Plano Contratado:</strong> <?php echo $plano; ?></p>
            <p><strong>Data de Processamento:</strong> <?php echo $dataRegistro . " às " . $horaRegistro; ?></p>
        </div>

        <div class="aviso-sucesso">
            <em>Os dados foram validados pelo servidor PHP e estão prontos para envio ao banco de dados!</em>
        </div>

        <a href="cadastro.html" class="botao botao-voltar">&larr; Voltar ao formulário</a>
    </div>

</body>
</html>

