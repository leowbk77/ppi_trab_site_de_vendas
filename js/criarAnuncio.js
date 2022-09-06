const selectCategorias = document.getElementById('inputCategoriasId');
const botaoSend = document.getElementById('res-novo-anuncio-btn-criar');
const formCadastro = document.getElementById('res-form-novo-anuncio');

const codAnunciante = 1; //temporario pra testes

function adicionaCategorias(resposta){
    for(let categoria of resposta){
        let novoOption = document.createElement('option');
        novoOption.value = categoria.codigo;
        novoOption.innerText = categoria.nome;
        selectCategorias.appendChild(novoOption);
    }
}

function requestCategorias(){
    try {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '../../php/buscaCategorias.php');
        xhr.responseType = 'json';

        xhr.onload = function (){
            if(xhr.response === null){
                console.log('resposta nao obtida');
                return;
            }
            adicionaCategorias(xhr.response);
        }
        xhr.send();
    } catch (error) {
        console.log(error);
    }
}

function criarAnuncioResposta(resposta){
    let sucessoTeste = resposta.sucesso;
    let mensagemTeste = resposta.mensagem;

    console.log(typeof sucessoTeste);
    console.log(mensagemTeste);
}

function criarAnuncio(){
    try {
        let dados = new FormData(formCadastro);
        dados.append('codAnunciante', codAnunciante);

        let xhr = new XMLHttpRequest();
        xhr.responseType = 'json';
        xhr.open('POST', '../../php/novoProduto.php');
        xhr.onload = function (){
            if(xhr.response === null){
                console.log('falha: resposta nao obtida');
                return;
            }
            criarAnuncioResposta(xhr.response);
        }
        xhr.send(dados);
    } catch (error) {
        console.log(error);
    }
}

window.onload = function (){
    requestCategorias();
    botaoSend.addEventListener('click', criarAnuncio);
}