const formulario = document.getElementById("cadastroForm");

function validaCadastro(){
    let formValido = true;
    const nomeSpan = document.getElementById("spanNome");
    const emailSpan = document.getElementById("spanEmail");
    const cpfSpan = document.getElementById("spanCPF");
    const senhaSpan = document.getElementById("spanSenha");
    const telefoneSpan = document.getElementById("spanTel");

    if(formulario.inputNome.value === ""){
        nomeSpan.textContent = 'O campo de nome é necessário!';
        formValido = false;
    }
    if (formulario.inputEmail.value === "") {
        emailSpan.textContent = 'O campo de email é necessário!';
        formValido = false;
    }
    if(formulario.inputCPF.value === ""){
        cpfSpan.textContent = 'O campo de cpf é necessário!';
        formValido = false;
    }
    if(formulario.inputPasswd.value === ""){
        senhaSpan.textContent = 'O campo de senha é necessário!';
        formValido = false;
    }
    if(formulario.inputTel.value === ""){
        telefoneSpan.textContent = 'O campo de telefone é necessário!';
        formValido = false;
    }

    return formValido;
}

formulario.onsubmit = validaCadastro;