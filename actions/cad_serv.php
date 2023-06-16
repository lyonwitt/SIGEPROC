<?php

use function PHPSTORM_META\type;

session_start();

include("config.php");

$idpedido = (int)preg_replace('/[^0-9]/', '', $_POST['id_pedido']);
$modelo_cabelo = $_POST['modelo_cabelo'];
$qtde_cabelo = $_POST['qtde_cabelo'];
$tam_cabelo = $_POST['tam_cabelo'];
$proced_cabelo = $_POST['proced_cabelo'];
$tipo_cabelo = $_POST['tipo_cabelo'];
$cor_elastico = $_POST['cor_elastico'];
$cor_liga = $_POST['cor_liga'];
$val_total =  $_POST['valor_total'];


$query = "SELECT id_pedido FROM pedidos WHERE id_pedido = $idpedido";
$result = mysqli_query($conexao, $query) or die('Erro no Banco de Dados 1!');
$total = mysqli_num_rows($result);

if ($total == 1) {
    $query = "INSERT INTO servicos (id_serv, idpedido, modelo_cabelo, qtde_cabelo, tam_cabelo, proced_cabelo, tipo_cabelo, cor_elastico, cor_liga, valor_total, valor_pago, valor_rest, fase_prod)
                VALUES (NULL, $idpedido, '$modelo_cabelo', $qtde_cabelo, $tam_cabelo, '$proced_cabelo', '$tipo_cabelo', '$cor_elastico', '$cor_liga', '$val_total', '0', '$val_total', 'Separação e Identificação')";
    $insert = mysqli_query($conexao, $query) or die ("Erro no banco de dados 2!");
    

    if ($insert === true) {
        $query = "SELECT id_serv FROM servicos ORDER BY id_serv DESC LIMIT 1";
        $result = mysqli_query($conexao, $query) or die("Erro no banco de dados 3!");
        $total = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);

        $id_serv = $row['id_serv'];

        if ($total == 1) {
            $qtd_uso = $_POST['qtd_uso'];
            $produto_serv = strstr($_POST['produto_serv'], ' ', true);
            $query = "INSERT INTO produto_serv (idserv, codprod, qtde_uso) VALUES ($id_serv, $produto_serv, $qtd_uso)";
            $insert = mysqli_query($conexao, $query) or die("Erro no banco de dados 4!");
            
            if ($insert === true) {
                // reduzindo do estoque
                $query = "SELECT * FROM produto_serv ORDER BY idserv DESC LIMIT 1";
                $result = mysqli_query($conexao, $query) or die("Erro no banco reduce!");
                $row = mysqli_fetch_assoc($result);
                $qtde_uso = $row['qtde_uso'];
                
                $query = "UPDATE produtos SET qtde_prod = qtde_prod - $qtde_uso WHERE cod_prod = $produto_serv";
                $update = mysqli_query($conexao, $query) or die("Erro no banco de dados reduce2!");

                for ($i = 2; $i < 15; $i++) {
                    if (isset($_POST['qtd_uso'.$i.'']) && isset($_POST['produto_serv'.$i.''])) {
                        
                        $qtd_uso = $_POST['qtd_uso'.$i.''];
                        $produto_serv = strstr($_POST['produto_serv'.$i.''], ' ', true);

                        $query = "INSERT INTO produto_serv (idserv, codprod, qtde_uso) VALUES ($id_serv, $produto_serv, $qtd_uso)";
                        $insert = mysqli_query($conexao, $query) or die("Erro no banco de dados 5!");

                        if ($insert === true) {
                            $query = "SELECT * FROM produto_serv ORDER BY idserv DESC LIMIT 1";
                            $result = mysqli_query($conexao, $query) or die("Erro no banco reduce!");
                            $row = mysqli_fetch_assoc($result);
                            $qtde_uso = $row['qtde_uso'];
                            
                            $query = "UPDATE produtos SET qtde_prod = qtde_prod - $qtde_uso WHERE cod_prod = $produto_serv";
                            $update = mysqli_query($conexao, $query) or die("Erro no banco de dados reduce2!");
                        }
                    } else {
                            break;
                        }
                }
                echo "<script>alert('O Serviço ".$id_serv." foi inserido com sucesso!'); location.href='../pages/servicos';</script>";
            } else {
                echo "<script>alert('Algo deu errado por aqui!'); location.href='../pages/servicos';</script>";
            }

        } else {
            echo "<script>alert('Algo deu errado!'); location.href='../pages/servicos';</script>";
        }
        
    } else {
        echo "<script>alert('Algo deu errado 2!'); location.href='../pages/servicos';</script>";
    }
} else {
    echo "<script>alert('Não foi possível inserir o serviço".gettype($idpedido)."!'); location.href='../pages/servicos';</script>";
}
