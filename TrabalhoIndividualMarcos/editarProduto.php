<?php
include_once './database.php';
include_once './usuario.php';
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['msg'] = "É necessário logar antes de acessar a página de menu!!!";
    header("Location: index.php");
    exit;
}

if (isset($_POST['atualizar'])) {
    $cod_material = $_POST['cod_material'];
    $nome = $_POST['nome_material'];
    $descricao = $_POST['descricao'];
    $valor = floatval($_POST['valor']);
    $quantidade = intval($_POST['quantidade']);

    $stmt = $conexao->prepare("UPDATE papelaria SET nome_material = ?, descricao = ?, valor = ?, quantidade = ? WHERE cod_material = ?");
    $stmt->bind_param("ssdii", $nome, $descricao, $valor, $quantidade, $cod_material);
    
    if ($stmt->execute()) {
        header("Location: Lista Estoque.php");
        exit;
    } else {
        echo "Erro ao atualizar o produto: " . $stmt->error;
    }

    $stmt->close();
}

if (isset($_GET['cod_material'])) {
    $cod_material = $_GET['cod_material'];
    $consulta = mysqli_query($conexao, "SELECT * FROM papelaria WHERE cod_material = $cod_material");
    $produto = mysqli_fetch_assoc($consulta);
    if (!$produto) {
        die("Produto não encontrado.");
    }
} else {
    die("Código do produto não fornecido.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" type="text/css" href="login.css"/>
</head>
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
        <h2>Editar Produto</h2>
        <form action="editarProduto.php" method="POST">
            <input type="hidden" name="cod_material" value="<?php echo $produto['cod_material']; ?>">
            <fieldset style="width: 0;">
                <legend>Dados do Produto</legend>
                <table>
                    <tbody>
                        <tr>
                            <td>Nome:</td>
                            <td><input type="text" name="nome_material" value="<?php echo htmlspecialchars($produto['nome_material']); ?>" required></td>
                        </tr>
                        <tr>
                            <td>Descrição:</td>
                            <td><input type="text" name="descricao" value="<?php echo htmlspecialchars($produto['descricao']); ?>" required></td>
                        </tr>
                        <tr>
                            <td>Valor:</td>
                            <td><input type="text" name="valor" value="<?php echo number_format($produto['valor'], 2, ',', '.'); ?>" required></td>
                        </tr>
                        <tr>
                            <td>Quantidade:</td>
                            <td><input type="text" name="quantidade" value="<?php echo $produto['quantidade']; ?>" required></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" name="atualizar" value="Atualizar Produto"></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </form>
    </div>
</body>
</html>
