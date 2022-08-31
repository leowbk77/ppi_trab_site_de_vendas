const botoesDoConteudo = document.getElementsByClassName('res-menu-item');
const divsConteudo = document.getElementsByClassName('res-content-item');
var lastConteudoVisivel = null;

function tornarVisivel(elemento){
    if(lastConteudoVisivel != null) lastConteudoVisivel.style.display = 'none';
    let displayElemento = document.getElementById(elemento);
    displayElemento.style.display = 'block';
    lastConteudoVisivel = displayElemento;
}

document.addEventListener('DOMContentLoaded', function (){
    for(let botao of botoesDoConteudo){
        botao.addEventListener('click', function (){
            switch (botao.id) {
                case 'novo-anuncio-btn':
                    tornarVisivel('res-novo-anuncio');
                    break;
                case 'listagem-anuncio-btn':
                    tornarVisivel('res-listagem-anuncios');
                    break;
                case 'mensagens-btn':
                    tornarVisivel('res-mensagens');
                    break;
                case 'dados-cadastrais-btn':
                    tornarVisivel('res-dados-cadastrais');
                    break;
                default:
                    console.log("something went wrong!");
                    break;
            }
        });
    }
});