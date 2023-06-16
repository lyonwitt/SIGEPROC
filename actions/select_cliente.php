<?php

$idcliente = strstr($_POST['select_cliente'], ' ', true);

if ($idcliente == 0) {
    echo "<script>location.href='../pages/servicos';</script>";
} else {
    echo "<script>alert('O ID do Cliente é $idcliente'); location.href='../pages/servicos';</script>";
}
?>