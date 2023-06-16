<?php

use function PHPSTORM_META\type;

session_start();

include("config.php");


$idcliente = $_POST['id_cliente'];
$data_inicio = date('Y-m-d');
$data_termino = $_POST['data_termino'];

if ($idcliente != NULL) {
    $query = "INSERT INTO pedidos (id_pedido, idcliente, data_inicio, data_termino)
                VALUES (NULL, $idcliente, '$data_inicio', '$data_termino')";
    $insert = mysqli_query($conexao, $query) or die("Erro no banco de dados 1!");


    if ($insert === true) {
        $query = "SELECT id_pedido FROM pedidos ORDER BY id_pedido DESC LIMIT 1";
        $result = mysqli_query($conexao, $query) or die("Erro no banco de dados 2!");
        $row = mysqli_fetch_array($result);

        $id_pedido = $row['id_pedido'];

        echo "<script>alert('O Pedido Nº " . $id_pedido . " foi inserido com sucesso!'); location.href='../pages/servicos';</script>";
    } else {
        echo "<script>alert('Algo deu errado por aqui!'); location.href='../pages/servicos';</script>";
    }
} else {
    echo "<script>alert('Não foi possível inserir o serviço!'); location.href='../pages/servicos';</script>";
}
?>
