<?php
include_once ("config.php");
$query = 'SELECT * FROM produtos';
$result = mysqli_query($conexao, $query) or die('Erro no Banco de Dados');
$row = mysqli_fetch_assoc($result);
$total = mysqli_num_rows($result);
if ($total > 0) {
do { 
    echo "<option> ID: ".$row['cod_prod']." | Nome: ".$row['name_prod']." | Und de medida: ".$row['und_medida']."</option>";
    } while ($row = mysqli_fetch_assoc($result));
}   
?>