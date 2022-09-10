<?php
    require_once "../../php/connect.php";
    require_once "../../php/autenticacao.php";

    session_start();
    $pdo = connectToMysql();
    kickLogin($pdo);
    exitWhenNotLogged($pdo);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olá <?php echo '{{temp}}' ?></title>
    <link rel="stylesheet" href="../style/mainPageStyle.css">
    <link rel="stylesheet" href="../style/fonts.css">
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
                        <text style="fill: rgb(51, 51, 51); font-family: Averia Sans Libre; font-size: 78px; font-style: italic; font-weight: 700; white-space: pre;" transform="matrix(1.612796, 0, 0, 1.696177, -133.273132, -89.756783)" x="82.635" y="205.389">PPIStor</text>
                        <text style="fill: rgb(23, 32, 216); font-family: Astloch; font-size: 17.5857px; white-space: pre;" transform="matrix(7.855598, 0, 0, 7.523171, -3175.854492, -1478.180908)" x="457.485" y="231.138">e</text>
                    </g>
                    </svg>
                </a>
            </div>
            
            <div class="center-search-bar">
                <form action="#" class="searchForm">
                    <input type="text" name="search" id="search" placeholder="Busca">
                    <button id="search-bar-btn" class="search-btn">></button>
                </form>
            </div>

            <div class="right-items">
                <div class="client-area" id="client-area-btn">
                    <img src="../style/svg/clientearea.svg" alt="cliIMG" class="cliente-svg">
                </div>
            </div>

        </div>

        <!-- BARRA DE CATEGORIAS SUPERIOR (DAR UM JEITO NISSO AQUI) -->
        <div class="nav-div">
            <img src="../style/svg/hamburguer.svg" alt="menu" class="hamburguer-svg" id="hamburguer-svg-id">
        </div>
    </header>

    <main>
        <div class="main-content-div">
            <nav class="main-content-navbar" id="main-content-navbar-nav">
                <div class="advanced-search-bar font-roboto">
                    <div class="adv-search-title">
                        <h3 id="adv-search-h3" class="font-roboto">Busca avançada</h3>
                    </div>
                    <div class="adv-search-form-div">
                        <form action="#" method="get" class="adv-search-form">
                            <div class="adv-search-input-searchby adv-search-div-item">
                                <label for="adv-srch-searchby">Busca por</label>
                                <select name="adv-srch-searchby" id="adv-srch-searchby">
                                    <option value="ttl">Título</option>
                                    <option value="desc">Descrição</option>
                                </select>
                            </div>
                            <div class="adv-search-input-prices-div adv-search-div-item">
                                <label for="adv-input-min-price">Min</label>
                                <input type="number" name="adv-input-min-price" id="adv-input-min-price" class="adv-input-price-box">
                                <label for="adv-input-max-price">Max</label>
                                <input type="number" name="adv-input-max-price" id="adv-input-max-price" class="adv-input-price-box">
                            </div>
                            <div class="adv-search-input-category adv-search-div-item">
                                <label for="adv-srch-categories">Categorias</label>
                                <select name="adv-srch-categories" id="adv-srch-categories">
                                    <option value="all">Todas</option>
                                </select>
                            </div>
                            <button class="search-btn  adv-search-div-item" id="adv-srch-btn">Buscar</button>
                        </form>
                    </div>
                </div>
            </nav>
            <section class="main-content-main-section">
                <div class="items-grid" id="items-grid">
                    <!-- CARDS DE PRODUTO template -->
                    <template id="templateDoCard">
                        <div class="cardProduto">
                            <a href="{{ANCHORLINK}}" class="linkDoProduto">
                                <div class="cardProduto-visual">
                                    <img src="{{IMGSRC}}" alt="foto do produto">
                                    <div class="item-info font-roboto">
                                        <h2>{{PRODH2}}</h2>
                                        <span class="item-preco font-poppins">R$ {{ITEMPRECO}}</span>
                                    </div>
                                </div>
                                <span class="item-descricao font-roboto">{{ITEMDESC}}</span>
                            </a>
                        </div>
                    </template>
                </div>
            </section>
            <aside class="main-content-aside">
                <!-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima quidem inventore nisi eius earum natus ipsam accusamus autem eveniet quasi possimus ad incidunt fuga, atque corporis doloremque officiis ullam at?</p> -->
            </aside>
        </div>
    </main>
    
    <footer>
        <p>footer</p>
    </footer>

    <script src="../../js/busca.js"></script>
    <script src="../../js/buscaAvancada.js"></script>
    <script src="../../js/principalControlador.js"></script>
</body>
</html>