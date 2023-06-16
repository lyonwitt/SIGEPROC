<?php
session_start();

include("config.php");

$id_user = $_SESSION['id'];

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$qtde = $_POST['quantidade'];
$und_medida = $_POST['und_medida'];
$margem_seg = $_POST['margem_seg'];

$query = "INSERT INTO produtos (iduser, cod_prod, name_prod, desc_prod, und_medida, qtde_prod, qtde_sec_prod) VALUES ($id_user, NULL, '$nome', '$descricao', '$und_medida', $qtde, $margem_seg)";
$insert = mysqli_query($conexao, $query) or die("Erro no banco de dados!");



if ($insert === true) {
    echo "<script>alert('O Produto ".strtoupper($nome)." foi inserido com sucesso!'); location.href='../pages/estoque';</script>";
} else {
    echo "<script>alert('Não foi possível inserir o produto!'); location.href='../pages/estoque';</script>";
}
?>