<?php
    require "connect.php";
    require "classeAnuncio.php";

    // URL: 
    //../php/buscaItems.php?qnt=3&key0=buscakek&key1=hello&key2=world
    // provavel vai ser necessarios mais argumentos 

    $numeroDeArgumentos = $_GET["qnt"];
    $arrayDeArgumentos = [];

    $nmax = 6; // define o maximo de resultados da busca
    $offset = $_GET["offset"]; // pega o offset para ser calculado
    $offset *= $nmax;

    for($i = 0; $i < $numeroDeArgumentos; $i++){ // preenchendo o array de argumentos
        $arrayDeArgumentos[] = $_GET["key{$i}"];
    }

    $pdo = connectToMysql();

    if(($pdo == null) or ($numeroDeArgumentos < 1)){
        // erro
    }else{
        try {

            $sql = <<<SQL
            SELECT *
            FROM anuncio
            WHERE
            SQL; // base da query

            for($i = 0; $i < $numeroDeArgumentos; $i++){
                $sql .= "\ntitulo like '%?%'"; // pesquisando por titulo
                if($i + 1 < $numeroDeArgumentos){
                    $sql .= " AND";
                }
            } // ao final deve ter a query correta dinamicamente
            // ordem decrescente
            //$sql .= "\nORDER BY data_hora DESC"; 
            // aplica o offset
            $sql .= "\nLIMIT $nmax OFFSET $offset";

            $stmt = $pdo->prepare($sql); // prepara
            $stmt->execute($arrayDeArgumentos); // executa

            // pega as tuplas e cria os objetos que serao transformados no JSON
            $arrayDeObjetos = [];
            while($row = $stmt->fetch()){
                $arrayDeObjetos[] = new Anuncio(
                    htmlspecialchars($row['codigo']),
                    htmlspecialchars($row['titulo']),
                    htmlspecialchars($row['descricao']),
                    htmlspecialchars($row['preco']),
                    htmlspecialchars($row['data_hora']),
                    htmlspecialchars($row['cep']),
                    htmlspecialchars($row['bairro']),
                    htmlspecialchars($row['cidade']),
                    htmlspecialchars($row['estado']),
                    htmlspecialchars($row['codigo_categoria']),
                    htmlspecialchars($row['codigo_anunciante'])
                );
            }
                        
            header('Content-type: application/json');
            echo json_encode($arrayDeObjetos);
        } catch (Exception $e) {
            exit('Ocorreu uma falha: ' . $e->getMessage());
        }
    }
?>