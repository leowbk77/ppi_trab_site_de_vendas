<?php

require_once "connect.php";
require_once "autenticacao.php";

session_start();

class Resposta{
    public $sucesso;
    public $caminho;

    function __construct($sucesso, $caminho){
        $this->sucesso = $sucesso;
        $this->caminho = $caminho;
    }
}

$email = $_POST['email'] ?? "";
$passwd = $_POST['senha'] ?? "";

$pdo = connectToMysql();

if ($senhaHash = verificaSenha($pdo, $email, $passwd)){
    $_SESSION['UserMail'] = $email;
    $_SESSION['loginHash'] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);

    $resposta = new Resposta(true, '/php/homepage.php'); // atentar para o caminho ? '/pages/privado/principal.html'
}else{
    $resposta = new Resposta(false, '');
}

echo json_encode($resposta); // devolve a resposta JSON
?>