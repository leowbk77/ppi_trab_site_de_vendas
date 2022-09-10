//ISSO AQUI PRECISA SER REVISTO K

const botaoClienteArea = document.getElementById("client-area-btn");
const botaoLogin = document.getElementById("login-page-btn");

function sendToClientArea(){
    window.location = '../privado/principal.php';
}

function sendToLoginPage(){
    window.location = 'login.html';
}

botaoClienteArea.addEventListener('click', sendToClientArea);
botaoLogin.addEventListener('click', sendToLoginPage);