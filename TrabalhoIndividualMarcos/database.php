<?php
$database = 'TrabalhoIndividualMarcos';
$user = 'root';
$password = 'root';
$host = 'localhost';

$conexao = mysqli_connect($host, $user, $password, $database);

if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}
?>
