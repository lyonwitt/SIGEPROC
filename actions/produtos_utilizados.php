<?php
include_once('config.php');
include_once('../pages/servicos.php');
$query = "SELECT p.name_prod, ps.qtde_uso, p.und_medida FROM produto_serv ps INNER JOIN produtos p ON ps.codprod = p.cod_prod INNER JOIN servicos s ON s.id_serv = ps.idserv WHERE s.idcliente = $idcliente AND s.id_serv = $idservico";
$result = mysqli_query($conexao, $query) or die('ERROR');

$total = mysqli_num_rows($result);

if ($total > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo"<h6 class='mb-0'>".$row['name_prod'].": <strong class='text-uppercase'>".$row['qtde_uso']." ".$row['und_medida']."</strong><strong>s</strong></h6>";
    }
}
?>