/* Função para verificar se os campos foram preenchidos corretamente */
function validarForm() {
    var usuario;
    var senha;

    usuario = document.getElementById("txtUsuario");
    senha = document.getElementById("txtSenha");

    if( usuario.value == "" ) {
        window.alert("Usuário não informado. Por favor, preencha seu nome."); 
        usuario.focus(); 
    } 
    else if( senha.value == "" ) {
        window.alert("Senha não informada. Por favor, digite uma senha.");
        senha.focus();
    } 
    else {
        window.alert("Olá, " + usuario.value + ", formulário validado com sucesso!"); 
    }
}