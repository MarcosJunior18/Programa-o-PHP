<?php
include_once './database.php';
include_once './usuario.php';
session_start();

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $consulta = mysqli_prepare($conexao, "SELECT cod, nome, login, senha FROM usuario WHERE login = ?");
    mysqli_stmt_bind_param($consulta, "s", $usuario);
    mysqli_stmt_execute($consulta);
    $resultado = mysqli_stmt_get_result($consulta);
    $dados = mysqli_fetch_assoc($resultado);

    $user = null;
    if ($dados != null) {
        $user = new Usuario($dados["cod"], $dados["nome"], $dados["login"], $dados["senha"]);
    }

    if ($user != null && $user->validaUsuarioSenha($usuario, $senha)) {
        $_SESSION['user'] = $user;
    } else {
        $_SESSION['msg'] = "Usuário ou senha incorretos";
        header("Location: index.php");
        exit;
    }
} else if (!isset($_SESSION['user'])) {
    $_SESSION['msg'] = "Digite o login para acessar";
    header("Location: index.php");
    exit;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Página de Menu</title>
        <link rel="stylesheet" type="text/css" href="login.css"/>
    </head>
    <style>
    body {
            width: 100%;
            height: 100%;
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(360deg, black, red);
        }
</style>
    <body>
        <h1>Usuário logado: <?php echo $_SESSION['user']->nome; ?></h1>
        <div>
            <a href="menu.php"> Home </a> |
            <a href="listar.php"> Listar </a> |
            <a href="cadastrar.php"> Cadastrar USUÁRIO </a> |
            <a href="Lista Estoque.php"> Lista Estoque </a> |
            <a href="cadastrarPRODUTO.php"> Cadastrar PRODUTO </a> |
            <a href="logout.php"> Sair </a>
        </div>
    </body>
</html>
