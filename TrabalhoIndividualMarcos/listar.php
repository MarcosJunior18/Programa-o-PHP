<?php
include_once './database.php';
include_once './usuario.php';
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['msg'] = "É necessário logar antes de acessar a página de menu!!!";
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
    Usuário logado: <?php echo $_SESSION['user']->nome; ?>
    <div class="menu">
        <a href="menu.php"> Home </a> |
            <a href="listar.php"> Listar </a> |
            <a href="cadastrar.php"> Cadastrar USUÁRIO </a> |
            <a href="Lista Estoque.php"> Lista Estoque </a> |
            <a href="cadastrarPRODUTO.php"> Cadastrar PRODUTO </a> |
            <a href="logout.php"> Sair </a>
    </div>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <td>Código</td>
                    <td>Nome</td>
                    <td>Login</td>
                </tr>
            </thead>
            <tbody>
            <?php
            $consulta = mysqli_query($conexao, "select cod, nome, login, senha from usuario");
            $i=1;
            while ($dados = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            ?>
                <tr class="<?php echo $i++%2==0?"par":"impar" ?>">
                    <td><?php echo $dados['cod']; ?></td>
                    <td><?php echo $dados['nome']; ?></td>
                    <td><?php echo $dados['login']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>


