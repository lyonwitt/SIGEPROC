<?php
include('verifica.php');
include_once('config.php');
$id_user = $_SESSION['id'];
$mes_ref = $_POST['mes_ref'];
$ano_ref = $_POST['ano_ref'];

if ($id_user == 3) {
    echo "<script>alert('Você não tem permissão para acessar essa página!'); location.href='../pages/servicos';</script>";
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>SIGEPROC - Sistema de Gerenciamento de Produção Capilar</title><!-- FONTAWESOME -->
    <link rel='stylesheet' href='../font-awesome/css/all.css'>
    <link rel='shortcut icon' href='../font-awesome/svgs/solid/gears.svg' type='image/x-icon'>
    <!-- FONTES -->
    <link href='https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Open+Sans:wght@300;400;500;600;700&family=Roboto:wght@100;300;400;500;700&display=swap' rel='stylesheet'>

    <!-- BOOTSTRAP -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>

</head>

<body>
    <div>
        <div class='border-0 text-center bg-primary mt-1 p-2'>
            <h3 class='text-light'> RELATÓRIO MENSAL DO MÊS DE <?= strtoupper($mes_ref); ?> DE <?= $ano_ref ?></h3>
        </div>
        <div class='d-flex aligm-itens-center text-center bg-muted'>
            <div class='col-1 d-flex align-items-center justify-content-center border-bottom border-2 border-primary text-center bg-transparent p-2'>
                <h6 class='mb-0'> ID DO PEDIDO </h6>
            </div>
            <div class='col-1 d-flex align-items-center justify-content-center border-bottom border-2 border-primary text-center bg-transparent p-2'>
                <h6 class='mb-0'> ID DO SERVIÇO </h6>
            </div>
            <div class='col-1 d-flex align-items-center justify-content-center border-bottom border-2 border-primary text-center bg-transparent p-2'>
                <h6 class='mb-0'> MODELO</h6>
            </div>
            <div class='col-2 d-flex align-items-center justify-content-center border-bottom border-2 border-primary text-center bg-transparent p-2'>
                <h6 class='mb-0'> PROCEDÊNCIA DO CABELO</h6>
            </div>
            <div class='col-1 d-flex align-items-center justify-content-center border-bottom border-2 border-primary text-center bg-transparent p-2'>
                <h6 class='mb-0'> QTDE (KG) </h6>
            </div>
            <div class='col-2 d-flex align-items-center justify-content-center border-bottom border-2 border-primary text-center bg-transparent p-2'>
                <h6 class='mb-0'> NOME CLIENTE </h6>
            </div>
            <div class='col-2 d-flex align-items-center justify-content-center border-bottom border-2 border-primary text-center bg-transparent p-2'>
                <h6 class='mb-0'> DATA DE ENTREGA </h6>
            </div>
            <div class='col-2 d-flex align-items-center justify-content-center border-bottom border-2 border-primary text-center bg-transparent p-2'>
                <h6 class='mb-0'> VALOR UNITÁRIO </h6>
            </div>
        </div>

        <?php
        if ($mes_ref == 'Janeiro') {
            $mes_ref = '01';
        } elseif ($mes_ref == 'Fevereiro') {
            $mes_ref = '02';
        } elseif ($mes_ref == 'Março') {
            $mes_ref = '03';
        } elseif ($mes_ref == 'Abril') {
            $mes_ref = '04';
        } elseif ($mes_ref == 'Maio') {
            $mes_ref = '05';
        } elseif ($mes_ref == 'Junho') {
            $mes_ref = '06';
        } elseif ($mes_ref == 'Julho') {
            $mes_ref = '07';
        } elseif ($mes_ref == 'Agosto') {
            $mes_ref = '08';
        } elseif ($mes_ref == 'Setembro') {
            $mes_ref = '09';
        } elseif ($mes_ref == 'Outubro') {
            $mes_ref = '10';
        } elseif ($mes_ref == 'Novembro') {
            $mes_ref = '11';
        } elseif ($mes_ref == 'Dezembro') {
            $mes_ref = '12';
        }

        $query = "SELECT * FROM servicos s INNER JOIN pedidos p ON s.idpedido = p.id_pedido INNER JOIN clientes c ON p.idcliente = c.id_cliente";
        $result = mysqli_query($conexao, $query) or die('Erro no banco');
        $total = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);


        if ($total > 0) {
            $fat_total = "0,";
            do {
                $data_mes = date('m/d/Y', strtotime($row['data_termino']));
                $data_ano = date('Y/d/m', strtotime($row['data_termino']));
                if (strstr($data_mes, '/', true) == $mes_ref && strstr($data_ano, '/', true) == $ano_ref) {
        ?>
                    <div class='d-flex aligm-itens-center text-center bg-transparent text-muted'>
                    <div class='col-1 d-flex align-items-center justify-content-center border-bottom border-1 border-dark text-center bg-transparent p-2'>
                            <h6 class='mb-0'> <?= $row['id_pedido'] ?> </h6>
                        </div>
                        <div class='col-1 d-flex align-items-center justify-content-center border-bottom border-1 border-dark text-center bg-transparent p-2'>
                            <h6 class='mb-0'> <?= $row['id_serv'] ?> </h6>
                        </div>
                        <div class='col-1 d-flex align-items-center justify-content-center border-bottom border-1 border-dark text-center bg-transparent p-2'>
                            <h6 class='mb-0'> <?= $row['modelo_cabelo'] ?> </h6>
                        </div>
                        <div class='col-2 d-flex align-items-center justify-content-center border-bottom border-1 border-dark text-center bg-transparent p-2'>
                            <h6 class='mb-0'> <?= $row['proced_cabelo'] ?> </h6>
                        </div>
                        <div class='col-1 d-flex align-items-center justify-content-center border-bottom border-1 border-dark text-center bg-transparent p-2'>
                            <h6 class='mb-0'> <?= $row['qtde_cabelo'] ?> </h6>
                        </div>
                        <div class='col-2 d-flex align-items-center justify-content-center border-bottom border-1 border-dark text-center bg-transparent p-2'>
                            <h6 class='mb-0'> <?php
                                                /* Separa o nome pelos os espaços na string */
                                                $arr = explode(' ', $row['nome_cliente']);
                                                /* Junta os dois primeiros nomes em uma nova string */
                                                $twoNames = $arr[0] . ' ' . $arr[1];

                                                echo $twoNames;
                                                ?></h6>
                        </div>
                        <div class='col-2 d-flex align-items-center justify-content-center border-bottom border-1 border-dark text-center bg-transparent p-2'>
                            <h6 class='mb-0'> <?php $data = $row['data_termino'];
                                                echo date('d/m/Y', strtotime($data)); ?> </h6>
                        </div>
                        <div class='col-2 d-flex align-items-center justify-content-center border-bottom border-1 border-dark text-center bg-transparent p-2'>
                            <h6 class='mb-0'>R$<?= $row['valor_total'] ?> </h6>
                        </div>
                    </div>
        <?php
                    $fat_total = str_replace(",", "", $fat_total) + str_replace(",", "", $row['valor_total']);
                    $fat_total = substr_replace($fat_total, ',', -2, 0);
                }
            } while ($row = mysqli_fetch_assoc($result));
        }
        ?>
        <div class='d-flex aligm-itens-center justify-content-between bg-transparent text-primary mt-3'>
            <div class='col-10 d-flex align-items-center justify-content-end border-bottom border-top border-1 border-dark bg-transparent p-2'>
                <h6 class='mb-0'> FATURAMENTO TOTAL:</h6>
            </div>
            <div class='col-2 d-flex align-items-center justify-content-center border-bottom border-top border-1 border-dark bg-transparent p-2'>
                <h6 class='mb-0'> R$<?= $fat_total ?></h6>
            </div>
        </div>

    </div>
    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="../js/form.js"></script>
</body>

</html>