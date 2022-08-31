const botoesDoConteudo = document.getElementsByClassName('res-menu-item');
const divsConteudo = document.getElementsByClassName('res-content-item');
var lastConteudoVisivel = null;

document.addEventListener('DOMContentLoaded', function (){
    for(let botao of botoesDoConteudo){
        botao.addEventListener('click', function (){
            let display;
            switch (botao.id) {
                case 'novo-anuncio-btn':
                    if(lastConteudoVisivel != null) lastConteudoVisivel.style.display = 'none';
                    display = document.getElementById('res-novo-anuncio');
                    display.style.display = 'block';
                    lastConteudoVisivel = display;
                    break;
                case 'listagem-anuncio-btn':
                    if(lastConteudoVisivel != null) lastConteudoVisivel.style.display = 'none';
                    display = document.getElementById('res-listagem-anuncios');
                    display.style.display = 'block';
                    lastConteudoVisivel = display;
                    break;
                case 'mensagens-btn':
                    break;
                case 'dados-cadastrais-btn':
                    break;
                default:
                    console.log("something went wrong!");
                    break;
            }
        });
    }
});