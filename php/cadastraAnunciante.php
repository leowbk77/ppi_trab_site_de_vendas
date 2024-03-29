<?php
    require "connect.php";

    $conexaoPDO = connectToMysql();

    $nome = $_POST["inputNome"] ?? "";
    $cpf = $_POST["inputCPF"] ?? "";
    $email = $_POST["inputEmail"] ?? "";
    $senha = $_POST["inputPasswd"] ?? "";
    $telefone = $_POST["inputTel"] ?? "";

    $hash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $sql = <<<SQL
        INSERT INTO anunciante (nome, cpf, email, senha_hash, telefone)
        VALUES (?, ?, ?, ?, ?)
        SQL;

        $stmt = $conexaoPDO->prepare($sql);
        $stmt->execute([$nome, $cpf, $email, $hash, $telefone]);
    } catch (Exception $e) {
        if ($e->errorInfo[1] === 1062)
          exit('Dados duplicados: ' . $e->getMessage());
        else
          exit('Falha ao cadastrar os dados: ' . $e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../pages/style/loginPageStyle.css">
    <link rel="stylesheet" href="../pages/style/mainPageStyle.css">
    <title>Cadastro</title>
</head>
<body>
    <header class="cabecalho">

        <!-- BARRA SUPERIOR -->
        <div class="header-div">
            <div class="left-store-logo">
                <a href="#">
                <svg viewBox="0 0 500 170" xmlns="http://www.w3.org/2000/svg" xmlns:bx="https://boxy-svg.com" class="store-logo">
                    <defs>
                      <style bx:fonts="Averia Sans Libre">@import url(https://fonts.googleapis.com/css2?family=Averia+Sans+Libre%3Aital%2Cwght%400%2C300%3B0%2C400%3B0%2C700%3B1%2C300%3B1%2C400%3B1%2C700&amp;display=swap);</style>
                      <style bx:fonts="Astloch">@import url(https://fonts.googleapis.com/css2?family=Astloch%3Aital%2Cwght%400%2C400%3B0%2C700&amp;display=swap);</style>
                    </defs>
                    <g transform="matrix(1.013733, 0, 0, 1.014825, -0.000004, -129.213196)">
                      <path d="M 486.453 173.597 L 466.131 173.597 L 466.131 166.577 C 466.131 150.369 449.195 140.232 435.647 148.34 C 429.36 152.102 425.486 159.052 425.486 166.577 L 425.486 173.597 L 405.163 173.597 C 401.424 173.597 398.389 176.742 398.389 180.617 L 398.389 264.854 C 398.389 268.736 401.424 271.874 405.163 271.874 L 486.453 271.874 C 490.192 271.874 493.227 268.736 493.227 264.854 L 493.227 180.617 C 493.227 176.742 490.192 173.597 486.453 173.597 Z M 439.034 166.577 C 439.034 161.172 444.684 157.796 449.195 160.498 C 451.295 161.755 452.582 164.071 452.582 166.577 L 452.582 173.597 L 439.034 173.597 L 439.034 166.577 Z M 479.679 257.834 L 411.937 257.834 L 411.937 187.637 L 425.486 187.637 L 425.486 198.166 C 425.486 203.572 431.135 206.948 435.647 204.245 C 437.747 202.996 439.034 200.679 439.034 198.166 L 439.034 187.637 L 452.582 187.637 L 452.582 198.166 C 452.582 203.572 458.232 206.948 462.744 204.245 C 464.844 202.996 466.131 200.679 466.131 198.166 L 466.131 187.637 L 479.679 187.637 L 479.679 257.834 Z" style="fill: rgb(176, 169, 152);"></path>
                      <text style="fill: rgb(51, 51, 51); font-family: &quot;Averia Sans Libre&quot;; font-size: 78px; font-style: italic; font-weight: 700; white-space: pre;" transform="matrix(1.612796, 0, 0, 1.696177, -133.273132, -89.756783)" x="82.635" y="205.389">PPIStor</text>
                      <text style="fill: rgb(23, 32, 216); font-family: Astloch; font-size: 17.5857px; white-space: pre;" transform="matrix(7.855598, 0, 0, 7.523171, -3175.854492, -1478.180908)" x="457.485" y="231.138">e</text>
                    </g>
                </svg>
                </a>
            </div>
            
            <div class="center-search-bar">
                <form action="" class="searchForm">
                    <input type="text" name="search" id="search" placeholder="Busca">
                    <button id="search-bar-btn" class="search-btn">></button>
                </form>
            </div>

            <div class="right-items">
                <div class="carrinho">
                    <a href="#">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 7h-3V6a3 3 0 0 0-6 0v1H6a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm-7-1a1 1 0 0 1 2 0v1h-2V6zm6 13H7V9h2v1.5a1 1 0 0 0 2 0V9h2v1.5a1 1 0 0 0 2 0V9h2v10z"/>
                        </svg>
                    </a>                   
                </div>
                <div class="client-area">
                    <a href="#">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.474 19.013a8.941 8.941 0 0 0-4.115-4.89 6 6 0 1 0-8.717 0 8.941 8.941 0 0 0-4.115 4.89 11.065 11.065 0 0 0 1.63 1.59 6.965 6.965 0 0 1 4.728-5.275 1 1 0 0 0 .181-1.829 4 4 0 1 1 3.871 0 1 1 0 0 0 .181 1.829 6.965 6.965 0 0 1 4.726 5.272 11.059 11.059 0 0 0 1.63-1.587z"/>
                        </svg>
                    </a>                     
                </div>
            </div>

        </div>

        <!-- BARRA DE CATEGORIAS SUPERIOR -->
        <div class="login-nav-bar">
            <h1 id="login-titulo">Cadastro</h1>
        </div>
    </header>

    <!-- CONTEUDO PRINCIPAL -->
    <main>
        <div class="loginDiv">
            <h3>Cadastro realizado!</h3>
            <a href="../pages/publico/login.html">Ir para a pagina de login</a>
        </div>
    </main>

    <footer>
        <p>footer</p>
    </footer>
</body>
</html>