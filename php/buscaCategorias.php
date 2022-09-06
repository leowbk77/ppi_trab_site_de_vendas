<?php
    require "connect.php";

    $pdo = connectToMysql();
    try {
        $sql = <<<SQL
        SELECT codigo, nome
        FROM categoria
        SQL;

        $stmt = $pdo->query($sql);
        $categorias = [];

        while($row = $stmt->fetch()){
            $categorias[] = array(
                "codigo" => $row['codigo'],
                "nome" => $row['nome'],
            );
        }
        header('Content-type: application/json');
        echo json_encode($categorias);
    }catch(Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>