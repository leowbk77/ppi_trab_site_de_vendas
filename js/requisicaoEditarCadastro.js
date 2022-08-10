function preencheCadastro() {
    const requisicao = new XMLHttpRequest();
    requisicao.open("GET","../php/altera-cadastro-req.php",true);

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

        let nome = document.getElementById("inputNome");
        let cpf = document.getElementById("inputCPF");
        let email = document.getElementById("inputEmail");
        let telefone = document.getElementById("inputTel");

        nome.value = data.nome;
        cpf.value = data.cpf;
        email.value = data.email;
        telefone.value = data.telefone;
    }

    requisicao.onerror = function() {
        console.error("Ocorreu um erro na requisição JSON");
    };

    requisicao.send();
}

window.onload = function () {
    preencheCadastro(); 
}