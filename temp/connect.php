<?php
    // https://www.php.net/manual/pt_BR/pdo.connections.php /// LER ESSA DIAMBA
    // 
    function connectToMysql(){
        $db_host = "IP DO HOST";
        $username = "USUARIO DO MYSQL";
        $passwd = "SENHA DO USUARIO";
        $db_name = "NOME DO BANCO";

        $dataSource = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

        $options = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $pdo = new PDO($dataSource, $username, $passwd, $options);
            return pdo;
        }catch(Exception $e){
            error_log($e->getMessage(), 3, 'connectLog.log');
            return null;
        }
    }
?>