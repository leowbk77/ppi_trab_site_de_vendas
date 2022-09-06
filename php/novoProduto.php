<?php
    class Resposta {
        public $sucesso;
        public $mensagem;

        public function __construct($sucesso, $mensagem){
            $this->sucesso = $sucesso;
            $this->mensagem = $mensagem;
        }
    }

    require "connect.php";
    $pdo = connectToMysql();

    // tratamento no nome do arquivo em falta
    $uploadFoto = '../imgfiles/' . basename($_FILES['arquivo']['name']);
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

    // criar uma funcao para diminuir a repeticao do codigo da resposta
    // criar um script que so faz o trabalho de salvar o arquivo igual ao connect do pdo
    // https://www.edureka.co/community/91921/how-to-upload-and-save-files-with-desired-name-using-php
    // https://www.w3schools.com/php/php_file_upload.asp
    // remover essas strings do exit talvez pra nao bugar a resposta
    if(!move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadFoto)){
        //resposta
        header('Content-type: application/json');
        echo json_encode(new Resposta(False, 'Erro no save do arquivo'));
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

        //resposta
        header('Content-type: application/json');
        echo json_encode(new Resposta(True, 'Inserts commitados no banco!'));
    } catch (Exception $e) {
        $pdo->rollBack();
        //resposta
        header('Content-type: application/json');
        echo json_encode(new Resposta(False, 'Rollback realizado, inserts nao realizados no banco'));
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>