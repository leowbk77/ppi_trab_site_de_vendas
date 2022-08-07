const botaoDeBusca = document.getElementById("search-bar-btn");
const campoDeBusca = document.getElementById("search");
const gridDosCards = document.getElementById("items-grid");

const urlBase = "/loja/php/buscaItems.php?qnt=";
let numeroDaConsulta = 0; // usar pra calcular o offset no lado do servidor; deve ser incrementado apos cada busca

function createCard(/*caminhoDaImagem,*/ titulo, preco /*, descricao, codigo*/){
    // No futuro receber as infos por argumento e colocar no card
    // usar o codigo do produto para gerar a pagina de visualizacao EX : src="/php/produto.php?cod=xxxxxx"
    /*  COLOCAR UM ID COM O ID DO PRODUTO
                    <div class="cardProduto">
                        <a href="#">
                            <img src="https://cdn.pixabay.com/photo/2013/07/12/17/41/computer-mouse-152249_960_720.png" alt="fotoDoproduto">
                            <h2>Produto</h2>
                            <span class="item-preco">R$ 8,00</span>
                        </a>
                    </div>
     */

    const divDoCard     = document.createElement("div");
    const anchorDoCard  = document.createElement("a");
    const imgDoCard     = document.createElement("img");
    const tituloDoCard  = document.createElement("h2");
    const spanPreco     = document.createElement("span");
    //const descDoCard  = document.createElement("span");

    divDoCard.appendChild(anchorDoCard);
    anchorDoCard.appendChild(imgDoCard);
    anchorDoCard.appendChild(tituloDoCard);
    anchorDoCard.appendChild(spanPreco);
    //anchorDoCard.appendChild(descDoCard);
    
    divDoCard.className = "cardProduto"; // atribuicao de classe por causa do CSS
    spanPreco.className = "item-preco"; // 
    anchorDoCard.href = "#"; // /php/produto.php?codigo=codigo <= gera a pagina de anuncio ?
    imgDoCard.src = "http://www.hellasconstructions.com/page-under-construction.jpg"/*caminhoDaImagem*/; // url reporaria pra testes
    tituloDoCard.innerHTML = titulo;
    spanPreco.innerHTML = "R$ " + preco;
    //descDoCard.innerHTML = descricao;

    return divDoCard;
}

function renderCards(objetoJS) {
    var novoCard = '';
    for(let item of objetoJS){
        novoCard = createCard(item.titulo, item.preco);
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