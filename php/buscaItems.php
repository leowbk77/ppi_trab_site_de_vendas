<?php
    require "connect.php";

    $numeroDeArgumentos = $_GET["qnt"];
    $arrayDeArgumentos = [];

    // define o maximo de resultados da busca
    $nmax = 6; 
    // pega o offset para ser calculado
    $offset = $_GET["offset"];
    $offset *= $nmax;

    //preenchendo o array de argumentos
    for($i = 0; $i < $numeroDeArgumentos; $i++){ 
        $arrayDeArgumentos[] = "%" . $_GET["key{$i}"] . "%";
    }

    $pdo = connectToMysql();

    if(($pdo == null) or ($numeroDeArgumentos < 1)){
        // erro a ser tratado
        echo "erro no IF";
    }else{
        try {

            $sql = <<<SQL
            SELECT codigo, titulo, descricao, preco, data_hora, cep, bairro, cidade, estado, codigo_categoria, codigo_anunciante
            FROM anuncio
            WHERE
            SQL; 
            // base da query

            for($i = 0; $i < $numeroDeArgumentos; $i++){
                $sql .= " anuncio.titulo like ?";
                if($i + 1 < $numeroDeArgumentos){
                    $sql .= " AND";
                }
            } 
            // ao final deve ter a query correta dinamicamente
            // ordem decrescente
            //$sql .= "\nORDER BY data_hora DESC";
            // aplica o offset
            $sql .= " LIMIT $nmax OFFSET $offset";
            //echo $sql;
            // prepara
            $stmt = $pdo->prepare($sql);
            // executa
            $stmt->execute($arrayDeArgumentos);
            // pega as tuplas e cria os objetos que serao transformados no JSON
            $arrayDeObjetos = [];
            while($row = $stmt->fetch()){
                $arrayDeObjetos[] = array(
                    "codigo"    => $row['codigo'],
                    "titulo"    => $row['titulo'],
                    "descricao" => $row['descricao'],
                    "preco"     => $row['preco'],
                    "data_hora" => $row['data_hora'],
                    "cep"       => $row['cep'],
                    "bairro"    => $row['bairro'],
                    "cidade"    => $row['cidade'],
                    "estado"    => $row['estado'],
                    "codigo_categoria"  => $row['codigo_categoria'],
                    "codigo_anunciante" => $row['codigo_anunciante'],
                );
            }

            header('Content-type: application/json');
            echo json_encode($arrayDeObjetos);
        } catch (Exception $e) {
            exit('Ocorreu uma falha: ' . $e->getMessage());
        }
    }
?>