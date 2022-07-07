<?php
    require "connect.php";
    $pdo = connectToMysql();

    if($pdo == null){
        // erro na conexao (checar log)
    }else{
        // conexao ok; segue o script
        try {
            $sql = <<<SQL
            INSERT INTO teste (teste_p1, teste_p2, teste_p3)
            VALUES(1, 2, 3)
            SQL;

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            header("location: index.html"); // nao sei o que eh isso
            exit();
        }catch(Exception $e){
            //tratamento de erros
        }
    }
?>