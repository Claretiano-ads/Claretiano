/* ==========================================================================
   Aula 08 - Validação Dinâmica com Manipulação do DOM
   Objetivo: Substituir o window.alert() por mensagens e estilos diretamente na página.
   ========================================================================== */

/**
 * Função responsável por validar o formulário e dar feedback visual ao usuário
 */
function validarForm() {
    // 1. Capturando os elementos de entrada (inputs)
    // Dica pedagógica: usamos 'const' porque a referência do elemento HTML não muda
    const campoUsuario = document.getElementById("txtUsuario");
    const campoSenha = document.getElementById("txtSenha");
    const campoConfirmaSenha = document.getElementById("txtConfirmaSenha");

    // 2. Capturando os elementos onde exibiremos os erros (spans) e o status final
    const erroUsuario = document.getElementById("erroUsuario");
    const erroSenha = document.getElementById("erroSenha");
    const erroConfirmaSenha = document.getElementById("erroConfirmaSenha");
    const mensagemStatus = document.getElementById("mensagemStatus");

    // 3. Resetando estados anteriores antes de validar novamente
    limparErrosVisuais();
    mensagemStatus.className = "status-box";
    mensagemStatus.textContent = "";

    // 4. Variável de controle (flag booleana)
    // Se algum campo falhar, ela passará a valer false
    let formularioValido = true;

    // =========================================================================
    // REGRA 1: Validação do Nome de Usuário
    // =========================================================================
    const valorUsuario = campoUsuario.value.trim();

    if (valorUsuario === "") {
        marcarErro(campoUsuario, erroUsuario, "Por favor, preencha o nome de usuário.");
        formularioValido = false;
    } else if (valorUsuario.length < 3) {
        // Uso da propriedade .length para checar a quantidade de caracteres
        marcarErro(campoUsuario, erroUsuario, "O usuário deve ter no mínimo 3 caracteres.");
        formularioValido = false;
    } else {
        marcarSucesso(campoUsuario);
    }

    // =========================================================================
    // REGRA 2: Validação da Senha
    // =========================================================================
    const valorSenha = campoSenha.value;

    if (valorSenha === "") {
        marcarErro(campoSenha, erroSenha, "Por favor, digite uma senha.");
        formularioValido = false;
    } else if (valorSenha.length < 6) {
        marcarErro(campoSenha, erroSenha, "A senha deve ter pelo menos 6 caracteres.");
        formularioValido = false;
    } else {
        marcarSucesso(campoSenha);
    }

    // =========================================================================
    // REGRA 3: Validação da Confirmação de Senha
    // =========================================================================
    const valorConfirmaSenha = campoConfirmaSenha.value;

    if (valorConfirmaSenha === "") {
        marcarErro(campoConfirmaSenha, erroConfirmaSenha, "Por favor, confirme sua senha.");
        formularioValido = false;
    } else if (valorConfirmaSenha !== valorSenha) {
        marcarErro(campoConfirmaSenha, erroConfirmaSenha, "As senhas não coincidem.");
        formularioValido = false;
    } else {
        marcarSucesso(campoConfirmaSenha);
    }

    // =========================================================================
    // 5. Feedback Final (Se tudo estiver válido)
    // =========================================================================
    if (formularioValido) {
        // Exibimos uma mensagem positiva na tela usando .textContent ou .innerHTML
        mensagemStatus.className = "status-box sucesso";
        mensagemStatus.textContent = "Sucesso! Usuário '" + valorUsuario + "' cadastrado corretamente.";
    }
}

/**
 * Função auxiliar para aplicar estilo de erro e exibir o texto explicativo
 */
function marcarErro(campo, elementoMensagem, textoErro) {
    // Adiciona a classe de CSS que deixa o campo vermelho
    campo.classList.remove("campo-sucesso");
    campo.classList.add("campo-erro");

    // Escreve a mensagem de erro diretamente dentro da tag <span>
    elementoMensagem.textContent = textoErro;

    // Devolve o foco ao primeiro campo com erro
    campo.focus();
}

/**
 * Função auxiliar para indicar que o campo está correto
 */
function marcarSucesso(campo) {
    campo.classList.remove("campo-erro");
    campo.classList.add("campo-sucesso");
}

/**
 * Função auxiliar para limpar estilos de erro e mensagens antigas
 */
function limparErrosVisuais() {
    const campos = document.querySelectorAll(".campo");
    campos.forEach(function(campo) {
        campo.classList.remove("campo-erro", "campo-sucesso");
    });

    const spansErro = document.querySelectorAll(".mensagem-erro");
    spansErro.forEach(function(span) {
        span.textContent = "";
    });
}

/**
 * Função acionada pelo botão 'Limpar'
 */
function limparFormulario() {
    document.getElementById("formAssinatura").reset();
    limparErrosVisuais();
    const mensagemStatus = document.getElementById("mensagemStatus");
    mensagemStatus.className = "status-box";
    mensagemStatus.textContent = "";
}
