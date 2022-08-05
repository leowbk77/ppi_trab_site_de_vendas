<?php
    require "connect.php";
    // URL: 
    //../php/buscaItems.php?qnt=3&key0=buscakek&key1=hello&key2=world
    // provavel vai ser necessarios mais argumentos 

    $numeroDeArgumentos = $_GET["qnt"];

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
                $key = $_GET["key{$i}"];
                $sql .= "\ntitulo like '%{$key}%'"; // pesquisando por titulo
                if($i + 1 < $numeroDeArgumentos){
                    $sql .= " AND";
                }
            } // ao final deve ter a query correta dinamicamente
            $sql .= "\nORDER BY data_hora DESC;"; // ordem decrescente


        } catch (Exception $e) {
            //throw $th;
        }
    }


?>