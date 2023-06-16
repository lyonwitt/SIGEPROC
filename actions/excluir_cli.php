<?php

include("config.php");

$idcliente = $_POST['idcliente'];

$query = "SELECT * FROM pedidos WHERE idcliente = $idcliente";
$result = mysqli_query($conexao, $query) or die('Erro de conexão ao banco 1');
$total = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$id_pedido = $row['id_pedido'];

if ($total > 0) {
    $query = "SELECT * FROM produto_serv ps INNER JOIN servicos s ON ps.idserv = s.id_serv WHERE s.idpedido = $id_pedido";
    $result = mysqli_query($conexao, $query) or die('Erro de conexão ao banco as');
    $total = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    $idserv = $row['idserv'];

    if ($total > 0) {
        do {
            $query = "DELETE FROM produto_serv WHERE idserv = $idserv";
            $result = mysqli_query($conexao, $query) or die("Erro no banco ao excluir os produtos do serviço");
        } while ($total > 0);
    }
} else {

    $query = "SELECT * FROM servicos WHERE idpedido = $id_pedido";
    $result = mysqli_query($conexao, $query) or die('Erro de conexão ao banco 2');
    $total = mysqli_num_rows($result);

    if ($total > 0) {
        do {
            $query = "DELETE FROM servicos WHERE idpedido = $id_pedido";
            $result = mysqli_query($conexao, $query) or die("Erro no banco ao excluir os serviços");
        } while ($row = mysqli_fetch_array($result));
    } else {
        $query = "SELECT * FROM pedidos WHERE id_pedido = $id_pedido";
        $result = mysqli_query($conexao, $query) or die('Erro de conexão ao banco 2');
        $total = mysqli_num_rows($result);

        if ($total > 0) {
            do {
                $query = "DELETE FROM pedidos WHERE id_pedido = $id_pedido";
                $result = mysqli_query($conexao, $query) or die("Erro no banco ao excluir os serviços");
            } while ($row = mysqli_fetch_array($result));
        } else {
            $query = "SELECT * FROM endereco_cliente WHERE idcliente = $idcliente";
            $result = mysqli_query($conexao, $query) or die('Erro de conexão ao banco 2');
            $total = mysqli_num_rows($result);

            if ($total > 0) {
                do {
                    $query = "DELETE FROM endereco_cliente WHERE idcliente = $idcliente";
                    $result = mysqli_query($conexao, $query) or die("Erro no banco ao excluir os serviços");
                } while ($row = mysqli_fetch_array($result));
            } else {
                $query = "SELECT * FROM tel_cliente WHERE idcliente = $idcliente";
                $result = mysqli_query($conexao, $query) or die('Erro de conexão ao banco 2');
                $total = mysqli_num_rows($result);

                if ($total > 0) {
                    do {
                        $query = "DELETE FROM tel_cliente WHERE idcliente = $idcliente";
                        $result = mysqli_query($conexao, $query) or die("Erro no banco ao excluir os serviços");
                    } while ($row = mysqli_fetch_array($result));
                } else {
                    $query = "SELECT * FROM clientes WHERE id_cliente = $idcliente";
                    $result = mysqli_query($conexao, $query) or die('Erro de conexão ao banco 2');
                    $total = mysqli_num_rows($result);

                    if ($total > 0) {
                        $query = "DELETE FROM clientes WHERE id_cliente = $idcliente";
                        $result = mysqli_query($conexao, $query) or die("Erro no banco ao excluir os serviços");

                        if ($result === true) {
                            echo "<script>alert('Cliente excluído com sucesso!'); location.href='../pages/clientes';</script>";
                        } else {
                            echo "<script>alert('Algo deu errado por aqui!'); location.href='../pages/clientes';</script>";
                        }
                    }
                }
            }
        }
    }
}
