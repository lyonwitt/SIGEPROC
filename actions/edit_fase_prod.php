<?php
include_once ("config.php");

$fase_prod =  $_POST['fase_prod'];

$idservico =  $_POST['idservico'];

$query = "SELECT id_serv FROM servicos WHERE id_serv = $idservico";
$result = mysqli_query($conexao, $query) or die ('Erro no Banco de Dados');

$total = mysqli_num_rows($result);

$row = mysqli_fetch_assoc($result);

if($total == 1){
    $query = "UPDATE servicos SET fase_prod = '$fase_prod' WHERE id_serv = $idservico";
    $insert = mysqli_query($conexao, $query) or die ('Erro no Banco de Dados');

    if ($insert === true) {
        echo "<script>alert('O fase de produção do Serviço ".$idservico." foi alterada com sucesso!'); location.href='../pages/servicos';</script>";
    } else {
        echo "<script>alert('Algo deu errado!'); location.href='../pages/servicos';</script>";
    }
}

?>