<?php
$acao = "Saiu do sistema";
include ('../core/restrito.php');
session_destroy();
header ('Location: index.php');

?>