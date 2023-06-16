<?php
session_start();

include("config.php");

function deixarNumero($string){
    return preg_replace("/[^0-9]/", "", $string);
}

$id_user = $_SESSION['id'];

$nome = strtoupper($_POST['name']);
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

if ($id_user >= 3) {
    echo "<script>alert('Você não tem permissão para cadastrar!'); location.href='../pages/clientes';</script>";
} elseif ($id_user > 0 && $id_user < 3) {
    $query = "INSERT INTO clientes (id_cliente, iduser, nome_cliente, cpf_cliente, email_cliente) VALUES (NULL, $id_user, '$nome', '$cpf', '$email')";
    $insert = mysqli_query($conexao, $query) or die ("Erro no banco de dados one!");

    if ($insert === true) {
        $query = "SELECT * FROM clientes ORDER BY id_cliente DESC LIMIT 1";
        $result = mysqli_query($conexao, $query) or die("Erro no banco de dados two!");
        $total = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        $idcliente = $row['id_cliente'];

        if ($total == 1) {
            $query = sprintf("INSERT INTO tel_cliente (idcliente, ddd_tel_cli, num_tel_cli) VALUES ($idcliente, $ddd_tel, $num_tel)");
            $insert2 = mysqli_query($conexao, $query) or die("Erro no banco de dados three!");
            
            if (empty($cep)) {
                
                if ($insert2 === true) {

                    echo "<script>alert('O Cliente $nome recebeu o ID: $idcliente e foi cadastrado com sucesso!'); location.href='../pages/clientes';</script>";
              }
            } else {
                
                if ($insert2 === true) {
                    $query = sprintf("INSERT INTO endereco_cliente (idcliente, cep_end_cliente, logradouro_end_cliente, num_end_cliente, comple_end_cliente, bairro_end_cliente, cidade_end_cliente, uf_end_cliente) VALUES ($idcliente, $cep, '$logradouro', $numero, '$complemento', '$bairro', '$cidade', '$estado')");

                     $insert3 = mysqli_query($conexao, $query) or die("Erro no banco de dados four!");
                     
                     if ($insert3 === true) {
                        echo "<script>alert('O Cliente $nome recebeu o ID: $idcliente e foi cadastrado com sucesso!'); location.href='../pages/clientes';</script>";
                     }
                }
                 
            }

            

          

        } else {
            echo "<script>alert('Algo deu errado por aqui!'); location.href='../pages/clientes';</script>";
        }

    } else {
        echo "<script>alert('Algo deu errado por aqui!'); location.href='../pages/clientes';</script>";
    }
} else {
    echo "<script>alert('Algo deu errado por aqui!'); location.href='../pages/clientes';</script>";
}



?>