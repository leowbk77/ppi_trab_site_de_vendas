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

window.onload = function () {
    preencheCategoria();
}