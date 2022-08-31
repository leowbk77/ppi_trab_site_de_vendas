const hamburguerSvg = document.getElementById('hamburguer-svg-id');
const advSearchNav = document.getElementById('main-content-navbar-nav');

// optimizar usando classes
// criar animacaozinha?

document.addEventListener('DOMContentLoaded', function (){
    hamburguerSvg.addEventListener('click', function (){
        if(advSearchNav.style.visibility === 'hidden'){
            advSearchNav.style.visibility = 'visible';
        }else{
            advSearchNav.style.visibility = 'hidden';
        }
    });
});

// criar funcao de preenchimento das categorias

// criar funcao de requisicao da busca avancada