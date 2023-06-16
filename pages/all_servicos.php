<?php
include('../actions/verifica.php');
$id_user = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='../css/me.css'>
    <title>SIGEPROC - Sistema de Gerenciamento de Produção Capilar</title><!-- FONTAWESOME -->
    <link rel='stylesheet' href='../font-awesome/css/all.css'>
    <link rel='shortcut icon' href='../font-awesome/svgs/solid/gears.svg' type='image/x-icon'>
    <!-- FONTES -->
    <link href='https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Open+Sans:wght@300;400;500;600;700&family=Roboto:wght@100;300;400;500;700&display=swap' rel='stylesheet'>

    <!-- BOOTSTRAP -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>

</head>

<body>
    <div class="container">
        <!-- primeiro serviço -->
        <?php
        include_once("../actions/config.php");
        $query = "SELECT * FROM pedidos p INNER JOIN servicos s ON p.id_pedido = s.idpedido INNER JOIN clientes c ON p.idcliente = c.id_cliente WHERE s.fase_prod <> 'Concluído' AND s.valor_rest <> ',0' ORDER BY data_termino ASC";
        $result = mysqli_query($conexao, $query) or die('ERROR');
        $total = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if ($total > 0) {
            do {
                $idpedido = $row['id_pedido'];
                $idservico = $row['id_serv'];
        ?>
                <div class="d-flex justify-content-center mt-5 flex-wrap">
                    <div class="card col-10 m-2">
                        <div class="card-header bg-info">
                            <h5 class="card-title mb-0">CLIENTE: <strong class="text-uppercase text-dark">
                                    <?php
                                    /* Separa o nome pelos os espaços na string */
                                    $arr = explode(' ', $row['nome_cliente']);
                                    /* Junta os dois primeiros nomes em uma nova string */
                                    $twoNames = $arr[0] . ' ' . $arr[1];

                                    echo $twoNames;
                                    ?>
                                </strong>&nbsp;|&nbsp;ID do Cliente: <strong class='text-uppercase text-dark'> <?= $row['idcliente'] ?></strong>
                                </strong>&nbsp;|&nbsp;Nº Pedido: <strong class='text-uppercase text-dark'> <?= $row['id_pedido'] ?></strong>
                                </strong>&nbsp;|&nbsp;Data de Entrega: <strong class='text-uppercase text-dark'> <?php $data = $row['data_termino'];
                                                                                                                    echo date('d/m/Y', strtotime($data)); ?></strong>

                            </h5>
                        </div>
                        <?php
                        $query2 = "SELECT * FROM servicos WHERE idpedido = $idpedido";
                        $result2 = mysqli_query($conexao, $query2) or die("ERRO");
                        $total2 = mysqli_num_rows($result2);
                        $row2 = mysqli_fetch_assoc($result2);

                        if ($total2 > 0) {
                            do {
                        ?>
                                <div class="card-body p-0">
                                    <ul class="border list-group list-group-flush">
                                        <li class="list-group-item bg-light">
                                            <h6 class="card-title mb-0">ID do Serviço: <strong class="text-uppercase"><?= $row2['id_serv']; ?></strong> | Modelo do Cabelo: <strong class="text-uppercase"><?= $row2['modelo_cabelo']; ?></strong></h6>
                                        </li>
                                        <li class="list-group-item bg-light d-flex align-items-center justify-content-between">
                                            <div class="col-6 bg-light">
                                                <h6 class="mb-0">Quantidade de cabelo (kg): <strong class="text-uppercase"><?= $row2['qtde_cabelo'] ?></strong></h6>
                                            </div>
                                            <div class="col-6 bg-light">
                                                <h6 class="mb-0">Tamanho do cabelo (cm): <strong class="text-uppercase"><?= $row2['tam_cabelo'] ?></strong></h6>
                                            </div>
                                        </li>
                                        <li class="list-group-item bg-light d-flex align-items-center justify-content-between">
                                            <div class="col-6 bg-light">
                                                <h6 class="mb-0">Procedência do cabelo: <strong class="text-uppercase"><?= $row2['proced_cabelo'] ?></strong></h6>
                                            </div>
                                            <div class="col-6 bg-light">
                                                <h6 class="mb-0">Tipo do cabelo: <strong class="text-uppercase"><?= $row2['tipo_cabelo'] ?></strong></h6>
                                            </div>
                                        </li>
                                        <li class="list-group-item bg-light d-flex align-items-center justify-content-between">
                                            <div class="col-6 bg-light">
                                                <h6 class="mb-0">Cor do Elástico: <strong class="text-uppercase"><?= $row2['cor_elastico'] ?></strong></h6>
                                            </div>
                                            <div class="col-6 bg-light">
                                                <h6 class="mb-0">Cor da Liga: <strong class="text-uppercase"><?= $row2['cor_liga'] ?></strong></h6>
                                            </div>
                                        </li>
                                        <li class="list-group-item bg-light d-flex align-items-center">
                                            <h6 class="mb-0 text-success">Fase da Produção: <strong class="text-uppercase"><?= $row2['fase_prod'] ?></strong></h6>
                                        </li>

                                    </ul>
                                    <div class="col-12 border-0">
                                        <div class="list-group-item bg-secondary">
                                            <h6 class="mb-0 text-uppercase text-white">QTDE de
                                                Produtos
                                                a Utilizar&nbsp;<i class="fa-solid fa-chevron-down"></i>
                                            </h6>
                                        </div>
                                        <div class="list-group-item" id="qtde_prod">
                                            <?php
                                            $query3 = "SELECT p.name_prod, ps.qtde_uso, p.und_medida FROM produto_serv ps INNER JOIN produtos p ON ps.codprod = p.cod_prod INNER JOIN servicos s ON s.id_serv = ps.idserv WHERE s.id_serv = $idservico";
                                            $result3 = mysqli_query($conexao, $query3) or die('ERROR');

                                            $total3 = mysqli_num_rows($result3);

                                            if ($total3 > 0) {
                                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                                    echo "<h6 class='mb-0'>" . $row3['name_prod'] . ": <strong class='text-uppercase'>" . $row3['qtde_uso'] . " " . $row3['und_medida'] . "</strong></h6>";
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="list-group-item bg-dark" id="qtde_prod">
                                        </div>
                                    </div>
                                </div>
                        <?php
                            } while ($row2 = mysqli_fetch_assoc($result2));
                        }
                        ?>
                    </div>
                </div>
        <?php
            } while ($row = mysqli_fetch_assoc($result) && $row['idpedido'] != $idpedido);
        }
        ?>
        <!-- demais serviços -->
        <?php
        include_once("../actions/config.php");
        $query = "SELECT * FROM pedidos p INNER JOIN servicos s ON p.id_pedido = s.idpedido INNER JOIN clientes c ON p.idcliente = c.id_cliente WHERE s.fase_prod <> 'Concluído' AND s.valor_rest <> ',0' ORDER BY data_termino ASC";
        $result = mysqli_query($conexao, $query) or die('ERROR');
        $total = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if ($total > 0) {
            do {
                if ($row['idpedido'] != $idpedido) {
                    $idpedido = $row['id_pedido'];
                    $idservico = $row['id_serv'];
        ?>
                    <div class="d-flex justify-content-center mt-5 flex-wrap">
                        <div class="card col-10 m-2">
                            <div class="card-header bg-info">
                                <h5 class="card-title mb-0">CLIENTE: <strong class="text-uppercase text-dark">
                                        <?php
                                        /* Separa o nome pelos os espaços na string */
                                        $arr = explode(' ', $row['nome_cliente']);
                                        /* Junta os dois primeiros nomes em uma nova string */
                                        $twoNames = $arr[0] . ' ' . $arr[1];

                                        echo $twoNames;
                                        ?>
                                    </strong>&nbsp;|&nbsp;ID do Cliente: <strong class='text-uppercase text-dark'> <?= $row['idcliente'] ?></strong>
                                    </strong>&nbsp;|&nbsp;Nº Pedido: <strong class='text-uppercase text-dark'> <?= $row['id_pedido'] ?></strong>
                                    </strong>&nbsp;|&nbsp;Data de Entrega: <strong class='text-uppercase text-dark'> <?php $data = $row['data_termino'];
                                                                                                                        echo date('d/m/Y', strtotime($data)); ?></strong>

                                </h5>
                            </div>
                            <?php
                            $query2 = "SELECT * FROM servicos WHERE idpedido = $idpedido";
                            $result2 = mysqli_query($conexao, $query2) or die("ERRO");
                            $total2 = mysqli_num_rows($result2);
                            $row2 = mysqli_fetch_assoc($result2);

                            if ($total2 > 0) {
                                do {
                            ?>
                                    <div class="card-body p-0">
                                        <ul class="border list-group list-group-flush">
                                            <li class="list-group-item bg-light">
                                                <h6 class="card-title mb-0">ID do Serviço: <strong class="text-uppercase"><?= $row2['id_serv']; ?></strong> | Modelo do Cabelo: <strong class="text-uppercase"><?= $row2['modelo_cabelo']; ?></strong></h6>
                                            </li>
                                            <li class="list-group-item bg-light d-flex align-items-center justify-content-between">
                                                <div class="col-6 bg-light">
                                                    <h6 class="mb-0">Quantidade de cabelo (kg): <strong class="text-uppercase"><?= $row2['qtde_cabelo'] ?></strong></h6>
                                                </div>
                                                <div class="col-6 bg-light">
                                                    <h6 class="mb-0">Tamanho do cabelo (cm): <strong class="text-uppercase"><?= $row2['tam_cabelo'] ?></strong></h6>
                                                </div>
                                            </li>
                                            <li class="list-group-item bg-light d-flex align-items-center justify-content-between">
                                                <div class="col-6 bg-light">
                                                    <h6 class="mb-0">Procedência do cabelo: <strong class="text-uppercase"><?= $row2['proced_cabelo'] ?></strong></h6>
                                                </div>
                                                <div class="col-6 bg-light">
                                                    <h6 class="mb-0">Tipo do cabelo: <strong class="text-uppercase"><?= $row2['tipo_cabelo'] ?></strong></h6>
                                                </div>
                                            </li>
                                            <li class="list-group-item bg-light d-flex align-items-center justify-content-between">
                                                <div class="col-6 bg-light">
                                                    <h6 class="mb-0">Cor do Elástico: <strong class="text-uppercase"><?= $row2['cor_elastico'] ?></strong></h6>
                                                </div>
                                                <div class="col-6 bg-light">
                                                    <h6 class="mb-0">Cor da Liga: <strong class="text-uppercase"><?= $row2['cor_liga'] ?></strong></h6>
                                                </div>
                                            </li>
                                            <li class="list-group-item bg-light d-flex align-items-center">
                                                <h6 class="mb-0 text-success">Fase da Produção: <strong class="text-uppercase"><?= $row2['fase_prod'] ?></strong></h6>
                                            </li>

                                        </ul>
                                        <div class="col-12 border-0">
                                            <div class="list-group-item bg-secondary">
                                                <h6 class="mb-0 text-uppercase text-white">QTDE de
                                                    Produtos
                                                    a Utilizar&nbsp;<i class="fa-solid fa-chevron-down"></i>
                                                </h6>
                                            </div>
                                            <div class="list-group-item" id="qtde_prod">
                                                <?php
                                                $query3 = "SELECT p.name_prod, ps.qtde_uso, p.und_medida FROM produto_serv ps INNER JOIN produtos p ON ps.codprod = p.cod_prod INNER JOIN servicos s ON s.id_serv = ps.idserv WHERE s.id_serv = $idservico";
                                                $result3 = mysqli_query($conexao, $query3) or die('ERROR');

                                                $total3 = mysqli_num_rows($result3);

                                                if ($total3 > 0) {
                                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                                        echo "<h6 class='mb-0'>" . $row3['name_prod'] . ": <strong class='text-uppercase'>" . $row3['qtde_uso'] . " " . $row3['und_medida'] . "</strong></h6>";
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="list-group-item bg-dark" id="qtde_prod">
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                } while ($row2 = mysqli_fetch_assoc($result2));
                            }
                            ?>
                        </div>
                    </div>
        <?php
                }
            } while ($row = mysqli_fetch_assoc($result));
        }
        ?>
    </div>
    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="../js/form.js"></script>
</body>

</html>