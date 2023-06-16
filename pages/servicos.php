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
            <h5 class="card-header d-flex justify-content-between align-items-center">
                Confira seus serviços em andamento
                <i class="fa-solid fa-circle-info"></i>
            </h5>
            <div class="card-body" id="buttons_serv">
                <div class="d-flex flex-wrap justify-content-between col-12">

                    <div class="d-flex flex-wrap">
                        <form class="input-group m-2" method="POST" action="./serv_cli.php">
                            <select class="form-select" aria-label="Selecione o Cliente" id="select_cliente" name="select_cliente">
                                <option selected disabled>Selecione o Cliente</option>
                                <?php
                                include_once('../actions/config.php');
                                $query = "SELECT id_cliente, nome_cliente FROM clientes";
                                $result = mysqli_query($conexao, $query) or die('Erro no Banco de Dados');

                                $row = mysqli_fetch_assoc($result);

                                $total = mysqli_num_rows($result);

                                if ($total > 0) {
                                    do {
                                ?>
                                        <option>
                                            <?php $id_cliente = $row['id_cliente'];
                                            echo $id_cliente; ?>
                                            | Nome:
                                            <?php
                                            /* Separa o nome pelos os espaços na string */
                                            $arr = explode(' ', $row['nome_cliente']);
                                            /* Junta os dois primeiros nomes em uma nova string */
                                            $twoNames = $arr[0] . ' ' . $arr[1];

                                            echo $twoNames;
                                            ?>
                                        </option>
                                <?php
                                    } while ($row = mysqli_fetch_assoc($result));
                                };
                                ?>
                            </select>
                            <button submit class="border-0 btn-success rounded-end d-flex justify-content-between align-items-center px-3">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                    <!-- botões de serviço mobile -->
                    <button class="col-12 btn btn-primary border-0 d-flex d-md-none align-items-center justify-content-center p-3 m-2" type="button" data-bs-toggle="modal" data-bs-target="#AddServ">
                        <i class="fa-solid fa-square-plus"></i>
                        <h6 class="my-0">&nbsp;&nbsp;Adicionar novo pedido</h6>
                    </button>
                    <button class="col-12 btn btn-secondary border-0 d-flex d-md-none align-items-center justify-content-center p-3 m-2" type="button" data-bs-toggle="modal" data-bs-target="#AddServ">
                        <i class="fa-solid fa-square-plus"></i>
                        <h6 class="my-0">&nbsp;&nbsp;Adicionar novo serviço</h6>
                    </button>
                    <a href="./all_servicos" target="_blank" type="button" class="text-decoration-none col-12 btn btn-secondary bg-transparent d-flex d-md-none align-items-center justify-content-center p-3 m-2 text-secondary">
                        <i class="fa-solid fa-eye"></i>
                        <h6 class="my-0">&nbsp;&nbsp;Ver todos os pedidos</h6>
                    </a>
                    <!-- botões de serviço desktop -->
                    <div class="d-none d-md-flex justify-content-between">
                        <button class="btn btn-primary border-0 d-none d-md-flex align-items-center justify-content-center p-3 m-2" type="button" data-bs-toggle="modal" data-bs-target="#AddPed">
                            <i class="fa-solid fa-square-plus"></i>
                            <h6 class="my-0">&nbsp;&nbsp;Adicionar pedido</h6>
                        </button>
                        <button class="btn btn-secondary border-0 d-none d-md-flex align-items-center justify-content-center p-3 m-2" type="button" data-bs-toggle="modal" data-bs-target="#AddServ">
                            <i class="fa-solid fa-square-plus"></i>
                            <h6 class="my-0">&nbsp;&nbsp;Adicionar serviço</h6>
                        </button>
                        <a href="./all_servicos" target="_blank" type="button" class="text-decoration-none btn btn-secondary bg-transparent border-2 d-none d-md-flex align-items-center justify-content-center p-3 m-2 text-secondary">
                            <i class="fa-solid fa-eye"></i>
                            <h6 class="my-0">&nbsp;&nbsp;Ver todos os pedidos</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="AddServ" tabindex="-1" aria-labelledby="AddServLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form class="modal-content" method="post" action="../actions/cad_serv.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddServLabel">Adicionar Novo Serviço</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- DADOS DO SERVIÇO -->
                        <div class="d-flex flex-wrap align-items-center justify-content-around">
                            <div class="col-12 my-2">
                                <label for="cliente">
                                    <h5>Número do Pedido: <b class="text-danger">*</b></h5>
                                </label>
                                <select class="form-select" name="id_pedido" id="id_pedido">
                                    <option selected disabled>Selecione o nº do pedido...</option>
                                    <?php
                                    include_once('../actions/config.php');
                                    $query = "SELECT p.id_pedido, p.idcliente, c.id_cliente, c.nome_cliente FROM pedidos p INNER JOIN clientes c ON p.idcliente = c.id_cliente";
                                    $result = mysqli_query($conexao, $query) or die('Erro no Banco de Dados');

                                    $row = mysqli_fetch_assoc($result);

                                    $total = mysqli_num_rows($result);

                                    if ($total > 0) {
                                        $idcliente = $row['idcliente'];
                                        do {
                                    ?>
                                            <option value="<?= $row['id_pedido'] ?>">
                                                Nº Pedido:&nbsp;<?= $row['id_pedido'] ?>
                                                | Cliente:
                                                <?php
                                                    /* Separa o nome pelos os espaços na string */
                                                    $arr = explode(' ', $row['nome_cliente']);
                                                    /* Junta os dois primeiros nomes em uma nova string */
                                                    $twoNames = $arr[0] . ' ' . $arr[1];

                                                    echo $twoNames;
                                                ?>
                                            </option>
                                    <?php
                                        } while ($row = mysqli_fetch_assoc($result));
                                    }
                                    ?>
                                </select>
                                <h6 class="text-danger mb-0">Caso não exista o cliente, cadastre-o primeiro.</h6>
                            </div>
                            <div class="name col-12 my-2">
                                <label for="modelo_cabelo">
                                    <h5>Modelo do Cabelo: <b class="text-danger">*</b></h5>
                                </label>
                                <input type="text" class="form-control" id="modelo_cabelo" name="modelo_cabelo" placeholder="Digite o tipo do serviço. Ex: Morena Anitta" required>
                            </div>
                            <div class="cpf col-12 my-2">
                                <label for="qtde_cabelo">
                                    <h5>Quantidade de cabelo (KG): <b class="text-danger">*</b></h5>
                                </label>
                                <input type="number" class="form-control" id="qtde_cabelo" name="qtde_cabelo" placeholder="Digite a quantidade de cabelo. Ex: 5" required>
                            </div>
                            <div class="cpf col-12 my-2">
                                <label for="tam_cabelo">
                                    <h5>Tamanho do cabelo: <b class="text-danger">*</b></h5>
                                </label>
                                <input type="number" class="form-control" id="tam_cabelo" name="tam_cabelo" placeholder="Digite o tamanho do cabelo em centímetros. Ex: 70" required>
                            </div>
                            <div class="col-12 my-2">
                                <label for="proced_cabelo">
                                    <h5>Procedência do Cabelo: <b class="text-danger">*</b></h5>
                                </label>
                                <select class="form-select" name="proced_cabelo" id="proced_cabelo">
                                    <option selected disabled>Selecione a procedência do cabelo...</option>
                                    <option>Chinês</option>
                                    <option>Vietnamita</option>
                                    <option>Brasileiro</option>
                                    <option>Indonésia</option>
                                    <option>Indiano</option>
                                </select>
                            </div>
                            <div class="col-12 my-2">
                                <label for="tipo_cabelo">
                                    <h5>Tipo do Cabelo: <b class="text-danger">*</b></h5>
                                </label>
                                <select class="form-select" name="tipo_cabelo" id="tipo_cabelo">
                                    <option selected disabled>Selecione o tipo do cabelo...</option>
                                    <option>Liso</option>
                                    <option>Ondulado</option>
                                    <option>Cacheado</option>
                                </select>
                            </div>
                            <div class="col-12 my-2">
                                <label for="cor_elastico">
                                    <h5>Cor do Elástico: <b class="text-danger">*</b></h5>
                                </label>
                                <select class="form-select" name="cor_elastico" id="cor_elastico">
                                    <option selected disabled>Selecione a cor do elástico...</option>
                                    <option>Azul</option>
                                    <option>Verde</option>
                                    <option>Roxo</option>
                                    <option>Rosa</option>
                                    <option>Amarelo</option>
                                    <option>Branco</option>
                                    <option>Preto</option>
                                    <option>Laranja</option>
                                    <option>Bege</option>
                                </select>
                            </div>
                            <div class="col-12 my-2">
                                <label for="cor_liga">
                                    <h5>Cor da Liga: <b class="text-danger">*</b></h5>
                                </label>
                                <select class="form-select" name="cor_liga" id="cor_liga">
                                    <option selected disabled>Selecione a cor da liga...</option>
                                    <option>Azul</option>
                                    <option>Rosa</option>
                                    <option>Verde</option>
                                    <option>Dourada</option>
                                    <option>Prata</option>
                                    <option>Vermelha</option>
                                    <option>Preta</option>
                                    <option>Branca</option>
                                    <option>Laranja</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap justify-content-around align-items-center">

                            <div class="col-12 my-2">
                                <label>
                                    <h5>Produtos que serão utilizados: <b class="text-danger">*</b></h5>
                                </label>
                                <div id="lines">
                                    <div class=" d-flex align-items-center justify-content-between">
                                        <select class="form-select" name="produto_serv" id="produto_serv" required>
                                            <option selected disabled>Selecione o produto...</option>
                                            <?php
                                            $query = "SELECT * FROM produtos";
                                            $result = mysqli_query($conexao, $query) or die('Erro no Banco de Dados');

                                            $row = mysqli_fetch_assoc($result);

                                            $total = mysqli_num_rows($result);

                                            if ($total > 0) {
                                                do {
                                                    if ($row['qtde_prod'] > 0) {
                                            ?>
                                                        <option><?= $row['cod_prod'] ?> | Nome: <?= $row['name_prod'] ?> | Und de medida: <?= $row['und_medida'] ?></option>
                                            <?php
                                                    }
                                                } while ($row = mysqli_fetch_assoc($result));
                                            };
                                            ?>
                                        </select>
                                        <input type="number" class="w-50 form-control" id="qtd_uso" name="qtd_uso" placeholder="Quantidade" required />
                                    </div>
                                </div>
                                <div type="button" onclick="addSelect('lines')" class="d-flex align-items-center">
                                    <i class="fa-solid fa-circle-plus text-success"></i>
                                    &nbsp;
                                    <h6 class="text-success mb-0">Adicionar mais produtos</h6>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap align-items-center justify-content-around">
                            <div class="input-group my-2 col-12 my-2">
                                <label for="valor_total">
                                    <h5>Valor do Serviço: <b class="text-danger">*</b></h5>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input class="form-control" type="text" name="valor_total" id="valor_total" value="" size="12" onKeyUp="mascaraMoeda(this, event)" required placeholder="Digite o valor do serviço" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-12 justify-content-center d-flex flex-wrap pt-4 ps-2">
                            <button class="btn btn-success m-2 col-12 col-sm-6 col-md-3 py-2" type="submit" id="cadastrar">
                                <i class="fa-solid fa-check"></i>
                                Cadastrar
                            </button>
                            <button class="btn btn-danger m-2 col-12 col-sm-6 col-md-3 py-2" type="reset" id="cadastrar">
                                <i class="fa-solid fa-xmark"></i>
                                Limpar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- ADICIONAR NOVO PEDIDO -->
        <div class="modal fade" id="AddPed" tabindex="-1" aria-labelledby="AddPedLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form class="modal-content" method="post" action="../actions/cad_ped.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddServLabel">Adicionar Novo Pedido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- DADOS DO PEDIDO -->
                        <div class="d-flex flex-wrap align-items-center justify-content-around">
                            <div class="col-12 my-2">
                                <label for="cliente">
                                    <h5>Cliente: <b class="text-danger">*</b></h5>
                                </label>
                                <select class="form-select" name="id_cliente" id="id_cliente" required>
                                    <option selected disabled>Selecione o Cliente...</option>
                                    <?php
                                    include_once('../actions/config.php');
                                    $query = "SELECT id_cliente, nome_cliente, iduser FROM clientes";
                                    $result = mysqli_query($conexao, $query) or die('Erro no Banco de Dados');

                                    $row = mysqli_fetch_assoc($result);

                                    $total = mysqli_num_rows($result);

                                    if ($total > 0) {
                                        do {
                                    ?>
                                            <option value="<?= $row['id_cliente'] ?>">
                                                <?= $row['id_cliente'] ?>
                                                | Nome:
                                                <?php
                                                /* Separa o nome pelos os espaços na string */
                                                $arr = explode(' ', $row['nome_cliente']);
                                                /* Junta os dois primeiros nomes em uma nova string */
                                                $twoNames = $arr[0] . ' ' . $arr[1];

                                                echo $twoNames;
                                                ?>
                                            </option>
                                    <?php
                                        } while ($row = mysqli_fetch_assoc($result));
                                    };
                                    ?>
                                </select>
                                <h6 class="text-danger mb-0">Caso não exista o cliente, cadastre-o primeiro.</h6>
                            </div>
                            <div class="my-2 col-12 my-2">
                                <label for="data_termino">
                                    <h5>Data de entrega: <b class="text-danger">*</b></h5>
                                </label>
                                <input class="form-control" type="date" name="data_termino" id="data_termino" value="" required placeholder="Digite a data de entrega do serviço" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-12 justify-content-center d-flex flex-wrap pt-4 ps-2">
                            <button class="btn btn-success m-2 col-12 col-sm-6 col-md-3 py-2" type="submit" id="cadastrar">
                                <i class="fa-solid fa-check"></i>
                                Cadastrar
                            </button>
                            <button class="btn btn-danger m-2 col-12 col-sm-6 col-md-3 py-2" type="reset" id="cadastrar">
                                <i class="fa-solid fa-xmark"></i>
                                Limpar
                            </button>
                        </div>
                    </div>
                </form>
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