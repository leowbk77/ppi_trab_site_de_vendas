<?php
    require "connect.php";

    $numeroDeArgumentos = $_GET["qnt"] ?? "";
    $arrayDeArgumentos = [];

    // define o maximo de resultados da busca
    $nmax = 6; 
    // pega o offset para ser calculado
    $offset = $_GET["offset"] ?? "";
    $offset *= $nmax;

    //preenchendo o array de argumentos
    for($i = 0; $i < $numeroDeArgumentos; $i++){ 
        $arrayDeArgumentos[] = "%" . $_GET["key{$i}"] . "%";
    }

    $pdo = connectToMysql();

    if($pdo == null){
        // erro a ser tratado
        echo "erro no IF";
    }else{
        try {

            if($offset == 0){
                $sql = <<<SQL
                SELECT *
                FROM anuncio
                LIMIT $nmax OFFSET $offset
                SQL;
                // query inicial com offset 0
                // faz a query sem argumentos
                $stmt = $pdo->query($sql);
            }else{
                $sql = <<<SQL
                SELECT codigo, titulo, descricao, preco, data_hora, cep, bairro, cidade, estado, codigo_categoria, codigo_anunciante
                FROM anuncio
                WHERE
                SQL; 
                // query padrão com offset > 0
                
                for($i = 0; $i < $numeroDeArgumentos; $i++){
                    $sql .= " anuncio.titulo like ?";
                    if($i + 1 < $numeroDeArgumentos){
                        $sql .= " AND";
                    }
                }
                // ao final deve ter a query correta dinamicamente
                // ordem decrescente
                //$sql .= " ORDER BY data_hora DESC";
                // aplica o offset
                $sql .= " LIMIT $nmax OFFSET $offset";    
                // prepara
                $stmt = $pdo->prepare($sql);
                // executa
                $stmt->execute($arrayDeArgumentos);
            }
            // pega as tuplas e cria os objetos que serao transformados no JSON
            $arrayDeObjetos = [];
            // falta passar isso pelo HTMLSPECIALCHARS
            // e pegar as fotos
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