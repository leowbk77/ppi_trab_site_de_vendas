<?php
    require "./connect.php";
    $pdo = connectToMysql();
    
    //$categoria = $_GET["categoria"];

    $sql = <<<SQL
        SELECT nome,descricao 
        FROM  categoria
        -- WHERE nome = ?
    SQL;

    try 
    {
        $stmt = $pdo->query($sql);
        $arrayDeObjetos = [];

        while($row = $stmt->fetch())
        {
            $arrayDeObjetos[] = array (
                "nome" => $row["nome"],
                "descricao" => $row["descricao"],
            );
        }

        header('Content-type: application/json');
        echo json_encode($arrayDeObjetos);
    }
    catch (Exception $e) 
    {
        if ($e->errorInfo[1] === 1062)
          exit('Dados duplicados: ' . $e->getMessage());
        else
          exit('Falha ao cadastrar os dados: ' . $e->getMessage());
    }