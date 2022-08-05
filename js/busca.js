const botaoDeBusca = document.getElementById("search-bar-btn");
const campoDeBusca = document.getElementById("search");
const gridDosCards = document.getElementById("items-grid");

function createCard(){
    // No futuro receber as infos por argumento e colocar no card
    /*  COLOCAR UM ID COM O ID DO PRODUTO ?????
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
    
    divDoCard.className = "cardProduto";
    spanPreco.className = "item-preco";
    anchorDoCard.href = "#";
    imgDoCard.src = "{{IMGSRC}}";
    imgDoCard.alt = "{{IMGALT}}";
    tituloDoCard.innerHTML = "{{H2CARD}}";
    spanPreco.innerHTML = "{{PRECO}}";
    //descDoCard.innerHTML = "{{DESC}}";

    return divDoCard;
}

function renderCards(/*json*/) {
    let novoCard = createCard();
    gridDosCards.appendChild(novoCard);

    /*
    for(let items of json){
        let novoCard = createCard(items.imagem, items.nome, items.preco, items.desc);
        gridDosCards.appendChild(novoCard);
    }
    */
}

function buildURL(quantidadeDeArgumentos, arrayDeArgumentos){
    let url = "../php/buscaItems.php?qnt=" + quantidadeDeArgumentos + "&";

    for(let i = 0; i < quantidadeDeArgumentos; i++){
        url += "key" + i + "=" + arrayDeArgumentos[i] + "&";
    }
    return url.slice(0, -1); // remove o & do final e retorna
}

async function buscaJson(url){
    try {
        let promiseDaBusca = await fetch(url);
        if(!promiseDaBusca.ok) throw new Error(promiseDaBusca.statusText);
        let resposta = await promiseDaBusca.json();
        return resposta;
    } catch (erro) {
        console.log(erro);
        return;
    }
}

botaoDeBusca.addEventListener("click", function buscaAjax(){
    let arrayDeBusca = campoDeBusca.value.split(" ");
    campoDeBusca.value = '';

    let quantidadeDeParametros = arrayDeBusca.length;
    if(quantidadeDeParametros > 5) quantidadeDeParametros = 5;
    
    let scriptURL = buildURL(quantidadeDeParametros, arrayDeBusca); // passar a url pra uma funcao async ?
    console.log(scriptURL);
    renderCards();
    let JsonDeResultados = buscaJson(scriptURL);
} );
