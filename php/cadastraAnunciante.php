<?php
    require "connect.php";

    $conexaoPDO = connectToMysql();

    $nome = $_POST["inputNome"] ?? "";
    $cpf = $_POST["inputCPF"] ?? "";
    $email = $_POST["inputEmail"] ?? "";
    $senha = $_POST["inputPasswd"] ?? "";
    $telefone = $_POST["inputTel"] ?? "";

    $hash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $sql = <<<SQL
        INSERT INTO anunciante (nome, cpf, email, senha_hash, telefone)
        VALUES (?, ?, ?, ?, ?)
        SQL;

        $stmt = $conexaoPDO->prepare($sql);
        $stmt->execute([$nome, $cpf, $email, $hash, $telefone]);

        exit();
    } catch (Exception $e) {
        if ($e->errorInfo[1] === 1062)
          exit('Dados duplicados: ' . $e->getMessage());
        else
          exit('Falha ao cadastrar os dados: ' . $e->getMessage());
    }
?>