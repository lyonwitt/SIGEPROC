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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container d-flex justify-content-between">
                <button class="bg-transparent border-0 d-block d-sm-block d-md-block d-lg-none d-xl-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class='fa-solid fa-bars text-white-50'></i>
                </button>

                <div class="navbar-collapse collapse w-100 justify-content-between px-2" id="navbarNav">
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
    <section class='all-content d-flex justify-content-between align-items-start'>
        <div class='container'>
            <div class='alert bg-danger rounded d-flex justify-content-center align-items-center p-2 m-3'>
                <div class='w-100 d-flex align-items-center justify-content-center flex-column text-center'>
                    <marquee class='w-100' scrolldelay='80'>
                        <h6 class='text-light text-uppercase d-none d-sm-none d-md-block px-3 py-2'>Seja bem-vindo(a) ao
                            SiGeProC! Leia com muita
                            atenção a todos os avisos abaixo.</h6>
                        <h5 class='text-light text-uppercase d-block d-sm-block d-md-none px-3 py-2'>Seja bem-vindo(a)
                            ao SiGeProC! Leia com muita
                            atenção a todos os avisos abaixo.</h5>
                    </marquee>
                </div>
            </div>

            <!-- avisos -->
            <div class='card m-3'>
                <h5 class='card-header d-flex justify-content-between align-items-center'>
                    Avisos sobre serviços
                    <i class='fa-solid fa-circle-exclamation'></i>
                </h5>
                <div class='card-body'>
                    <div class='avisos_serv'>
                        <?php
                        include_once('../actions/config.php');
                        $query = "SELECT * FROM servicos s INNER JOIN pedidos p ON s.idpedido = p.id_pedido INNER JOIN clientes c ON c.id_cliente = p.idcliente";
                        $result = mysqli_query($conexao, $query) or die('Erro no Banco de Dados');
                        $total = mysqli_num_rows($result);
                        $row = mysqli_fetch_assoc($result);

                        if ($total > 0) {
                            do {

                                list($day_term, $month_term, $year_term) = explode("-", date('d-m-Y', strtotime($row['data_termino'])));
                                list($day_atual, $month_atual, $year_atual) = explode("-", date('d-m-Y'));

                                $intervalo = $day_term - $day_atual;

                                if ($intervalo >= 0 && $intervalo <= 5 && $row['fase_prod'] != 'Concluído') {
                        ?>
                                    <div class='bg-warning rounded p-2 w-100 my-1 mb-2'>
                                        <h5><strong class="text-primary">PEDIDO Nº: <?= $row['id_pedido'] ?> | SERVIÇO Nº: <?= $row['id_serv'] ?></strong></h5> Modelo: <strong> <?= $row['modelo_cabelo'] ?> </strong>| Cliente: <strong><?php $arr = explode(' ', $row['nome_cliente']);
                                                                                                                                                                                                $twoNames = $arr[0] . ' ' . $arr[1];
                                                                                                                                                                                                echo $twoNames; ?></strong></h5>
                                        <p class='card-text my-2 bg-transparent border border-secondary p-1 rounded'>
                                            Faltam <strong class='text-danger'><?= $intervalo; ?> dias</strong> para a entrega do serviço.
                                        </p>
                                    </div>
                        <?php
                                }
                            } while ($row = mysqli_fetch_assoc($result));
                        } else {
                            echo "<h6 class='text-muted'>Não há avisos sobre serviços</h6>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class='card m-3'>
                <h5 class='card-header d-flex justify-content-between align-items-center'>
                    Avisos sobre estoque
                    <i class='fa-solid fa-circle-exclamation'></i>
                </h5>
                <div class='card-body'>
                    <div class='avisos_serv'>
                        <?php
                        include_once('../actions/config.php');
                        $query = "SELECT * FROM produtos";
                        $result = mysqli_query($conexao, $query) or die('Erro no Banco de Dados');
                        $total = mysqli_num_rows($result);
                        $row = mysqli_fetch_assoc($result);

                        if ($total > 0) {
                            do {
                                if ($row['qtde_prod'] == $row['qtde_sec_prod']) {
                        ?>
                                    <div class='bg-success rounded p-2 w-100 my-1 mb-2'>
                                        <h5><strong>PRODUTO</strong>-> ID: <strong><?= $row['cod_prod'] ?></strong> | Nome: <strong> <?= $row['name_prod'] ?> </strong></h5>
                                        <p class='card-text'>
                                            O seu produto atingiu o limite de segurança de <strong class='text-danger'><?= $row['qtde_sec_prod'] ?> <?= $row['und_medida'] ?>s</strong>.
                                        </p>
                                    </div>
                        <?php
                                } elseif ($row['qtde_prod'] > $row['qtde_sec_prod']) {
                                    echo "<h6 class='text-muted'>Não há avisos sobre estoque</h6>";
                                    break;
                                }
                            } while ($row = mysqli_fetch_assoc($result));
                        }
                        ?>
                    </div>
                </div>
            </div>
    </section>

    <footer class='text-center'>
        <div class='container text-center text-black-50'>
            <p>Todos os direitos reservados &copy; 2023&nbsp;|&nbsp;Desenvolvido por <strong><a href='https://linkedin.com/in/lyonwitt' target='_blank' class='text-decoration-none text-black-50'>Witt Dev - Soluções Web</a></strong></p>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js' integrity='sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js' integrity='sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13' crossorigin='anonymous'></script>
    <script src='../js/form.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</body>

</html>