# 📅 AULA 09 (26/10)Tema Central: 
## UNIDADE 5 – LINGUAGEM DE PROGRAMAÇÃO DINÂMICA PHP (Início)   

Duração: 3h30m – 4h00m (Teoria Rápida + Prática em Laboratório)

Projeto Fio Condutor: Sistema de Vendas de Assinaturas da EDITORA BR@SIL   

## 1. Conteúdo Teórico Estruturado (Textual para Slides)

Tópico 1: Introdução ao PHP e Processamento no Servidor

Subtópico: O que é PHP (Hypertext Preprocessor)?

Texto para Slide: O PHP é uma linguagem de programação dinâmica do lado do servidor (server-side). 
Enquanto o HTML e o CSS montam a casca visual e o JavaScript atua no navegador, o PHP é executado no computador que hospeda o site (Servidor Web Apache), processando regras de negócio e interagindo com bancos de dados antes de entregar a resposta final.   

Subtópico: A Regra do localhost (Atenção Máxima!).

Texto para Slide: Páginas HTML comuns podem ser abertas com dois cliques no arquivo. Arquivos .php NÃO funcionam assim. 

Eles precisam obrigatoriamente ser interpretados pelo servidor Apache do XAMPP e acessados pelo navegador através do endereço http://localhost/....   

Tópico 2: Sintaxe Básica e Variáveis em PHP

Subtópico: Delimitadores de Código e Exibição de Dados.

Texto para Slide: Todo trecho de código PHP deve ficar contido entre os delimitadores ```<?php``` e ```?>```. A instrução mais básica de saída é o echo, responsável por imprimir textos ou tags HTML na tela do navegador. Toda linha de comando em PHP deve terminar obrigatoriamente com ponto e vírgula (;).   

Subtópico: Criação de Variáveis e Concatenação.

Texto para Slide: Em PHP, toda variável começa obrigatoriamente com o caractere cifrão ($). A linguagem é fracamente tipada, identificando o tipo automaticamente pelo valor atribuído (ex: $nome = "Carlos"; ou $plano = 1;). 
Para juntar textos e variáveis, utiliza-se o operador de concatenação, que é o ponto (.).   

Tópico 3: Recebimento de Dados com a Superglobal ```$_POST```

Subtópico: A ponte entre o HTML e o PHP.

Texto para Slide: Quando o usuário clica no botão "Assinar" de um formulário HTML, o navegador despacha os dados para o arquivo indicado no atributo action usando o método definido em method="POST".   

Subtópico: O Array ```$_POST```.

Texto para Slide: O PHP captura automaticamente essas informações através da variável global ```$_POST['nome_do_campo']```. O índice entre colchetes deve coincidir exatamente com o atributo name definido no ```<input>``` do HTML.   

## 2. Prática em Laboratório (Mão na Massa Passo a Passo)

Este guia foi desenhado para iniciantes: o aluno criará sua pasta de trabalho dentro do diretório do servidor e fará o formulário conversar com o script PHP pela primeira vez.   
---
## 💻 LABORATÓRIO 06: O PRIMEIRO BACK-END DA EDITORA BR@SIL

Objetivo: Configurar a pasta de execução no XAMPP, ajustar o formulário HTML da Editora Br@sil com método POST e criar o primeiro script PHP para receber e processar os dados do assinante no servidor.   

PASSO 1: Onde Salvar os Arquivos (O "Pulo do Gato" do XAMPP)Diferente dos laboratórios de HTML e CSS, o PHP precisa ser servido pelo Apache.   

Abra o XAMPP Control Panel e clique em Start no módulo Apache (ele deve ficar verde).   

Abra o Explorador de Arquivos do Windows e navegue até a pasta:C:\xampp\htdocs\   

Dentro de htdocs, crie uma nova pasta chamada editora.   
T
odos os arquivos deste laboratório serão salvos dentro de C:\xampp\htdocs\editora\.   

PASSO 2: Ajustar o Formulário HTML (cadastro.html)

Vamos pegar a estrutura do formulário que já criamos e definir o destino do envio dos dados (action) e o método seguro (POST).   

No VS Code, abra a pasta C:\xampp\htdocs\editora\.

Crie um arquivo chamado cadastro.html e insira o código abaixo:

HTML
```html 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editora Br@sil - Assinatura</title>
</head>
<body>

    <h2>Editora Br@sil - Venda de Assinaturas</h2>
    
    <!-- action aponta para o PHP que receberá os dados; method define envio seguro via POST -->
    <form action="processa_cadastro.php" method="POST">
        <p>
            Nome Completo:<br>
            <!-- O atributo 'name' é o identificador que o PHP utilizará! -->
            <input type="text" name="nome_assinante" size="30" required>
        </p>

        <p>
            Escolha o Plano:<br>
            <select name="plano_escolhido">
                <option value="Revista Semestral">Revista Semestral - R$ 59,90</option>
                <option value="Revista Anual">Revista Anual - R$ 99,90</option>
                <option value="Plano Digital VIP">Plano Digital VIP - R$ 120,00</option>
            </select>
        </p>

        <p>
            <input type="submit" value="Confirmar Assinatura">
        </p>
    </form>

</body>
</html>
```

Salve o arquivo (Ctrl + S).

PASSO 3: Criar o Script de Processamento em PHP (processa_cadastro.php)Agora criamos a lógica de servidor que lê o que foi digitado e devolve uma resposta processada.   
No VS Code, crie um novo arquivo chamado processa_cadastro.php (dentro da mesma pasta editora).   

Digite o código abaixo:

PHP
```php
<?php
// 1. Recebendo os dados enviados pelo formulário HTML através de $_POST
$nome = $_POST['nome_assinante'];
$plano = $_POST['plano_escolhido'];

// 2. Criando variáveis de controle e boas-vindas
$dataRegistro = date("d/m/Y"); // Função nativa do PHP para data atual
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmação de Assinatura</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f2f2f2; padding: 20px;">

    <div style="background-color: #ffffff; padding: 20px; border: 1px solid #ccc; max-width: 500px;">
        <h2 style="color: #000080;">Assinatura Recebida com Sucesso!</h2>
        <hr>
        
        <p><strong>Prezado(a):</strong> <?php echo $nome; ?></p>
        <p><strong>Plano Contratado:</strong> <?php echo $plano; ?></p>
        <p><strong>Data de Processamento:</strong> <?php echo $dataRegistro; ?></p>
        
        <p style="color: green;"><em>Os dados foram validados pelo servidor e estão prontos para envio ao banco de dados!</em></p>
        
        <br>
        <a href="cadastro.html">Voltar ao formulário</a>
    </div>

</body>
</html>
```
Salve o arquivo (Ctrl + S).

PASSO 4: Testar no Navegador (O Teste do Servidor)

Abra o navegador (Google Chrome, Firefox ou Edge).   

Na barra de endereços, digite: ```http://localhost/editora/cadastro.html``` (Atenção: Não abra clicando direto no arquivo! Use o caminho com localhost).   

Preencha o nome com o seu nome, escolha um plano de assinatura e clique no botão "Confirmar Assinatura".

Validação do Aluno:A tela mudou para processa_cadastro.php?

O seu nome e o plano que você escolheu apareceram formatados na tela gerada pelo PHP?

Se sim, seu primeiro programa Back-End está funcionando perfeitamente!