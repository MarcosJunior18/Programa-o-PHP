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
    <title>Página de Lista de Estoque</title>
    <link rel="stylesheet" type="text/css" href="login.css"/>
    <style>
        body {
            width: 100%;
            height: 100%;
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(360deg, black, red);
        }
        .btn-excluir {
            background-color: #FF0000;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-excluir:hover {
            background-color: #CC0000;
        }

        .btn-editar {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-editar:hover {
            background-color: #45a049;
        }

        .content {
            margin: 0 auto;
            width: 70%;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #FFB6C1;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 18px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #A52A2A;
            color: white;
        }

        .menu {
            margin-bottom: 20px;
        }

        .menu a {
            margin: 0 10px;
            text-decoration: none;
            font-size: 30px;
            color: white;
        }

        .menu a:hover {
            color: #A52A2A;
        }
    </style>
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
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome Produto</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $consulta = mysqli_query($conexao, "SELECT COD_MATERIAL, NOME_MATERIAL, DESCRICAO, VALOR, QUANTIDADE FROM Papelaria");
            $i = 1;
            while ($dados = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            ?>
            <tr class="<?php echo $i++ % 2 == 0 ? 'par' : 'impar' ?>">
                <td><?php echo $dados['COD_MATERIAL']; ?></td>
                <td><?php echo $dados['NOME_MATERIAL']; ?></td>
                <td><?php echo $dados['DESCRICAO']; ?></td>
                <td><?php echo $dados['VALOR']; ?></td>
                <td><?php echo $dados['QUANTIDADE']; ?></td>
                <td>
                    <form action="editarProduto.php" method="GET" style="display:inline;">
                        <input type="hidden" name="cod_material" value="<?php echo $dados['COD_MATERIAL']; ?>"/>
                        <input type="submit" class="btn-editar" value="Editar"/>
                    </form>
                    <form action="excluirProduto.php" method="POST" style="display:inline;">
                        <input type="hidden" name="cod_material" value="<?php echo $dados['COD_MATERIAL']; ?>"/>
                        <input type="submit" class="btn-excluir" value="Excluir" onclick="return confirm('Tem certeza que deseja excluir este produto?');"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
