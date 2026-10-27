/* ==========================================================================
   Atividade de Laboratório 08
   Aluno: [Preencha seu Nome]
   RA: [Preencha seu RA]
   ========================================================================== */

function validarAtividade() {
    // 1. Capture os elementos de input do formulário
    const campoNome = document.getElementById("txtNome");
    const campoEmail = document.getElementById("txtEmail");
    const campoSenha = document.getElementById("txtSenha");

    // 2. Capture os elementos <span> para exibir os erros
    const erroNome = document.getElementById("erroNome");
    const erroEmail = document.getElementById("erroEmail");
    const erroSenha = document.getElementById("erroSenha");
    const mensagemSucesso = document.getElementById("mensagemSucesso");

    // 3. Limpe mensagens e estilos anteriores
    limparErros();

    let valido = true;

    // --- DESAFIO 1: Validação do Nome ---
    // O nome não pode estar vazio e deve ter no mínimo 3 caracteres
    if (campoNome.value.trim() === "") {
        campoNome.classList.add("campo-erro");
        erroNome.textContent = "Preencha o seu nome completo.";
        valido = false;
    } else {
        campoNome.classList.add("campo-sucesso");
    }

    // --- DESAFIO 2: Validação do E-mail ---
    // Regra: O e-mail não pode estar vazio e DEVE conter o caractere '@'
    // Dica: Use campoEmail.value.includes("@") para testar se tem o caractere '@'
    const emailValor = campoEmail.value.trim();
    if (emailValor === "") {
        campoEmail.classList.add("campo-erro");
        erroEmail.textContent = "O campo e-mail é obrigatório.";
        valido = false;
    } else if (!emailValor.includes("@")) {
        campoEmail.classList.add("campo-erro");
        erroEmail.textContent = "Informe um e-mail válido (deve conter @).";
        valido = false;
    } else {
        campoEmail.classList.add("campo-sucesso");
    }

    // --- DESAFIO 3: Validação da Senha ---
    // A senha deve ter pelo menos 6 caracteres
    if (campoSenha.value.length < 6) {
        campoSenha.classList.add("campo-erro");
        erroSenha.textContent = "A senha deve conter no mínimo 6 caracteres.";
        valido = false;
    } else {
        campoSenha.classList.add("campo-sucesso");
    }

    // --- DESAFIO 4: Exibição do Sucesso ---
    // Se todos os campos forem válidos, exiba a mensagem na caixa de sucesso na tela!
    if (valido) {
        mensagemSucesso.className = "status-box sucesso";
        mensagemSucesso.textContent = "Parabéns, " + campoNome.value + "! Seus dados foram validados com sucesso.";
    }
}

function limparErros() {
    const campos = document.querySelectorAll(".campo");
    campos.forEach(c => c.classList.remove("campo-erro", "campo-sucesso"));

    const erros = document.querySelectorAll(".mensagem-erro");
    erros.forEach(e => e.textContent = "");

    const msg = document.getElementById("mensagemSucesso");
    msg.className = "status-box";
    msg.textContent = "";
}

function limparCampos() {
    document.getElementById("formAtividade").reset();
    limparErros();
}
