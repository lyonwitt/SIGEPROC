<?php
session_start();

include("config.php");

function deixarNumero($string)
{
    return preg_replace("/[^0-9]/", "", $string);
}

$idcliente = $_POST['id_cliente'];
$nome = $_POST['name'];
$cpf = deixarNumero($_POST['cpf']);
$email = $_POST['email'];
$ddd_tel = $_POST['ddd_tel'];
$num_tel = $_POST['num_tel'];
$cep = deixarNumero($_POST['cep']);
$logradouro = $_POST['logradouro'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];

$query = "UPDATE clientes SET nome_cliente = '$nome', cpf_cliente = $cpf, email_cliente = '$email' WHERE id_cliente = $idcliente";
$result = mysqli_query($conexao, $query) or die("Erro no banco de dados elementar 1!");

if ($result === true) {
    $query = "UPDATE tel_cliente SET ddd_tel_cli = $ddd_tel, num_tel_cli = $num_tel WHERE idcliente = $idcliente";
    $result = mysqli_query($conexao, $query) or die("Erro no banco de dados elementar 2!");
    if ($result === true) {
        $query = "UPDATE endereco_cliente SET cep_end_cliente = $cep, logradouro_end_cliente = '$logradouro', num_end_cliente = $numero, comple_end_cliente = '$complemento', bairro_end_cliente = '$bairro', cidade_end_cliente = '$cidade', uf_end_cliente = '$estado' WHERE idcliente = $idcliente";
        $result = mysqli_query($conexao, $query) or die("Erro no banco de dados elementar 3!");
    } else {
        echo "<script>alert('Não foi possível salvar as alterações.'); location.href='../pages/clientes';</script>";
    }
    if ($result === true) {
        echo "<script>location.href='../pages/clientes';</script>";
    } else {
        echo "<script>alert('Não foi possível salvar as alterações.'); location.href='../pages/clientes';</script>";
    }
} else {
    echo "<script>alert('Não foi possível salvar as alterações.'); location.href='../pages/clientes';</script>";
}
?>

?>