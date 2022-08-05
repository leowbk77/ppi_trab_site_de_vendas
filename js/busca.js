const botaoDeBusca = document.getElementById("search-bar-btn");
const campoDeBusca = document.getElementById("search");
const formularioDeBusca = document.getElementsByClassName("searchForm");

/*
function buscaAjax(){
    let arrayDeBusca = campoDeBusca.value;
    arrayDeBusca.split(" ");
    console.log(arrayDeBusca[0] + arrayDeBusca[1]);
}
*/

botaoDeBusca.onclick = function buscaAjax(){
    let arrayDeBusca = campoDeBusca.value.split(" ");
    console.log(arrayDeBusca[1]);
};