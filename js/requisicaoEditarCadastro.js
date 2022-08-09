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

        nome.value = data[0].nome;
        cpf.value = data[0].cpf;
        email.value = data[0].email;
        telefone.value = data[0].telefone;
    }
}

window.onload = function () {
    preencheCadastro(); 
}