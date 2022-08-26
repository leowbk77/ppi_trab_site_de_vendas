<?
    class Endereco 
    {
        public $bairro;
        public $cidade;
        public $estado;

        function __construct($bairro,$cidade,$estado)
        {
            $this->bairro = $bairro;
            $this->cidade = $cidade;
            $this->estado = $estado;
        }
    }

    require "./connect.php";
    $pdo = connectToMysql();
    
    $stringJSON = file_get_contents('php://input');
    $dados = json_decode($stringJSON);
    $cep = $dados->cep;

    $sql = <<< SQL
        SELECT bairro, cidade, estado
        FROM  enderecos_ajax 
        WHERE cep = ?
    SQL;

    try 
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cep]);

        if($row = $stmt->fetch()){
            $endereco = new Endereco($row["bairro"],$row["cidade"], $row["estado"]);
        }else{
            $endereco = new Endereco('','','');
        }

        header('Content-type: application/json');
        echo json_encode($endereco);
    }
    catch (Exception $e) 
    {
        if ($e->errorInfo[1] === 1062)
          exit('Dados duplicados: ' . $e->getMessage());
        else
          exit('Falha ao cadastrar os dados: ' . $e->getMessage());
    }