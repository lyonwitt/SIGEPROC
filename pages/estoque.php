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
        <!-- CLIENTES -->
        <div class="card m-3">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                Confira seu estoque
                <i class="fa-solid fa-circle-info"></i>
            </h5>
            <div class="card-body" id="buttons_Cli">
                <div class="d-flex flex-wrap col-12">
                    <button class="btn btn-primary border-0 d-flex align-items-center justify-content-center p-3 m-2" type="button" type="button" data-bs-toggle="modal" data-bs-target="#CadProd">
                        <i class="fa-solid fa-square-plus"></i>
                        <h6 class="my-0">&nbsp;&nbsp;Adicionar novo produto</h6>
                    </button>
                </div>
                <!-- Adicionar Novo Produto -->
                <div class="modal fade" id="CadProd" tabindex="-1" aria-labelledby="CadProdLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form class="modal-content" method="post" action="../actions/cad_prod">
                            <div class="modal-header">
                                <h5 class="modal-title" id="CadCliProd">Cadastrar Novo Produto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- nome e descrição do produto -->
                                <div class="d-flex flex-wrap align-items-center justify-content-around">
                                    <div class="col-12 my-2">
                                        <label for="nome">
                                            <h5>Nome do Produto: <b class="text-danger">*</b></h5>
                                        </label>
                                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do produto. Ex: Pó descolorante" required>
                                    </div>
                                    <div class="my-2 col-12">
                                        <label for="descricao">
                                            <h5>Descrição do Produto: <b class="text-danger">*</b></h5>
                                        </label>
                                        <textarea class="form-control" name="descricao" placeholder="Ex: Marca, composição, fabricação, validade, etc." minlength="20" maxlength="300" id="descricao" style="height: 100px" required></textarea>
                                        <small>
                                            <p class="text-muted text-wrap">*Mínimo de 20 caracteres e Máximo de 300 caracteres</p>
                                        </small>
                                    </div>
                                </div>
                                <!-- quantidades -->
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="col-12 col-sm-4 my-2">
                                        <label for="numero">
                                            <h5>Quantidade: <b class="text-danger">*</b></h5>
                                        </label>
                                        <input class="form-control" type="number" name="quantidade" id="quantidade" placeholder="Digite a qtde" required />
                                    </div>
                                    <div class="col-12 col-sm-7 my-2">
                                        <label for="complemento">
                                            <h5>Und de Medida: <b class="text-danger">*</b></h5>
                                        </label>
                                        <select class="form-select" name="und_medida" id="und_medida" required>
                                            <option value="m">Metro</option>
                                            <option value="cm">Centimetro</option>
                                            <option value="mm">Milimetro</option>
                                            <option value="ml">Mililitro</option>
                                            <option value="l">Litro</option>
                                            <option value="kg">Quilograma</option>
                                            <option value="g">Grama</option>
                                            <option value="pacote">Pacote</option>
                                            <option value="pote">Pote</option>
                                            <option value="rolo">Rolo</option>
                                        </select>
                                    </div>
                                    <div class="col-12 my-2">
                                        <label for="numero">
                                            <h5>Margem de segurança: <b class="text-danger">*</b></h5>
                                        </label>
                                        <input class="form-control" type="number" name="margem_seg" id="margem_seg" placeholder="Digite a quantidade da margem de segurança" required />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-12 justify-content-center d-flex flex-wrap pt-4 ps-2">
                                    <button class="btn btn-success m-2 col-12 col-sm-6 col-md-3 py-2" type="submit" id="cadastrar">
                                        <i class="fa-solid fa-check"></i>
                                        Inserir
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

                <!-- Lista de Produtos -->
                <div class="d-flex flex-wrap">
                    <?php
                    include("../actions/config.php");

                    $query = "SELECT * FROM produtos";
                    $result = mysqli_query($conexao, $query) or die('Erro no banco de dados!');
                    $row = mysqli_fetch_assoc($result);
                    $total = mysqli_num_rows($result);

                    if ($total > 0) {

                        do {
                            if ($row['qtde_prod'] > 0) {

                    ?>
                                <div class="col-md-5 col-lg-5 card m-2">
                                    <div class="card-body bg-light">
                                        <h6 class="card-title">Nome do Produto: <strong class="text-uppercase"><?= $row['name_prod'] ?> <h6 class="text-primary">[ID:&nbsp;<?= $row['cod_prod'] ?>]</h6></strong></h6>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <h6 class="mb-0 ">Descrição do Produto: <strong class="text-uppercase"><?= $row['desc_prod'] ?></strong></h6>
                                            </h6>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <h6 class="mb-0 text-success">Em estoque: <strong class="text-uppercase"><?= $row['qtde_prod'] ?>&nbsp;<?php if ($row['qtde_prod'] > 1 && $row['und_medida'] != 'Gramas') {
                                                                                                                                                        echo $row['und_medida'] . "s";
                                                                                                                                                    } else {
                                                                                                                                                        echo $row['und_medida'];
                                                                                                                                                    } ?></strong></h6>
                                            </h6>
                                            <?php
                                            if($id_user == 1 || $id_user == 2) {
                                                echo"
                                            <button type='button' data-bs-toggle='modal' data-bs-target='#editprod".$row['cod_prod']."' class='border-0 bg-transparent d-flex align-items-center justify-content-center text-secondary'>
                                                &nbsp;&nbsp;
                                                <i class='fa-solid fa-circle-plus'></i>
                                                <h6 class='mb-0'>&nbsp;Adicionar mais</h6>
                                            </button>";
                                            } else {
                                                echo "&nbsp;";
                                            }
                                            ?>
                                            
                                        </li>
                                        <li class="list-group-item border-0">
                                            <h6 class="mb-0 text-danger">Margem de segurança: <strong class="text-uppercase"><?= $row['qtde_sec_prod'] ?>&nbsp;<?php if ($row['qtde_sec_prod'] > 1 && $row['und_medida'] != 'Gramas') {
                                                                                                                                                                    echo $row['und_medida'] . "s";
                                                                                                                                                                } else {
                                                                                                                                                                    echo $row['und_medida'];
                                                                                                                                                                } ?></strong></h6>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Editar o Valor Pago -->
                                <div class="modal fade" id="editprod<?= $row['cod_prod'] ?>" tabindex="-1" aria-labelledby="editprod<?= $row['cod_prod'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form class="modal-content" method="post" action="../actions/edit_prod">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editvalpagoLabel">Editar a quantidade em estoque
                                                    Pago <input type="text" class="border-0 bg-transparent text-white" id="cod_prod" name="cod_prod" value="<?= $row['cod_prod'] ?>"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="prod">
                                                    <h6>Quantidade a ser adicionada:</h6>
                                                </label>
                                                <div class="input-group mb-3 d-flex">
                                                    <input type="text" class="col-8 form-control" name="qtde_prod" aria-label="Qtde de produto" value="" placeholder="Digite a quantidade a ser adicionar">
                                                    <input type="text" class="ms-2 col-4 form-control" name="und_medida" value="<?= $row['und_medida'] ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Salvar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                    <?php
                            }
                        } while ($row = mysqli_fetch_assoc($result));
                    } else {
                        echo "<div class='m-2 alert alert-danger' role='alert'>";
                        echo "Não há nenhum produto em estoque!";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer navbar-fixed-bottom">
        <div class="container text-center text-black-50">
            <p>Todos os direitos reservados &copy; 2023&nbsp;|&nbsp;Desenvolvido por <strong><a href="https://linkedin.com/in/lyonwitt" target="_blank" class="text-decoration-none text-black-50">Witt Dev - Soluções Web</a></strong></p>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/form.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>