<?php
function verificaSenha($pdo, $email, $passwd){
    $sql = <<<SQL
    SELECT senha_hash
    FROM anunciante
    WHERE email = ?
    SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $senhaHash = $stmt->fetchColumn();

        if(!$senhaHash or !password_verify($passwd, $senhaHash)) return false; // email ou senha incorretos
        return $senhaHash;
    } catch (Exception $e) {
        exit('Falha inesperada: ' . $e->getMessage());
    }
}

function logado($pdo){
    if(!isset($_SESSION['UserMail'], $_SESSION['loginHash'])) return false;

    $email = $_SESSION['UserMail'];
    $sql = <<<SQL
    SELECT senha_hash
    FROM anunciante
    WHERE email = ?
    SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $senhaHash = $stmt->fetchColumn();

        if(!$senhaHash) return false; // email invalido
        $hashCheck = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']); // gera o hash novamente para comparacao
        if(!hash_equals($loginStringCheck, $_SESSION['loginString'])) return false; // hash nao bate

        return true; // login valido
    } catch (Exception $e) {
        exit('Falha inesperada: ' . $e->getMessage());
    }
}

function kickLogin($pdo){
    if (!logado($pdo)){ // login invalido - kicka o usuario para a pagina de login
        header("location: ../pages/publico/login.html");
        exit();
    }
}
?>