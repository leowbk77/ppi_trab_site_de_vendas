function preencheCategoria() {
    
    const requisicao = new XMLHttpRequest();
    requisicao.open("GET","busca-categoria.php",true);

    requisicao.onload = function () {
        if(requisicao.status != 200){
            console.error("Falha inesperada: " + requisicao.responseText);
            return;
        }

        try
        {
            var data = JSON.parse(requisicao.responseText);            
        }

        catch (e)
        {
            console.error("String JSON inválida: " + requisicao.responseText);
            return;
        }

        let option = document.createElement("option");
        let selectCategoria = document.getElementById("categoria");

        for(let i = 0; i<data.length;i++){
            option = document.createElement("option");
            option.text = data[i].nome;
            option.value = data[i].nome;
            selectCategoria.add(option);
        }
        
    }

    requisicao.onerror = function() {
        console.error("Ocorreu um erro na requisição JSON");
    };

    requisicao.send();
}

function buscarCep(valorCep){
    if (valorCep.length != 9)
        return;

    let objetoJS = {
        cep: valorCep
    }     

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "busca-endereco.php");

    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function () {
        const endereco = JSON.parse(xhr.responseText);
        let form = document.querySelector("form");
        form.bairro.value = endereco.bairro;
        form.cidade.value = endereco.cidade;
        form.estado.value = endereco.estado;
    }

    xhr.onerror = function () {
        console.error("Erro de rede - requisição não finalizada");
    };

    xhr.send(JSON.stringify(objetoJS));

}

window.onload = function () {
    preencheCategoria();

    const inputCep = document.querySelector("#cep");
    inputCep.onkeyup = () => buscarCep(inputCep.value);
}