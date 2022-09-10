const formulario = document.getElementById("loginForm");
const botaoSubmit = document.getElementById("loginbtn");

function login(){
    try {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../../php/login.php");
        xhr.responseType = 'json';
    
        xhr.onerror = function (){
            console.log("Erro: requisição falhou");
        }
    
        xhr.onload = function (){
            if(xhr.status != 200){
                console.error("Falha inesperada: " + xhr.responseText);
                return;
            }
            let resposta = xhr.response;
    
            if(resposta.sucesso){
                window.location = resposta.caminho;
            }else {
                // erro no login
                // exibir mensagem de erro
                // console log temporario
                console.log("Falha: login sem sucesso");
            }
        }
    
        xhr.send(new FormData(formulario));
    } catch (error) {
        console.log(error);
    }
}

window.onload = function (){
    botaoSubmit.addEventListener('click', login);
}