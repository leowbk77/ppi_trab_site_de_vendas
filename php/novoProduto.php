<?php
    require "connect.php";
    $pdo = connectToMysql();
    // tratamento no nome do arquivo em falta
    $uploadFoto = '/htdocs/loja/imgfiles/' . basename($_FILES['arquivo']['name']);
    $caminhoFoto = 'leomf.great-site.net/loja/imgfiles/' . basename($_FILES['arquivo']['name']);
    $titulo = $_POST['titulo'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $cep = $_POST['cep'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $categoria = $_POST['categorias'] ?? '';
    $codAnunciante = $_POST['codAnunciante'] ?? '';

    if(move_uploaded_file($_FILES['arquivo']['tmp_name']), $uploadFoto){
        echo "arquivo enviado.\n";
    }else{
        echo "erro no upload do arquivo.\n";
        exit('falha upload do arquivo');
    }

    try {
        $sql = <<<SQL
        INSERT INTO anuncio (titulo, descricao, preco, cep, bairro, cidade, estado, codigo_categoria, codigo_anunciante)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        SQL;
        
        $sqlFoto = <<<SQL
        INSERT INTO foto (codigo_anuncio, arquivo_foto)
        VALUES (?, ?)
        SQL;

        $pdo->beginTransaction();

        $stmt = $pdo->prepare($sql);
        if(! $stmt->execute([$titulo, $descricao, $preco, $cep, $bairro, $cidade, $estado, $categoria, $codAnunciante])) throw new Exception('Erro no insert dos dados');
        $ultimoInsertID = $pdo->lastInsertId();

        $stmt = $pdo->prepare($sqlFoto);
        if(! $stmt->execute([$ultimoInsertID, $caminhoFoto])) throw new Exception('Erro no insert da foto');

        $pdo->commit();

        //finalizar o script com alguma resposta
    } catch (Exception $e) {
        $pdo->rollBack();
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>