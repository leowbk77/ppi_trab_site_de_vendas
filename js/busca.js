const botaoDeBusca = document.getElementById("search-bar-btn");
const campoDeBusca = document.getElementById("search");
const gridDosCards = document.getElementById("items-grid");

const urlBase = "/loja/php/buscaItems.php?qnt=";
let numeroDaConsulta = 0; // usar pra calcular o offset no lado do servidor; deve ser incrementado apos cada busca

function createCard(/*caminhoDaImagem,*/ titulo, preco, descricao, codigo){
    // usar o codigo do produto para gerar a pagina de visualizacao EX : src="/php/produto.php?cod=xxxxxx"
    /*  COLOCAR UM ID COM O ID DO PRODUTO??
                    <template id="templateDoCard">
                        <div class="cardProduto">
                            <a href="{{ANCHORLINK}}" class="linkDoProduto">
                                <div class="cardProduto-visual">
                                    <img src="{{IMGSRC}}" alt="foto do produto">
                                    <div class="item-info">
                                        <h2>{{PRODH2}}</h2>
                                        <span class="item-preco">R$ {{ITEMPRECO}}</span>
                                    </div>
                                </div>
                                <span class="item-descricao">{{ITEMDESC}}</span>
                            </a>
                        </div>
                    </template>
    */
   // limita a descricao a 134 chars?
    if(descricao.length > 134){
        let corteDeChars = (-1) * (descricao.length - 134);
        descricao = descricao.slice(0, corteDeChars);
    }

    const templateDoCard = document.getElementById("templateDoCard");
    let html = templateDoCard.innerHTML
    .replace("{{ANCHORLINK}}", "/php/produto.php?cod=" + codigo)
    .replace("{{IMGSRC}}", "https://cdn.pixabay.com/photo/2013/07/12/17/41/computer-mouse-152249_960_720.png") //imagem temporaria - passar o caminhoDaImagem no futuro
    .replace("{{PRODH2}}", titulo)
    .replace("{{ITEMPRECO}}", "R$ " + preco)
    .replace("{{ITEMDESC}}", descricao);
    return html;
}

function renderCards(objetoJS) {
    var novoCard = '';
    for(let item of objetoJS){
        novoCard = createCard(item.titulo, item.preco, item.descricao, item.codigo);
        gridDosCards.appendChild(novoCard);
    }
}

function buildURL(quantidadeDeArgumentos, arrayDeArgumentos){
    let url = urlBase + quantidadeDeArgumentos + "&" + "offset=" + numeroDaConsulta + "&"; // atentar ao comeco do link
    
    for(let i = 0; i < quantidadeDeArgumentos; i++){
        url += "key" + i + "=" + arrayDeArgumentos[i] + "&";
    }

    numeroDaConsulta++; // incrementa a consulta pra calculo do offset
    return url.slice(0, -1); // remove o & do final e retorna
}

async function buscaJson(url){
    try {
        let promiseDaBusca = await fetch(url);
        if(!promiseDaBusca.ok) throw new Error(promiseDaBusca.statusText);
        var resposta = await promiseDaBusca.json();
    } catch (erro) {
        console.log(erro);
        return;
    }

    renderCards(resposta);
}

botaoDeBusca.addEventListener("click", function buscaAjax(){
    //falta tratamento caso o usuario click com o campo de busca vazio
    //falta limpar os cards que ja estao na tela para exibir os da busca
    let arrayDeBusca = campoDeBusca.value.split(" ");
    campoDeBusca.value = '';

    let quantidadeDeParametros = arrayDeBusca.length;
    if(quantidadeDeParametros > 5) quantidadeDeParametros = 5;
    
    let scriptURL = buildURL(quantidadeDeParametros, arrayDeBusca); // passar a url pra uma funcao async ?
    console.log(scriptURL); // temporario pra debug

    buscaJson(scriptURL);
} );

window.onload = function () {
    numeroDaConsulta = 0;
    buscaJson(buildURL(0,[])); // primeira consulta -> apos isso a consulta incrementa e os cards sao adicionados
}