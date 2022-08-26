<?php
    require "./connect.php";
    $pdo = connectToMysql();

    $stringJSON = file_get_contents('php://input');
    $dados = json_decode($stringJSON);

    $sql = <<< SQL
        UPDATE anunciante SET nome = ?, cpf = ?, email = ?, telefone = ?
        WHERE nome = ?
    SQL;

   $nome = $_POST["nome"] ?? "";
   $cpf = $_POST["cpf"] ?? "";
   $email = $_POST["email"] ?? "";
   $telefone = $_POST["telefone"] ?? "";

   try
   {
     $stmt = $pdo->prepare($sql);
     $stmt->execute([$nome,$cpf,$email,$email,$telefone,$nome]);
     //header("location: exibe.php");
     exit();
   }
   catch (Exception $e)
   {
    exit('Ocorreu uma falha: ' . $e->getMessage());
   }

?> 