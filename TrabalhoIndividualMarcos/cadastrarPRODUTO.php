<?php
include_once './database.php';
include_once './usuario.php';
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['msg'] = "É necessário logar antes de acessar a página de menu!!!";
    header("Location: index.php");
    exit;
}

if (isset($_POST['nome_material'])) {
    $nome_material = $_POST['nome_material'];
    $descricao = $_POST['descricao'];
    $valor = floatval($_POST['valor']);
    $quantidade = intval($_POST['quantidade']);
    $cod_usuario = $_SESSION['user']->cod; // Código do usuário logado

    // Prepare e execute a consulta de inserção
    $stmt = $conexao->prepare("INSERT INTO papelaria (nome_material, descricao, valor, quantidade, cod_usuario) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdii", $nome_material, $descricao, $valor, $quantidade, $cod_usuario);
    
    if ($stmt->execute()) {
        header("Location: Lista Estoque.php");
        echo "<script>alert('Produto cadastrado com sucesso!');</script>";
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar produto: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
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
        <form action="cadastrarPRODUTO.php" method="POST">
            <fieldset style="width: 50%;">
                <legend>Dados do Produto</legend>
                <table>
                    <tbody>
                        <tr>
                            <td>Nome:</td>
                            <td><input type="text" name="nome_material" required/></td>
                        </tr>
                        <tr>
                            <td>Descrição:</td>
                            <td><input type="text" name="descricao" required/></td>
                        </tr>
                        <tr>
                            <td>Valor:</td>
                            <td><input type="text" name="valor" required/></td>
                        </tr>
                        <tr>
                            <td>Quantidade:</td>
                            <td><input type="text" name="quantidade" required/></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Cadastrar Produto"/></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </form>
    </div>
</body>
</html>
