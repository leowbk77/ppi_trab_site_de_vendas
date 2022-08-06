const formulario = document.getElementById("cadastroForm");

function validaCadastro(){
    let formValido = true;
    const nomeSpan = formulario.inputNome.nextElementSibling;
    const cpfSpan = formulario.inputCPF.nextElementSibling;
    const senhaSpan = formulario.inputPasswd.nextElementSibling;
    const telefoneSpan = formulario.inputTel.nextElementSibling;

    if(formulario.inputNome.value === ""){
        nomeSpan.textContent = 'O campo de nome é necessário!';
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

document.addEventListener('DOMContentLoaded', function (){
    document.forms.formCadastro.onsubmit = validaCadastro;
});