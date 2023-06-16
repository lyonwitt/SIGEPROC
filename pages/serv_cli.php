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
    <header>
        <!-- MENU MOBILE -->
        <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
            <div class='container d-flex justify-content-between'>
                <button class='bg-transparent border-0 d-block d-sm-block d-md-block d-lg-none d-xl-none' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavDropdown' aria-controls='navbarNavDropdown' aria-expanded='false' aria-label='Toggle navigation'>
                    <i class='fa-solid fa-bars text-white-50'></i>
                </button>

                <div class="collapse navbar-collapse w-100 justify-content-between px-2" id="navbarNavDropdown">
                    <ul class="navbar-nav w-75 justify-content-start">
                        <li class="nav-item p-2">
                            <a class="nav-link" href="./me">
                                <i class="fa fa-house"></i>
                                &nbsp;
                                Início
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link" href="./clientes">
                                <i class="fa fa-users"></i>
                                &nbsp;
                                Clientes
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link" href="./estoque">
                                <i class="fa fa-cubes-stacked"></i>
                                &nbsp;
                                Estoque
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link" href="./servicos">
                                <i class="fa fa-briefcase"></i>
                                &nbsp;
                                Serviços
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link" href="./relatorio">
                                <i class="fa-solid fa-note-sticky"></i>
                                &nbsp;
                                Relatório Mensal
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav justify-content-end px-2 d-flex d-sm-flex d-md-none w-100">
                        <a href="../actions/logout" class="text-decoration-none border border-danger border-2 rounded">
                            <div type="submit" class="d-flex justify-content-center align-items-center py-2 px-3">
                                <i class="fa-solid fa-close text-danger"></i>
                                <h6 class="text-danger mb-1">&nbsp;&nbsp;Sair da conta</h6>
                            </div>
                        </a>
                    </ul>
                    <ul class="navbar-nav justify-content-end px-2 d-none d-sm-none d-md-flex w-25">
                        <a href="../actions/logout" class="text-decoration-none border border-danger border-2 rounded">
                            <div type="submit" class="d-flex justify-content-center align-items-center py-2 px-3">
                                <i class="fa-solid fa-close text-danger"></i>
                                <h6 class="text-danger mb-1">&nbsp;&nbsp;Sair da conta</h6>
                            </div>
                        </a>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- CONTENT -->
    <div class="container">
        <!-- SERVIÇOS -->
        <div class="card m-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center my-0 mb-0">
                    <h5><strong>Serviços do Cliente:</strong></h5>&nbsp;&nbsp;
                    <h5 class="text-muted"><?php if (isset($_POST['select_cliente'])) {
                                                echo $_POST['select_cliente'];
                                            } else {
                                                echo "-";
                                            } ?></h5>
                </div>
                <i class="d-none d-md-block fa fa-briefcase"></i>
            </div>
            <div class="card-body">
                <!-- serviços em andamento -->
                <div class="d-flex flex-wrap justify-content-between col-12">
                    <!-- SERVIÇOS POR CLIENTE -->
                    <div class="services w-100 m-2">
                        <!-- serviços em execução -->
                        <div class="border-bottom border-2 my-4 mx-2 border-warning">
                            <h4 class="py-1">Serviços em execução</h4>
                        </div>
                        <div class="content-serv">
                            <!-- primeiro servic=ço -->
                            <?php
                            if (isset($_POST['select_cliente'])) {
                                include_once('../actions/config.php');
                                $idcliente = strstr($_POST['select_cliente'], " ", true);
                                $query = "SELECT * FROM pedidos p INNER JOIN servicos s ON s.idpedido = p.id_pedido WHERE idcliente = $idcliente";
                                $result = mysqli_query($conexao, $query) or die('ERROR');
                                $total = mysqli_num_rows($result);
                                $row = mysqli_fetch_assoc($result);

                                if ($total > 0 && ($row['fase_prod'] != 'Concluído' || $row['valor_rest'] != ',0')) {
                                    do {
                                        $idpedido = $row['id_pedido'];
                            ?>
                                        <div class="d-flex aligm-items-center">
                                            <button type=" button" class="m-2 btn btn-warning text-dark font-weight-bold" data-bs-toggle="collapse" data-bs-target="#servPed<?= $row['id_pedido'] ?>" aria-expanded="false" aria-controls="collapseExample">Pedido Nº <?= $row['id_pedido'] ?></button>
                                        </div>

                                        <!-- SERVIÇOS POR PEDIDO -->
                                        <div class="card collapse m-2" id="servPed<?= $row['id_pedido'] ?>">
                                            <div class="card-header">
                                                <h5>Serviços do Pedido nº <strong><?= $row['id_pedido'] ?> | Data de Entrega do Pedido: </strong><strong class="text-danger, text-uppercase"><?php $data = $row['data_termino'];
                                                                                                                                                                                                echo date('d/m/Y', strtotime($data)); ?></strong></h6>
                                                    </strong></h5>
                                            </div>
                                            <div class="card-body">

                                                <div id="services<?= $row['id_pedido'] ?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="0">
                                                    <div class="carousel-inner">
                                                        <?php
                                                        $query2 = "SELECT * FROM servicos WHERE idpedido = $idpedido ORDER BY id_serv DESC LIMIT 1";
                                                        $result2 = mysqli_query($conexao, $query2) or die('Erro demais!');
                                                        $total2 = mysqli_num_rows($result2);
                                                        $row2 = mysqli_fetch_assoc($result2);
                                                        if ($total2 == 1 && ($row2['fase_prod'] != 'Concluído' || $row2['valor_rest'] != ',0') && $row2['idpedido'] == $idpedido) {
                                                            $idservico = $row2['id_serv'];
                                                        ?>
                                                            <div class="carousel-item active">
                                                                <div class="d-flex justify-content-center">
                                                                    <div class="col-md-9 col-lg-9 card m-2">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">ID do Serviço: <strong class="text-uppercase"><?= $row2['id_serv']; ?></strong></h5>
                                                                            <h5 class="card-title">Modelo do Cabelo: <strong class="text-uppercase"><?= $row2['modelo_cabelo']; ?></strong></h5>
                                                                        </div>
                                                                        <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0">Quantidade de cabelo (kg): <strong class="text-uppercase"><?= $row2['qtde_cabelo'] ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0">Tamanho do cabelo (cm): <strong class="text-uppercase"><?= $row2['tam_cabelo'] ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0">Procedência do cabelo: <strong class="text-uppercase"><?= $row2['proced_cabelo'] ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0">Tipo do cabelo: <strong class="text-uppercase"><?= $row2['tipo_cabelo'] ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0">Cor do Elástico: <strong class="text-uppercase"><?= $row2['cor_elastico'] ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0">Cor da Liga: <strong class="text-uppercase"><?= $row2['cor_liga'] ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light d-flex align-items-center">
                                                                                <h6 class="mb-0 text-primary">Fase da Produção: <strong class="text-uppercase"><?= $row2['fase_prod'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;</strong></h6>
                                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#editfase" class="border-0 bg-transparent d-flex align-items-center justify-content-center text-muted">
                                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                                    <h6 class="mb-0">&nbsp;Editar</h6>
                                                                                </button>
                                                                            </li>
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0 text-success">Valor do Serviço: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                    echo 'xxx';
                                                                                                                                                                } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                    echo $row2['valor_total'];
                                                                                                                                                                } ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light d-flex align-items-center">
                                                                                <h6 class="mb-0 text-black">Valor pago: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                            echo 'xxx';
                                                                                                                                                        } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                            echo $row2['valor_pago'];
                                                                                                                                                        } ?>&nbsp;&nbsp;|&nbsp;&nbsp;</strong>
                                                                                </h6>
                                                                                <?php if ($id_user == 1 || $id_user == 2) {
                                                                                    echo
                                                                                    '<button type="button" data-bs-toggle="modal" data-bs-target="#editvalpago" class="border-0 bg-transparent d-flex align-items-center justify-content-center text-secondary">
                                                                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                                                                            <h6 class="mb-0">&nbsp;Editar</h6>
                                                                                                            </button>';
                                                                                } else {
                                                                                    echo "xxx";
                                                                                }
                                                                                ?>
                                                                            </li>
                                                                            <li class="list-group-item bg-light border-0">
                                                                                <h6 class="mb-0 text-danger">Valor a pagar: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                echo 'xxx';
                                                                                                                                                            } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                echo $row2['valor_rest'];
                                                                                                                                                            } ?></strong></h6>
                                                                            </li>
                                                                        </ul>
                                                                        <!-- Editar o Valor Pago -->
                                                                        <div class="modal fade" id="editvalpago" tabindex="-1" aria-labelledby="editvalpagoLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                <form class="modal-content" method="post" action="../actions/edit_val_pago">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="editvalpagoLabel">Editar o Valor
                                                                                            Pago <input type="text" class="d-none border-0 bg-transparent text-white" id="idservico" name="idservico" value="<?php echo $idservico; ?>"></h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <label for="valpago">
                                                                                            <h6>Valor pago pelo cliente:</h6>
                                                                                        </label>
                                                                                        <div class="input-group mb-3">
                                                                                            <span class="input-group-text rounded-start">R$</span>
                                                                                            <input type="text" class="form-control" name="val_pago" aria-label="Valor em reais" value="" size="12" onKeyUp="mascaraMoeda(this, event)" placeholder="Digite o valor pago pelo cliente">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-success">Salvar</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Editar a Fase de Produção -->
                                                                        <div class="modal fade" id="editfase" tabindex="-1" aria-labelledby="editfaseLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                <form class="modal-content" method="post" action="../actions/edit_fase_prod.php">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="editfasepagoLabel">Editar a fase de produção <input type="text" class="d-none border-0 bg-transparent text-white" id="idservico" name="idservico" value="<?php echo $idservico; ?>"></h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <label for="fase_prod">
                                                                                            <h6>O serviço está em que fase da produção?</h6>
                                                                                        </label>
                                                                                        <div class="input-group mb-3">
                                                                                            <select class="form-select" name="fase_prod" id="fase_prod">
                                                                                                <option disabled selected><?= $row2['fase_prod'] ?></option>
                                                                                                <option>Separação e Identificação</option>
                                                                                                <option>Descoloração</option>
                                                                                                <option>Mesclagem</option>
                                                                                                <option>Lavagem|Hidratação|Selagem</option>
                                                                                                <option>Finalização</option>
                                                                                                <option>Concluído</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-success">Salvar</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 border-0">
                                                                            <div class="list-group-item bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#qtde_prod" aria-controls="qtde_prod" aria-expanded="false" aria-label="Toggle navigation">
                                                                                <h6 class="mb-0 text-uppercase text-white">QTDE de
                                                                                    Produtos
                                                                                    a Utilizar&nbsp;<i class="fa-solid fa-chevron-down"></i>
                                                                                </h6>
                                                                            </div>
                                                                            <div class="list-group-item collapse" id="qtde_prod">
                                                                                <?php
                                                                                $query3 = "SELECT p.name_prod, ps.qtde_uso, p.und_medida FROM produto_serv ps INNER JOIN produtos p ON ps.codprod = p.cod_prod INNER JOIN servicos s ON s.id_serv = ps.idserv WHERE s.idpedido = $idpedido AND s.id_serv = $idservico";
                                                                                $result3 = mysqli_query($conexao, $query3) or die('ERROR');

                                                                                $total3 = mysqli_num_rows($result3);

                                                                                if ($total3 > 0) {
                                                                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                                                                        echo "<h6 class='mb-0'>" . $row3['name_prod'] . ": <strong class='text-uppercase'>" . $row3['qtde_uso'] . " " . $row3['und_medida'] . "</strong></h6>";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        $query4 = "SELECT * FROM servicos WHERE idpedido = $idpedido ORDER BY id_serv DESC";
                                                        $result4 = mysqli_query($conexao, $query4) or die('Erro demais!');
                                                        $total4 = mysqli_num_rows($result4);
                                                        $row4 = mysqli_fetch_assoc($result4);
                                                        if ($total4 >= 2 && ($row4['fase_prod'] != 'Concluído' || $row4['valor_rest'] != ',0') && $row4['idpedido'] == $idpedido) {
                                                            do {
                                                                $idserv = $row4['id_serv'];
                                                                if ($idserv != $idservico) {
                                                        ?>
                                                                    <div class="carousel-item">
                                                                        <div class="d-flex justify-content-center">
                                                                            <div class="col-md-9 col-lg-9 card m-2">
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title">ID do Serviço: <strong class="text-uppercase"><?= $row4['id_serv']; ?></strong></h5>
                                                                                    <h5 class="card-title">Modelo do Cabelo: <strong class="text-uppercase"><?= $row4['modelo_cabelo']; ?></strong></h5>
                                                                                </div>
                                                                                <ul class="list-group list-group-flush">
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0">Quantidade de cabelo (kg): <strong class="text-uppercase"><?= $row4['qtde_cabelo'] ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0">Tamanho do cabelo (cm): <strong class="text-uppercase"><?= $row4['tam_cabelo'] ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0">Procedência do cabelo: <strong class="text-uppercase"><?= $row4['proced_cabelo'] ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0">Tipo do cabelo: <strong class="text-uppercase"><?= $row4['tipo_cabelo'] ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0">Cor do Elástico: <strong class="text-uppercase"><?= $row4['cor_elastico'] ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0">Cor da Liga: <strong class="text-uppercase"><?= $row4['cor_liga'] ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light d-flex align-items-center">
                                                                                        <h6 class="mb-0 text-primary">Fase da Produção: <strong class="text-uppercase"><?= $row4['fase_prod'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;</strong></h6>
                                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editfase<?= $idserv ?>" class="border-0 bg-transparent d-flex align-items-center justify-content-center text-muted">
                                                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                                                            <h6 class="mb-0">&nbsp;Editar</h6>
                                                                                        </button>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0 text-success">Valor do Serviço: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                            echo 'xxx';
                                                                                                                                                                        } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                            echo $row4['valor_total'];
                                                                                                                                                                        } ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light d-flex align-items-center">
                                                                                        <h6 class="mb-0 text-black">Valor pago: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                    echo 'xxx';
                                                                                                                                                                } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                    echo $row4['valor_pago'];
                                                                                                                                                                } ?>&nbsp;&nbsp;|&nbsp;&nbsp;</strong>
                                                                                        </h6>
                                                                                        <?php if ($id_user == 1 || $id_user == 2) {
                                                                                            echo
                                                                                            '<button type="button" data-bs-toggle="modal" data-bs-target="#editvalpago' . $idserv . '" class="border-0 bg-transparent d-flex align-items-center justify-content-center text-secondary">
                                                                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                                                                            <h6 class="mb-0">&nbsp;Editar</h6>
                                                                                                            </button>';
                                                                                        } else {
                                                                                            echo "xxx";
                                                                                        }
                                                                                        ?>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light border-0">
                                                                                        <h6 class="mb-0 text-danger">Valor a pagar: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                        echo 'xxx';
                                                                                                                                                                    } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                        echo $row4['valor_rest'];
                                                                                                                                                                    } ?></strong></h6>
                                                                                    </li>
                                                                                </ul>
                                                                                <!-- Editar o Valor Pago -->
                                                                                <div class="modal fade" id="editvalpago<?php echo $idserv; ?>" tabindex="-1" aria-labelledby="editvalpago<?php echo $idserv; ?>Label" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                                        <form class="modal-content" method="post" action="../actions/edit_val_pago">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title" id="editvalpago<?php echo $idserv; ?>Label">Editar o Valor
                                                                                                    Pago <input type="text" class="d-none border-0 bg-transparent text-white" id="idservico" name="idservico" value="<?php echo $idserv; ?>"></h5>
                                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <label for="valpago">
                                                                                                    <h6>Valor pago pelo cliente:</h6>
                                                                                                </label>
                                                                                                <div class="input-group mb-3">
                                                                                                    <span class="input-group-text rounded-start">R$</span>
                                                                                                    <input type="text" class="form-control" name="val_pago" aria-label="Valor em reais" value="" size="12" onKeyUp="mascaraMoeda(this, event)" placeholder="Digite o valor pago pelo cliente">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Editar a Fase de Produção -->
                                                                                <div class="modal fade" id="editfase<?php echo $idserv; ?>" tabindex="-1" aria-labelledby="editfase<?php echo $idserv; ?>Label" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                                        <form class="modal-content" method="post" action="../actions/edit_fase_prod.php">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title" id="editfasepagoLabel">Editar a fase de produção <input type="text" class="d-none border-0 bg-transparent text-white" id="idservico" name="idservico" value="<?php echo $idserv; ?>"></h5>
                                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <label for="fase_prod">
                                                                                                    <h6>O serviço está em que fase da produção?</h6>
                                                                                                </label>
                                                                                                <div class="input-group mb-3">
                                                                                                    <select class="form-select" name="fase_prod" id="fase_prod">
                                                                                                        <option disabled selected><?= $row4['fase_prod'] ?></option>
                                                                                                        <option>Separação e Identificação</option>
                                                                                                        <option>Descoloração</option>
                                                                                                        <option>Mesclagem</option>
                                                                                                        <option>Lavagem|Hidratação|Selagem</option>
                                                                                                        <option>Finalização</option>
                                                                                                        <option>Concluído</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 border-0">
                                                                                    <div class="list-group-item bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#qtde_prod" aria-controls="qtde_prod" aria-expanded="false" aria-label="Toggle navigation">
                                                                                        <h6 class="mb-0 text-uppercase text-white">QTDE de
                                                                                            Produtos
                                                                                            a Utilizar&nbsp;<i class="fa-solid fa-chevron-down"></i>
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="list-group-item collapse" id="qtde_prod">
                                                                                        <?php
                                                                                        $query5 = "SELECT p.name_prod, ps.qtde_uso, p.und_medida FROM produto_serv ps INNER JOIN produtos p ON ps.codprod = p.cod_prod INNER JOIN servicos s ON s.id_serv = ps.idserv WHERE s.idpedido = $idpedido AND s.id_serv = $idservico";
                                                                                        $result5 = mysqli_query($conexao, $query5) or die('ERROR');

                                                                                        $total5 = mysqli_num_rows($result5);

                                                                                        if ($total5 > 0) {
                                                                                            while ($row5 = mysqli_fetch_assoc($result5)) {
                                                                                                echo "<h6 class='mb-0'>" . $row5['name_prod'] . ": <strong class='text-uppercase'>" . $row5['qtde_uso'] . " " . $row5['und_medida'] . "</strong></h6>";
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                        <?php
                                                                }
                                                            } while ($row4 = mysqli_fetch_assoc($result4));
                                                        }
                                                        ?>
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#services<?= $row['id_pedido'] ?>" data-bs-slide="prev">
                                                            <span class="text-secondary" aria-hidden="true"><i class="fa-solid fa-angles-left fa-2x"></i></span>
                                                            <span class="visually-hidden text-secondary">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#services<?= $row['id_pedido'] ?>" data-bs-slide="next">
                                                            <span class="text-secondary" aria-hidden="true"><i class="fa-solid fa-angles-right fa-2x"></i></span>
                                                            <span class="visually-hidden text-secondary">Next</span>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                            <?php
                                    } while ($row = mysqli_fetch_assoc($result) && $row['idpedido'] != $idpedido);
                                } else {
                                    echo "-";
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                            <!-- demais serviços -->
                            <?php
                            if (isset($_POST['select_cliente'])) {
                                include_once('../actions/config.php');
                                $idcliente = strstr($_POST['select_cliente'], " ", true);
                                $query = "SELECT * FROM pedidos p INNER JOIN servicos s ON s.idpedido = p.id_pedido WHERE idcliente = $idcliente";
                                $result = mysqli_query($conexao, $query) or die('ERROR');
                                $total = mysqli_num_rows($result);
                                $row = mysqli_fetch_assoc($result);

                                if ($total > 0 && ($row['fase_prod'] != 'Concluído' || $row['valor_rest'] != ',0')) {
                                    do {
                                        if ($row['idpedido'] != $idpedido) {
                                            $idpedido = $row['id_pedido'];
                            ?>
                                            <div class="d-flex aligm-items-center">
                                                <button type=" button" class="m-2 btn btn-warning text-dark font-weight-bold" data-bs-toggle="collapse" data-bs-target="#servPed<?= $row['id_pedido'] ?>" aria-expanded="false" aria-controls="collapseExample">Pedido Nº <?= $row['id_pedido'] ?></button>
                                            </div>

                                            <!-- SERVIÇOS POR PEDIDO -->
                                            <div class="card collapse m-2" id="servPed<?= $row['id_pedido'] ?>">
                                                <div class="card-header">
                                                    <h5>Serviços do Pedido nº <strong><?= $row['id_pedido'] ?> | Data de Entrega do Pedido: </strong><strong class="text-danger, text-uppercase"><?php $data = $row['data_termino'];
                                                                                                                                                                                                    echo date('d/m/Y', strtotime($data)); ?></strong></h6>
                                                        </strong></h5>
                                                </div>
                                                <div class="card-body">

                                                    <div id="services<?= $row['id_pedido'] ?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="0">
                                                        <div class="carousel-inner">
                                                            <?php
                                                            $query2 = "SELECT * FROM servicos WHERE idpedido = $idpedido ORDER BY id_serv DESC LIMIT 1";
                                                            $result2 = mysqli_query($conexao, $query2) or die('Erro demais!');
                                                            $total2 = mysqli_num_rows($result2);
                                                            $row2 = mysqli_fetch_assoc($result2);
                                                            if ($total2 == 1 && ($row2['fase_prod'] != 'Concluído' || $row2['valor_rest'] != ',0') && $row2['idpedido'] == $idpedido) {
                                                                $idservico = $row2['id_serv'];
                                                            ?>
                                                                <div class="carousel-item active">
                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="col-md-9 col-lg-9 card m-2">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">ID do Serviço: <strong class="text-uppercase"><?= $row2['id_serv']; ?></strong></h5>
                                                                                <h5 class="card-title">Modelo do Cabelo: <strong class="text-uppercase"><?= $row2['modelo_cabelo']; ?></strong></h5>
                                                                            </div>
                                                                            <ul class="list-group list-group-flush">
                                                                                <li class="list-group-item bg-light">
                                                                                    <h6 class="mb-0">Quantidade de cabelo (kg): <strong class="text-uppercase"><?= $row2['qtde_cabelo'] ?></strong></h6>
                                                                                </li>
                                                                                <li class="list-group-item bg-light">
                                                                                    <h6 class="mb-0">Tamanho do cabelo (cm): <strong class="text-uppercase"><?= $row2['tam_cabelo'] ?></strong></h6>
                                                                                </li>
                                                                                <li class="list-group-item bg-light">
                                                                                    <h6 class="mb-0">Procedência do cabelo: <strong class="text-uppercase"><?= $row2['proced_cabelo'] ?></strong></h6>
                                                                                </li>
                                                                                <li class="list-group-item bg-light">
                                                                                    <h6 class="mb-0">Tipo do cabelo: <strong class="text-uppercase"><?= $row2['tipo_cabelo'] ?></strong></h6>
                                                                                </li>
                                                                                <li class="list-group-item bg-light">
                                                                                    <h6 class="mb-0">Cor do Elástico: <strong class="text-uppercase"><?= $row2['cor_elastico'] ?></strong></h6>
                                                                                </li>
                                                                                <li class="list-group-item bg-light">
                                                                                    <h6 class="mb-0">Cor da Liga: <strong class="text-uppercase"><?= $row2['cor_liga'] ?></strong></h6>
                                                                                </li>
                                                                                <li class="list-group-item bg-light d-flex align-items-center">
                                                                                    <h6 class="mb-0 text-primary">Fase da Produção: <strong class="text-uppercase"><?= $row2['fase_prod'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;</strong></h6>
                                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#editfase" class="border-0 bg-transparent d-flex align-items-center justify-content-center text-muted">
                                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                                        <h6 class="mb-0">&nbsp;Editar</h6>
                                                                                    </button>
                                                                                </li>
                                                                                <li class="list-group-item bg-light">
                                                                                    <h6 class="mb-0 text-success">Valor do Serviço: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                        echo 'xxx';
                                                                                                                                                                    } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                        echo $row2['valor_total'];
                                                                                                                                                                    } ?></strong></h6>
                                                                                </li>
                                                                                <li class="list-group-item bg-light d-flex align-items-center">
                                                                                    <h6 class="mb-0 text-black">Valor pago: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                echo 'xxx';
                                                                                                                                                            } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                echo $row2['valor_pago'];
                                                                                                                                                            } ?>&nbsp;&nbsp;|&nbsp;&nbsp;</strong>
                                                                                    </h6>
                                                                                    <?php if ($id_user == 1 || $id_user == 2) {
                                                                                        echo
                                                                                        '<button type="button" data-bs-toggle="modal" data-bs-target="#editvalpago" class="border-0 bg-transparent d-flex align-items-center justify-content-center text-secondary">
                                                                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                                                                            <h6 class="mb-0">&nbsp;Editar</h6>
                                                                                                            </button>';
                                                                                    } else {
                                                                                        echo "xxx";
                                                                                    }
                                                                                    ?>
                                                                                </li>
                                                                                <li class="list-group-item bg-light border-0">
                                                                                    <h6 class="mb-0 text-danger">Valor a pagar: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                    echo 'xxx';
                                                                                                                                                                } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                    echo $row2['valor_rest'];
                                                                                                                                                                } ?></strong></h6>
                                                                                </li>
                                                                            </ul>
                                                                            <!-- Editar o Valor Pago -->
                                                                            <div class="modal fade" id="editvalpago" tabindex="-1" aria-labelledby="editvalpagoLabel" aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered">
                                                                                    <form class="modal-content" method="post" action="../actions/edit_val_pago">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="editvalpagoLabel">Editar o Valor
                                                                                                Pago <input type="text" class="d-none border-0 bg-transparent text-white" id="idservico" name="idservico" value="<?php echo $idservico; ?>"></h5>
                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <label for="valpago">
                                                                                                <h6>Valor pago pelo cliente:</h6>
                                                                                            </label>
                                                                                            <div class="input-group mb-3">
                                                                                                <span class="input-group-text rounded-start">R$</span>
                                                                                                <input type="text" class="form-control" name="val_pago" aria-label="Valor em reais" value="" size="12" onKeyUp="mascaraMoeda(this, event)" placeholder="Digite o valor pago pelo cliente">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" class="btn btn-success">Salvar</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Editar a Fase de Produção -->
                                                                            <div class="modal fade" id="editfase" tabindex="-1" aria-labelledby="editfaseLabel" aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered">
                                                                                    <form class="modal-content" method="post" action="../actions/edit_fase_prod.php">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="editfasepagoLabel">Editar a fase de produção <input type="text" class="d-none border-0 bg-transparent text-white" id="idservico" name="idservico" value="<?php echo $idservico; ?>"></h5>
                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <label for="fase_prod">
                                                                                                <h6>O serviço está em que fase da produção?</h6>
                                                                                            </label>
                                                                                            <div class="input-group mb-3">
                                                                                                <select class="form-select" name="fase_prod" id="fase_prod">
                                                                                                    <option disabled selected><?= $row2['fase_prod'] ?></option>
                                                                                                    <option>Separação e Identificação</option>
                                                                                                    <option>Descoloração</option>
                                                                                                    <option>Mesclagem</option>
                                                                                                    <option>Lavagem|Hidratação|Selagem</option>
                                                                                                    <option>Finalização</option>
                                                                                                    <option>Concluído</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" class="btn btn-success">Salvar</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 border-0">
                                                                                <div class="list-group-item bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#qtde_prod" aria-controls="qtde_prod" aria-expanded="false" aria-label="Toggle navigation">
                                                                                    <h6 class="mb-0 text-uppercase text-white">QTDE de
                                                                                        Produtos
                                                                                        a Utilizar&nbsp;<i class="fa-solid fa-chevron-down"></i>
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="list-group-item collapse" id="qtde_prod">
                                                                                    <?php
                                                                                    $query3 = "SELECT p.name_prod, ps.qtde_uso, p.und_medida FROM produto_serv ps INNER JOIN produtos p ON ps.codprod = p.cod_prod INNER JOIN servicos s ON s.id_serv = ps.idserv WHERE s.idpedido = $idpedido AND s.id_serv = $idservico";
                                                                                    $result3 = mysqli_query($conexao, $query3) or die('ERROR');

                                                                                    $total3 = mysqli_num_rows($result3);

                                                                                    if ($total3 > 0) {
                                                                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                                                                            echo "<h6 class='mb-0'>" . $row3['name_prod'] . ": <strong class='text-uppercase'>" . $row3['qtde_uso'] . " " . $row3['und_medida'] . "</strong></h6>";
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            $query4 = "SELECT * FROM servicos WHERE idpedido = $idpedido ORDER BY id_serv DESC";
                                                            $result4 = mysqli_query($conexao, $query4) or die('Erro demais!');
                                                            $total4 = mysqli_num_rows($result4);
                                                            $row4 = mysqli_fetch_assoc($result4);
                                                            if ($total4 >= 2 && ($row4['fase_prod'] != 'Concluído' || $row4['valor_rest'] != ',0') && $row4['idpedido'] == $idpedido) {
                                                                do {
                                                                    $idserv = $row4['id_serv'];
                                                                    if ($idserv != $idservico) {
                                                            ?>
                                                                        <div class="carousel-item">
                                                                            <div class="d-flex justify-content-center">
                                                                                <div class="col-md-9 col-lg-9 card m-2">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title">ID do Serviço: <strong class="text-uppercase"><?= $row4['id_serv']; ?></strong></h5>
                                                                                        <h5 class="card-title">Modelo do Cabelo: <strong class="text-uppercase"><?= $row4['modelo_cabelo']; ?></strong></h5>
                                                                                    </div>
                                                                                    <ul class="list-group list-group-flush">
                                                                                        <li class="list-group-item bg-light">
                                                                                            <h6 class="mb-0">Quantidade de cabelo (kg): <strong class="text-uppercase"><?= $row4['qtde_cabelo'] ?></strong></h6>
                                                                                        </li>
                                                                                        <li class="list-group-item bg-light">
                                                                                            <h6 class="mb-0">Tamanho do cabelo (cm): <strong class="text-uppercase"><?= $row4['tam_cabelo'] ?></strong></h6>
                                                                                        </li>
                                                                                        <li class="list-group-item bg-light">
                                                                                            <h6 class="mb-0">Procedência do cabelo: <strong class="text-uppercase"><?= $row4['proced_cabelo'] ?></strong></h6>
                                                                                        </li>
                                                                                        <li class="list-group-item bg-light">
                                                                                            <h6 class="mb-0">Tipo do cabelo: <strong class="text-uppercase"><?= $row4['tipo_cabelo'] ?></strong></h6>
                                                                                        </li>
                                                                                        <li class="list-group-item bg-light">
                                                                                            <h6 class="mb-0">Cor do Elástico: <strong class="text-uppercase"><?= $row4['cor_elastico'] ?></strong></h6>
                                                                                        </li>
                                                                                        <li class="list-group-item bg-light">
                                                                                            <h6 class="mb-0">Cor da Liga: <strong class="text-uppercase"><?= $row4['cor_liga'] ?></strong></h6>
                                                                                        </li>
                                                                                        <li class="list-group-item bg-light d-flex align-items-center">
                                                                                            <h6 class="mb-0 text-primary">Fase da Produção: <strong class="text-uppercase"><?= $row4['fase_prod'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;</strong></h6>
                                                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#editfase<?= $idserv ?>" class="border-0 bg-transparent d-flex align-items-center justify-content-center text-muted">
                                                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                                                                <h6 class="mb-0">&nbsp;Editar</h6>
                                                                                            </button>
                                                                                        </li>
                                                                                        <li class="list-group-item bg-light">
                                                                                            <h6 class="mb-0 text-success">Valor do Serviço: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                                echo 'xxx';
                                                                                                                                                                            } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                                echo $row4['valor_total'];
                                                                                                                                                                            } ?></strong></h6>
                                                                                        </li>
                                                                                        <li class="list-group-item bg-light d-flex align-items-center">
                                                                                            <h6 class="mb-0 text-black">Valor pago: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                        echo 'xxx';
                                                                                                                                                                    } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                        echo $row4['valor_pago'];
                                                                                                                                                                    } ?>&nbsp;&nbsp;|&nbsp;&nbsp;</strong>
                                                                                            </h6>
                                                                                            <?php if ($id_user == 1 || $id_user == 2) {
                                                                                                echo
                                                                                                '<button type="button" data-bs-toggle="modal" data-bs-target="#editvalpago' . $idserv . '" class="border-0 bg-transparent d-flex align-items-center justify-content-center text-secondary">
                                                                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                                                                            <h6 class="mb-0">&nbsp;Editar</h6>
                                                                                                            </button>';
                                                                                            } else {
                                                                                                echo "xxx";
                                                                                            }
                                                                                            ?>
                                                                                        </li>
                                                                                        <li class="list-group-item bg-light border-0">
                                                                                            <h6 class="mb-0 text-danger">Valor a pagar: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                            echo 'xxx';
                                                                                                                                                                        } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                            echo $row4['valor_rest'];
                                                                                                                                                                        } ?></strong></h6>
                                                                                        </li>
                                                                                    </ul>
                                                                                    <!-- Editar o Valor Pago -->
                                                                                    <div class="modal fade" id="editvalpago<?php echo $idserv; ?>" tabindex="-1" aria-labelledby="editvalpago<?php echo $idserv; ?>Label" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-dialog-centered">
                                                                                            <form class="modal-content" method="post" action="../actions/edit_val_pago">
                                                                                                <div class="modal-header">
                                                                                                    <h5 class="modal-title" id="editvalpago<?php echo $idserv; ?>Label">Editar o Valor
                                                                                                        Pago <input type="text" class="d-none border-0 bg-transparent text-white" id="idservico" name="idservico" value="<?php echo $idserv; ?>"></h5>
                                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    <label for="valpago">
                                                                                                        <h6>Valor pago pelo cliente:</h6>
                                                                                                    </label>
                                                                                                    <div class="input-group mb-3">
                                                                                                        <span class="input-group-text rounded-start">R$</span>
                                                                                                        <input type="text" class="form-control" name="val_pago" aria-label="Valor em reais" value="" size="12" onKeyUp="mascaraMoeda(this, event)" placeholder="Digite o valor pago pelo cliente">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="submit" class="btn btn-success">Salvar</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- Editar a Fase de Produção -->
                                                                                    <div class="modal fade" id="editfase<?php echo $idserv; ?>" tabindex="-1" aria-labelledby="editfase<?php echo $idserv; ?>Label" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-dialog-centered">
                                                                                            <form class="modal-content" method="post" action="../actions/edit_fase_prod.php">
                                                                                                <div class="modal-header">
                                                                                                    <h5 class="modal-title" id="editfasepagoLabel">Editar a fase de produção <input type="text" class="d-none border-0 bg-transparent text-white" id="idservico" name="idservico" value="<?php echo $idserv; ?>"></h5>
                                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    <label for="fase_prod">
                                                                                                        <h6>O serviço está em que fase da produção?</h6>
                                                                                                    </label>
                                                                                                    <div class="input-group mb-3">
                                                                                                        <select class="form-select" name="fase_prod" id="fase_prod">
                                                                                                            <option disabled selected><?= $row4['fase_prod'] ?></option>
                                                                                                            <option>Separação e Identificação</option>
                                                                                                            <option>Descoloração</option>
                                                                                                            <option>Mesclagem</option>
                                                                                                            <option>Lavagem|Hidratação|Selagem</option>
                                                                                                            <option>Finalização</option>
                                                                                                            <option>Concluído</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="submit" class="btn btn-success">Salvar</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 border-0">
                                                                                        <div class="list-group-item bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#qtde_prod" aria-controls="qtde_prod" aria-expanded="false" aria-label="Toggle navigation">
                                                                                            <h6 class="mb-0 text-uppercase text-white">QTDE de
                                                                                                Produtos
                                                                                                a Utilizar&nbsp;<i class="fa-solid fa-chevron-down"></i>
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="list-group-item collapse" id="qtde_prod">
                                                                                            <?php
                                                                                            $query5 = "SELECT p.name_prod, ps.qtde_uso, p.und_medida FROM produto_serv ps INNER JOIN produtos p ON ps.codprod = p.cod_prod INNER JOIN servicos s ON s.id_serv = ps.idserv WHERE s.idpedido = $idpedido AND s.id_serv = $idservico";
                                                                                            $result5 = mysqli_query($conexao, $query5) or die('ERROR');

                                                                                            $total5 = mysqli_num_rows($result5);

                                                                                            if ($total5 > 0) {
                                                                                                while ($row5 = mysqli_fetch_assoc($result5)) {
                                                                                                    echo "<h6 class='mb-0'>" . $row5['name_prod'] . ": <strong class='text-uppercase'>" . $row5['qtde_uso'] . " " . $row5['und_medida'] . "</strong></h6>";
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                            <?php
                                                                    }
                                                                } while ($row4 = mysqli_fetch_assoc($result4));
                                                            }
                                                            ?>
                                                            <button class="carousel-control-prev" type="button" data-bs-target="#services<?= $row['id_pedido'] ?>" data-bs-slide="prev">
                                                                <span class="text-secondary" aria-hidden="true"><i class="fa-solid fa-angles-left fa-2x"></i></span>
                                                                <span class="visually-hidden text-secondary">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button" data-bs-target="#services<?= $row['id_pedido'] ?>" data-bs-slide="next">
                                                                <span class="text-secondary" aria-hidden="true"><i class="fa-solid fa-angles-right fa-2x"></i></span>
                                                                <span class="visually-hidden text-secondary">Next</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                            <?php
                                        }
                                    } while ($row = mysqli_fetch_assoc($result));
                                } else {
                                    echo "-";
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- serviços concluídos -->
                <div class="d-flex flex-wrap justify-content-between col-12">
                    <!-- SERVIÇOS POR CLIENTE -->
                    <div class="services w-100 m-2">
                        <!-- serviços concluidos -->
                        <div class="border-bottom border-2 my-4 mx-2 border-success">
                            <h4 class="py-1">Serviços Concluídos</h4>
                        </div>
                        <div class="content-serv">
                            <?php
                            if (isset($_POST['select_cliente'])) {
                                include_once('../actions/config.php');
                                $idcliente = strstr($_POST['select_cliente'], " ", true);
                                $query = "SELECT * FROM pedidos p INNER JOIN servicos s  ON s.idpedido = p.id_pedido WHERE idcliente = $idcliente";
                                $result = mysqli_query($conexao, $query) or die('ERROR');
                                $total = mysqli_num_rows($result);
                                $row = mysqli_fetch_assoc($result);

                                if ($total > 0 && $row['fase_prod'] == 'Concluído' && $row['valor_rest'] == ',0') {
                                    do {
                                        $idpedido = $row['id_pedido'];
                            ?>
                                        <div class="d-flex aligm-items-center">
                                            <button type=" button" class="m-2 btn btn-warning text-dark font-weight-bold" data-bs-toggle="collapse" data-bs-target="#servPed<?= $row['id_pedido'] ?>" aria-expanded="false" aria-controls="collapseExample">Pedido Nº <?= $row['id_pedido'] ?></button>
                                        </div>

                                        <!-- SERVIÇOS POR PEDIDO -->
                                        <div class="card collapse m-2" id="servPed<?= $row['id_pedido'] ?>">
                                            <div class="card-header">
                                                <h5>Serviços do Pedido nº <strong><?= $row['id_pedido'] ?> </strong></h5>
                                            </div>
                                            <div class="card-body">

                                                <div id="services<?= $row['id_pedido'] ?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="0">
                                                    <div class="carousel-inner">
                                                        <?php
                                                        $query2 = "SELECT * FROM servicos WHERE idpedido = $idpedido ORDER BY id_serv DESC LIMIT 1";
                                                        $result2 = mysqli_query($conexao, $query2) or die('Erro demais!');
                                                        $total2 = mysqli_num_rows($result2);
                                                        $row2 = mysqli_fetch_assoc($result2);
                                                        if ($total2 == 1 && ($row2['fase_prod'] == 'Concluído' && $row2['valor_rest'] == ',0') && $row2['idpedido'] == $idpedido) {
                                                            $idservico = $row2['id_serv'];
                                                        ?>
                                                            <div class="carousel-item active">
                                                                <div class="d-flex justify-content-center">
                                                                    <div class="col-md-9 col-lg-9 card m-2">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">ID do Serviço: <strong class="text-uppercase"><?= $row2['id_serv']; ?></strong></h5>
                                                                            <h5 class="card-title">Modelo do Cabelo: <strong class="text-uppercase"><?= $row2['modelo_cabelo']; ?></strong></h5>
                                                                        </div>
                                                                        <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0">Quantidade de cabelo (kg): <strong class="text-uppercase"><?= $row2['qtde_cabelo'] ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0">Tamanho do cabelo (cm): <strong class="text-uppercase"><?= $row2['tam_cabelo'] ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0">Procedência do cabelo: <strong class="text-uppercase"><?= $row2['proced_cabelo'] ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0">Tipo do cabelo: <strong class="text-uppercase"><?= $row2['tipo_cabelo'] ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0">Cor do Elástico: <strong class="text-uppercase"><?= $row2['cor_elastico'] ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0">Cor da Liga: <strong class="text-uppercase"><?= $row2['cor_liga'] ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light d-flex align-items-center">
                                                                                <h6 class="mb-0 text-primary">Fase da Produção: <strong class="text-uppercase"><?= $row2['fase_prod'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;</strong></h6>
                                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#editfase" class="border-0 bg-transparent d-flex align-items-center justify-content-center text-muted">
                                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                                    <h6 class="mb-0">&nbsp;Editar</h6>
                                                                                </button>
                                                                            </li>
                                                                            <li class="list-group-item bg-light">
                                                                                <h6 class="mb-0 text-success">Valor do Serviço: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                    echo 'xxx';
                                                                                                                                                                } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                    echo $row2['valor_total'];
                                                                                                                                                                } ?></strong></h6>
                                                                            </li>
                                                                            <li class="list-group-item bg-light d-flex align-items-center">
                                                                                <h6 class="mb-0 text-black">Valor pago: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                            echo 'xxx';
                                                                                                                                                        } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                            echo $row2['valor_pago'];
                                                                                                                                                        } ?>&nbsp;&nbsp;|&nbsp;&nbsp;</strong>
                                                                                </h6>
                                                                                <?php if ($id_user == 1 || $id_user == 2) {
                                                                                    echo
                                                                                    '<button type="button" data-bs-toggle="modal" data-bs-target="#editvalpago" class="border-0 bg-transparent d-flex align-items-center justify-content-center text-secondary">
                                                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                                                        <h6 class="mb-0">&nbsp;Editar</h6>
                                                                                                        </button>';
                                                                                } else {
                                                                                    echo "xxx";
                                                                                }
                                                                                ?>
                                                                            </li>
                                                                            <li class="list-group-item bg-light border-0">
                                                                                <h6 class="mb-0 text-danger">Valor a pagar: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                echo 'xxx';
                                                                                                                                                            } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                echo $row2['valor_rest'];
                                                                                                                                                            } ?></strong></h6>
                                                                            </li>
                                                                        </ul>
                                                                        <!-- Editar o Valor Pago -->
                                                                        <div class="modal fade" id="editvalpago" tabindex="-1" aria-labelledby="editvalpagoLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                <form class="modal-content" method="post" action="../actions/edit_val_pago">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="editvalpagoLabel">Editar o Valor
                                                                                            Pago <input type="text" class="d-none border-0 bg-transparent text-white" id="idservico" name="idservico" value="<?php echo $idservico; ?>"></h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <label for="valpago">
                                                                                            <h6>Valor pago pelo cliente:</h6>
                                                                                        </label>
                                                                                        <div class="input-group mb-3">
                                                                                            <span class="input-group-text rounded-start">R$</span>
                                                                                            <input type="text" class="form-control" name="val_pago" aria-label="Valor em reais" value="" size="12" onKeyUp="mascaraMoeda(this, event)" placeholder="Digite o valor pago pelo cliente">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-success">Salvar</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Editar a Fase de Produção -->
                                                                        <div class="modal fade" id="editfase" tabindex="-1" aria-labelledby="editfaseLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                <form class="modal-content" method="post" action="../actions/edit_fase_prod.php">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="editfasepagoLabel">Editar a fase de produção <input type="text" class="d-none border-0 bg-transparent text-white" id="idservico" name="idservico" value="<?php echo $idservico; ?>"></h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <label for="fase_prod">
                                                                                            <h6>O serviço está em que fase da produção?</h6>
                                                                                        </label>
                                                                                        <div class="input-group mb-3">
                                                                                            <select class="form-select" name="fase_prod" id="fase_prod">
                                                                                                <option disabled selected><?= $row2['fase_prod'] ?></option>
                                                                                                <option>Separação e Identificação</option>
                                                                                                <option>Descoloração</option>
                                                                                                <option>Mesclagem</option>
                                                                                                <option>Lavagem|Hidratação|Selagem</option>
                                                                                                <option>Finalização</option>
                                                                                                <option>Concluído</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-success">Salvar</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 border-0">
                                                                            <div class="list-group-item bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#qtde_prod" aria-controls="qtde_prod" aria-expanded="false" aria-label="Toggle navigation">
                                                                                <h6 class="mb-0 text-uppercase text-white">QTDE de
                                                                                    Produtos
                                                                                    a Utilizar&nbsp;<i class="fa-solid fa-chevron-down"></i>
                                                                                </h6>
                                                                            </div>
                                                                            <div class="list-group-item collapse" id="qtde_prod">
                                                                                <?php
                                                                                $query3 = "SELECT p.name_prod, ps.qtde_uso, p.und_medida FROM produto_serv ps INNER JOIN produtos p ON ps.codprod = p.cod_prod INNER JOIN servicos s ON s.id_serv = ps.idserv WHERE s.idpedido = $idpedido AND s.id_serv = $idservico";
                                                                                $result3 = mysqli_query($conexao, $query3) or die('ERROR');

                                                                                $total3 = mysqli_num_rows($result3);

                                                                                if ($total3 > 0) {
                                                                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                                                                        echo "<h6 class='mb-0'>" . $row3['name_prod'] . ": <strong class='text-uppercase'>" . $row3['qtde_uso'] . " " . $row3['und_medida'] . "</strong></h6>";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        $query4 = "SELECT * FROM servicos WHERE idpedido = $idpedido ORDER BY id_serv DESC";
                                                        $result4 = mysqli_query($conexao, $query4) or die('Erro demais!');
                                                        $total4 = mysqli_num_rows($result4);
                                                        $row4 = mysqli_fetch_assoc($result4);
                                                        if ($total4 >= 2 && ($row4['fase_prod'] == 'Concluído' && $row4['valor_rest'] == ',0') && $row4['idpedido'] == $idpedido) {
                                                            do {
                                                                $idserv = $row4['id_serv'];
                                                                if ($idserv != $idservico) {
                                                        ?>
                                                                    <div class="carousel-item">
                                                                        <div class="d-flex justify-content-center">
                                                                            <div class="col-md-9 col-lg-9 card m-2">
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title">ID do Serviço: <strong class="text-uppercase"><?= $row4['id_serv']; ?></strong></h5>
                                                                                    <h5 class="card-title">Modelo do Cabelo: <strong class="text-uppercase"><?= $row4['modelo_cabelo']; ?></strong></h5>
                                                                                </div>
                                                                                <ul class="list-group list-group-flush">
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0">Quantidade de cabelo (kg): <strong class="text-uppercase"><?= $row4['qtde_cabelo'] ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0">Tamanho do cabelo (cm): <strong class="text-uppercase"><?= $row4['tam_cabelo'] ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0">Procedência do cabelo: <strong class="text-uppercase"><?= $row4['proced_cabelo'] ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0">Tipo do cabelo: <strong class="text-uppercase"><?= $row4['tipo_cabelo'] ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0">Cor do Elástico: <strong class="text-uppercase"><?= $row4['cor_elastico'] ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0">Cor da Liga: <strong class="text-uppercase"><?= $row4['cor_liga'] ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light d-flex align-items-center">
                                                                                        <h6 class="mb-0 text-primary">Fase da Produção: <strong class="text-uppercase"><?= $row4['fase_prod'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;</strong></h6>
                                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editfase<?= $idserv ?>" class="border-0 bg-transparent d-flex align-items-center justify-content-center text-muted">
                                                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                                                            <h6 class="mb-0">&nbsp;Editar</h6>
                                                                                        </button>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light">
                                                                                        <h6 class="mb-0 text-success">Valor do Serviço: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                            echo 'xxx';
                                                                                                                                                                        } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                            echo $row4['valor_total'];
                                                                                                                                                                        } ?></strong></h6>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light d-flex align-items-center">
                                                                                        <h6 class="mb-0 text-black">Valor pago: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                    echo 'xxx';
                                                                                                                                                                } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                    echo $row4['valor_pago'];
                                                                                                                                                                } ?>&nbsp;&nbsp;|&nbsp;&nbsp;</strong>
                                                                                        </h6>
                                                                                        <?php if ($id_user == 1 || $id_user == 2) {
                                                                                            echo
                                                                                            '<button type="button" data-bs-toggle="modal" data-bs-target="#editvalpago' . $idserv . '" class="border-0 bg-transparent d-flex align-items-center justify-content-center text-secondary">
                                                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                                                        <h6 class="mb-0">&nbsp;Editar</h6>
                                                                                                        </button>';
                                                                                        } else {
                                                                                            echo "xxx";
                                                                                        }
                                                                                        ?>
                                                                                    </li>
                                                                                    <li class="list-group-item bg-light border-0">
                                                                                        <h6 class="mb-0 text-danger">Valor a pagar: <strong class="text-uppercase"><?php if ($id_user == 3) {
                                                                                                                                                                        echo 'xxx';
                                                                                                                                                                    } elseif ($id_user == 1 || $id_user == 2) {
                                                                                                                                                                        echo $row4['valor_rest'];
                                                                                                                                                                    } ?></strong></h6>
                                                                                    </li>
                                                                                </ul>
                                                                                <!-- Editar o Valor Pago -->
                                                                                <div class="modal fade" id="editvalpago<?php echo $idserv; ?>" tabindex="-1" aria-labelledby="editvalpago<?php echo $idserv; ?>Label" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                                        <form class="modal-content" method="post" action="../actions/edit_val_pago">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title" id="editvalpago<?php echo $idserv; ?>Label">Editar o Valor
                                                                                                    Pago <input type="text" class="d-none border-0 bg-transparent text-white" id="idservico" name="idservico" value="<?php echo $idserv; ?>"></h5>
                                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <label for="valpago">
                                                                                                    <h6>Valor pago pelo cliente:</h6>
                                                                                                </label>
                                                                                                <div class="input-group mb-3">
                                                                                                    <span class="input-group-text rounded-start">R$</span>
                                                                                                    <input type="text" class="form-control" name="val_pago" aria-label="Valor em reais" value="" size="12" onKeyUp="mascaraMoeda(this, event)" placeholder="Digite o valor pago pelo cliente">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Editar a Fase de Produção -->
                                                                                <div class="modal fade" id="editfase<?php echo $idserv; ?>" tabindex="-1" aria-labelledby="editfase<?php echo $idserv; ?>Label" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                                        <form class="modal-content" method="post" action="../actions/edit_fase_prod.php">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title" id="editfasepagoLabel">Editar a fase de produção <input type="text" class="d-none border-0 bg-transparent text-white" id="idservico" name="idservico" value="<?php echo $idserv; ?>"></h5>
                                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <label for="fase_prod">
                                                                                                    <h6>O serviço está em que fase da produção?</h6>
                                                                                                </label>
                                                                                                <div class="input-group mb-3">
                                                                                                    <select class="form-select" name="fase_prod" id="fase_prod">
                                                                                                        <option disabled selected><?= $row4['fase_prod'] ?></option>
                                                                                                        <option>Separação e Identificação</option>
                                                                                                        <option>Descoloração</option>
                                                                                                        <option>Mesclagem</option>
                                                                                                        <option>Lavagem|Hidratação|Selagem</option>
                                                                                                        <option>Finalização</option>
                                                                                                        <option>Concluído</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 border-0">
                                                                                    <div class="list-group-item bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#qtde_prod" aria-controls="qtde_prod" aria-expanded="false" aria-label="Toggle navigation">
                                                                                        <h6 class="mb-0 text-uppercase text-white">QTDE de
                                                                                            Produtos
                                                                                            a Utilizar&nbsp;<i class="fa-solid fa-chevron-down"></i>
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="list-group-item collapse" id="qtde_prod">
                                                                                        <?php
                                                                                        $query5 = "SELECT p.name_prod, ps.qtde_uso, p.und_medida FROM produto_serv ps INNER JOIN produtos p ON ps.codprod = p.cod_prod INNER JOIN servicos s ON s.id_serv = ps.idserv WHERE s.idpedido = $idpedido AND s.id_serv = $idservico";
                                                                                        $result5 = mysqli_query($conexao, $query5) or die('ERROR');

                                                                                        $total5 = mysqli_num_rows($result5);

                                                                                        if ($total5 > 0) {
                                                                                            while ($row5 = mysqli_fetch_assoc($result5)) {
                                                                                                echo "<h6 class='mb-0'>" . $row5['name_prod'] . ": <strong class='text-uppercase'>" . $row5['qtde_uso'] . " " . $row5['und_medida'] . "</strong></h6>";
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                        <?php
                                                                }
                                                            } while ($row4 = mysqli_fetch_assoc($result4));
                                                        }
                                                        ?>
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#services<?= $row['id_pedido'] ?>" data-bs-slide="prev">
                                                            <span class="text-secondary" aria-hidden="true"><i class="fa-solid fa-angles-left fa-2x"></i></span>
                                                            <span class="visually-hidden text-secondary">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#services<?= $row['id_pedido'] ?>" data-bs-slide="next">
                                                            <span class="text-secondary" aria-hidden="true"><i class="fa-solid fa-angles-right fa-2x"></i></span>
                                                            <span class="visually-hidden text-secondary">Next</span>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                            <?php
                                    } while ($row = mysqli_fetch_assoc($result));
                                } else {
                                    echo "-";
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container text-center text-black-50">
                <p>Todos os direitos reservados &copy; 2023&nbsp;|&nbsp;Desenvolvido por <strong><a href="https://linkedin.com/in/lyonwitt" target="_blank" class="text-decoration-none text-black-50">Witt Dev - Soluções Web</a></strong></p>
            </div>
        </footer>

        <!-- SCRIPTS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="../js/form.js"></script>
        <script>
            // MOEDA
            String.prototype.reverse = function() {
                return this.split('').reverse().join('');
            };

            function mascaraMoeda(campo, evento) {
                var tecla = (!evento) ? window.event.keyCode : evento.which;
                var valor = campo.value.replace(/[^\d]+/gi, '').reverse();
                var resultado = "";
                var mascara = "########,##".reverse();
                for (var x = 0, y = 0; x < mascara.length && y < valor.length;) {
                    if (mascara.charAt(x) != '#') {
                        resultado += mascara.charAt(x);
                        x++;
                    } else {
                        resultado += valor.charAt(y);
                        y++;
                        x++;
                    }
                }
                campo.value = resultado.reverse();
            }

            // ÁREA SELECIONADA
            function cliente_selected() {
                var select = document.getElementById('select_cliente');
                var option = select.options[select.selectedIndex].text;

                if (option != '0') {
                    document.getElementById('cliente-selected').value = option;
                } else {
                    document.getElementById('cliente-selected').value = '';
                }

            }

            cliente_selected();
        </script>

</body>

</html>