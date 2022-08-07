const formularioLogin = document.getElementById("loginForm");
const inputDoEmail = document.getElementById("inputEmail");
const inputDaSenha = document.getElementById("inputSenha");
const botaoLogin = document.getElementById("loginbtn");

function sendLogin(){
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "/php/login.php");
    xhr.onload = function (){
        if(xhr.status != 200){
            console.error("Erro : \n" + xhr.responseText);
        }

        try {
            // pega o texto puro da resposta (JSON) e faz o parse para obj JS
            var resposta = JSON.parse(xhr.responseText);
        } catch (error) {
            console.error("ERRO - JSON INVALIDO: \n" + xhr.responseText);
            return;
        }

        if(resposta.sucesso) window.location = resposta.caminho; // login com sucesso
        else { // falha no login
            inputDaSenha.value = "";
            inputDaSenha.focus();
        }
    }

    xhr.onerror = function (){
        console.error("Erro de rede, Falha na requisição");
    }

    // formata o formulario e envia a requisição
    xhr.send(new FormData(formularioLogin));
}
    /*  ENVIAR PARA O SERVIDOR A SENHA E EMAIL
        INFORMAR DINAMICAMENTE SE OS DADOS ESTAO ERRADOS SEM RELOAD
        CRIAR SESSAO NO LADO DO SERVER CASO LOGIN BEM SUCEDIDO E DAR ACESSO A PARTE RESTRITA
    */
window.onload = function (){
    botaoLogin.addEventListener("click", sendLogin);
}