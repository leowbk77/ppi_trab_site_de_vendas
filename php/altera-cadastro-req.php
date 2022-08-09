<?php

    session_start();

    $email = $_SESSION["UserMail"];

    require "connect.php";
    $pdo = connectToMysql();

    $sql = <<< SQL
        SELECT nome, cpf, email, telefone FROM anunciante 
        WHERE email=?
    SQL;

    try 
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $dados = [];

        $row = $stmt->fetch();
        if($row){
            $dados = array(
                $nome => $row["nome"],
                $cpf => $row["cpf"],
                $email => $row["email"],
                $telefone => $row["telefone"],
            );
            header('Content-type: application/json');
            echo json_encode($dados);
        } 
    }

    catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }

?>