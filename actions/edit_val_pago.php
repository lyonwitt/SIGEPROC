<?php
include_once ("config.php");

$val_pago =  $_POST['val_pago'];

$idservico =  $_POST['idservico'];

$query = "SELECT valor_total, valor_pago, valor_rest FROM servicos WHERE id_serv = $idservico";
$result = mysqli_query($conexao, $query) or die ('Erro no Banco de Dados');

$total = mysqli_num_rows($result);

$row = mysqli_fetch_assoc($result);

if($total == 1){
    if ($row['valor_pago'] != '0') {
        $val_pago2 = str_replace(",", "", $val_pago) + str_replace(",", "", $row['valor_pago']);
        $val_pago2 = substr_replace($val_pago2, ',', -2, 0);

        $val_restante = str_replace(",", "", $row['valor_total']) - str_replace(",", "", $val_pago2);
        $val_restante = substr_replace($val_restante, ',', -2, 0);

        $query = "UPDATE servicos SET valor_pago = '$val_pago2', valor_rest = '$val_restante' WHERE id_serv = $idservico";
        $insert = mysqli_query($conexao, $query) or die ('Erro no Banco de Dados');
        
        if ($insert === true) {
            echo "<script>alert('O Valor Pago e o Valor Restante do Serviço ".$idservico." foram alterados com sucesso!'); location.href='../pages/servicos';</script>";
        } else {
            echo "<script>alert('Algo deu errado!'); location.href='../pages/servicos';</script>";
        }

    } elseif ($row['valor_pago'] == '0') {
        $val_restante = str_replace(",", "", $row['valor_total']) - str_replace(",", "", $val_pago);
        $val_restante = substr_replace($val_restante, ',', -2, 0);

        $query = "UPDATE servicos SET valor_pago = '$val_pago', valor_rest = '$val_restante' WHERE id_serv = $idservico";
        $insert = mysqli_query($conexao, $query) or die ('Erro no Banco de Dados');

        if ($insert === true) {
            echo "<script>alert('O Valor Pago e o Valor Restante do Serviço ".$idservico." foram alterados com sucesso!'); location.href='../pages/servicos';</script>";
        } else {
            echo "<script>alert('Algo deu errado!'); location.href='../pages/servicos';</script>";
        }
    }
}
