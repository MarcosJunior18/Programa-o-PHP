<?php
include_once './database.php';
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['msg'] = "É necessário logar antes de acessar a página de menu!!!";
    header("Location: index.php");
    exit;
}

if (isset($_POST['cod_material'])) {
    $cod_material = $_POST['cod_material'];

  
    $stmt = $conexao->prepare("DELETE FROM Papelaria WHERE COD_MATERIAL = ?");
    $stmt->bind_param("i", $cod_material);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "Produto excluído com sucesso!";
    } else {
        $_SESSION['msg'] = "Erro ao excluir produto: " . $stmt->error;
    }

    $stmt->close();
}

header("Location: Lista Estoque.php");
exit;
?>
