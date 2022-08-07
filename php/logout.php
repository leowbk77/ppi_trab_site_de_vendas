<?php
// inicia a sessão
session_start();
// apaga as variáveis de sessão
session_unset();
// destrói a sessão
session_destroy();
// joga o usuario pra primeira pagina
header('Location: /pages/publico/principal.html');
exit();
?>