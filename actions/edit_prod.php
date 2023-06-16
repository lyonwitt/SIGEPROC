<?php

include_once ('config.php');

$cod_prod = $_POST['cod_prod'];

$qtde_prod = $_POST['qtde_prod'];

$query = "SELECT * FROM produtos WHERE cod_prod = $cod_prod";
$result = mysqli_query($conexao, $query) or die ('Erro de conexão');
$total = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

if ($total == 1) {
    $query = "UPDATE produtos SET qtde_prod = qtde_prod + $qtde_prod WHERE cod_prod = $cod_prod";
    $result = mysqli_query($conexao, $query) or die ('Erro no update');

    if ($result === true){
        echo "<script>alert('O produto ".$row['name_prod']." com o ID ".$cod_prod." foi alterado com sucesso!'); location.href='../pages/estoque';</script>";
    } else {
        echo "<script>alert('Alguma coisa deu errado!'); location.href='../pages/estoque';</script>";
    }
}

?>