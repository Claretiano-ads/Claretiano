<?php
/* ==========================================================================
   Aula 09 - Explicação Visual: Do XAMPP (htdocs) ao GitHub Codespaces (Docker)
   Demonstra variáveis básicas ($), concatenação (.) e comando echo
   ========================================================================== */

$nomeSistema     = "Sistema de Vendas - Editora Br@sil";
$versaoPhp       = PHP_VERSION;
$sistemaServidor = php_uname('s');
$pastaRaiz       = $_SERVER['DOCUMENT_ROOT'];
$dataAtual       = date("d/m/Y H:i:s");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raio-X do Servidor PHP - Aula 09</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

    <div id="conteudo">
        <div class="barra-servidor">
            <span><strong>Servidor Ativo!</strong></span>
            <a href="cadastro.html">&larr; Voltar para o Cadastro da Editora Br@sil</a>
        </div>

        <h2>Raio-X: XAMPP vs. GitHub Codespaces</h2>
        <p class="subtitulo">
            Arquivos <code>.php</code> não abrem com dois cliques! Eles precisam de um Servidor Web.
            Veja abaixo as informações geradas em tempo real pelo comando <code>echo</code> do PHP:
        </p>

        <div class="comprovante-box">
            <p><strong>Projeto:</strong> <?php echo $nomeSistema; ?></p>
            <p><strong>Sistema Operacional do Container:</strong> <code><?php echo $sistemaServidor; ?></code></p>
            <p><strong>Versão do PHP Executando:</strong> <code><?php echo "PHP " . $versaoPhp; ?></code></p>
            <p><strong>Pasta Raiz (Nosso <code>htdocs</code>):</strong> <code><?php echo $pastaRaiz; ?></code></p>
            <p><strong>Data/Hora no Servidor:</strong> <?php echo $dataAtual; ?></p>
        </div>

        <div class="aviso-sucesso">
            <strong>Comparativo Rápido:</strong><br>
            &bull; <strong>No XAMPP tradicional:</strong> salvávamos na pasta <code>C:\xampp\htdocs\editora\</code>.<br>
            &bull; <strong>No GitHub Codespaces:</strong> usamos o container Docker direto na pasta <code>Aula09/</code>!
        </div>

        <a href="cadastro.html" class="botao">Ir para o Formulário da Editora Br@sil &rarr;</a>
    </div>

</body>
</html>
