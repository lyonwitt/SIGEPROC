<?php
include('../actions/verifica.php');
include('../actions/config.php');

$id_user = $_SESSION['id'];

if ($id_user == 3) {
    echo "<script>alert('Você não tem permissão para acessar essa página!'); location.href='../pages/me';</script>";
}
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

    <script language=javascript>
        function confirmacao() {
            if (confirm("Tem certeza que deseja alterar os dados?")) {
                location.href = './';
            }
        }
    </script>
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
                Área de Clientes
                <i class="fa-solid fa-circle-plus"></i>
            </h5>
            <div class="card-body" id="buttons_Cli">
                <div class="d-flex flex-wrap col-12">
                    <!-- cadastrar clientes -->
                    <button class="btn btn-primary border-0 d-flex align-items-center justify-content-between p-3 m-2" type="button" data-bs-toggle="modal" data-bs-target="#CadCli">
                        <i class="fa-solid fa-user-plus"></i>
                        <h6 class="my-0">&nbsp;&nbsp;Cadastrar Novo Cliente</h6>
                    </button>

                    <button class="btn btn-secondary border-0 d-flex align-items-center justify-content-between p-3 m-2" type="button" data-bs-toggle="collapse" data-bs-target="#SelCliDropdown" aria-controls="SelCliDropdown" aria-expanded="false" aria-label="Editar Cliente">
                        <i class="fa-solid fa-user-pen"></i>
                        <h6 class="my-0">&nbsp;&nbsp;Editar Dados de Cliente</h6>
                    </button>
                </div>
                <!-- Cadastro de cliente-->
                <div class="modal fade" id="CadCli" tabindex="-1" aria-labelledby="CadCliLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form class="modal-content" method="post" action="../actions/cad_cli">
                            <div class="modal-header">
                                <h5 class="modal-title" id="CadCliLabel">Cadastrar Novo Cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- nome e cpf/cnpj -->
                                <div class="d-flex flex-wrap align-items-center justify-content-around">
                                    <div class="name col-12 my-2">
                                        <label for="name">
                                            <h5>Nome/Razão Social: <b class="text-danger">*</b></h5>
                                        </label>
                                        <input type="text" maxlength="80" class="form-control" name="name" placeholder="Digite o nome ou a razão social do cliente" required>
                                    </div>
                                    <div class="cpf col-12 my-2">
                                        <label for="cpf">
                                            <h5>CPF/CNPJ: <b class="text-danger"></b></h5>
                                        </label>
                                        <input type="text" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18" class="form-control" name="cpf" placeholder="Digite o CPF/CNPJ do cliente">
                                    </div>
                                </div>
                                <!-- e-mail e telefones -->
                                <div class="d-flex flex-wrap justify-content-around align-items-center">
                                    <div class="email col-12 my-2">
                                        <label for="email">
                                            <h5>E-mail: <b class="text-danger"></b></h5>
                                        </label>
                                        <input type="email" class="form-control" name="email" placeholder="Digite o e-mail do cliente">
                                    </div>
                                    <div class="telefone col-12 my-2">
                                        <label for="tel">
                                            <h5>Telefone: <b class="text-danger">*</b></h5>
                                        </label>
                                        <div class="d-flex">
                                            <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" class="form-control w-25" name="ddd_tel" placeholder="DDD" required>
                                            <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" class="form-control ms-1 w-75" name="num_tel" placeholder="Número de telefone" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- CEP, RUA e NUMERO -->
                                <div class="d-flex flex-wrap align-items-center justify-content-around">
                                    <div class="my-2 col-12 my-2">
                                        <label for="cep">
                                            <h5>CEP: <b class="text-danger"></b></h5>
                                        </label>
                                        <input class="form-control" onkeypress='mascaraMutuario(this,Cep)' onblur='clearTimeout()' type="text" name="cep" id="cep" maxlength="9" placeholder="Digite o CEP (apenas números)" />
                                    </div>
                                    <div class="col-12 my-2">
                                        <label for="logradouro">
                                            <h5>Logradouro: <b class="text-danger"></b></h5>
                                        </label>
                                        <input class="form-control" type="text" name="logradouro" id="logradouro" size="45" />
                                    </div>

                                </div>
                                <!-- NUMERO, COMPLEMENTO BAIRRO, CIDADE, ESTADO -->
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="col-12 col-sm-6 my-2">
                                        <label for="numero">
                                            <h5>Número: <b class="text-danger"></b></h5>
                                        </label>
                                        <input class="form-control" type="text" name="numero" id="numero" size="5"/>
                                    </div>
                                    <div class="col-12 col-sm-5 my-2">
                                        <label for="complemento">
                                            <h5>Complemento:</h5>
                                        </label>
                                        <input class="form-control" type="text" name="complemento" id="complemento" size="5" />
                                    </div>
                                    <div class="col-12 my-2">
                                        <label for="bairro">
                                            <h5>Bairro: <b class="text-danger"></b></h5>
                                        </label>
                                        <input class="form-control" type="text" name="bairro" id="bairro" maxlength="25" />
                                    </div>
                                    <div class="col-12 my-2">
                                        <label for="cidade">
                                            <h5>Cidade: <b class="text-danger"></b></h5>
                                        </label>
                                        <input class="form-control" type="text" name="cidade" id="cidade" size="25" />
                                    </div>
                                    <div class="col-12 my-2">
                                        <label for="estado">
                                            <h5>Estado: <b class="text-danger"></b></h5>
                                        </label>
                                        <select class="form-select" name="estado" id="estado">
                                            <option disabled selected>UF</option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>
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
                <!-- Tabela de Clientes -->
                <div class="table-cli collapse mt-5" data-parent="#buttons_Cli" aria-label="Lista de Clientes" id="SelCliDropdown">
                    <div class="row w-100 m-2">
                        <div class="col-3 col-md-1 col-lg-1 border-bottom border-primary border-2">
                            <h6>ID</h6>
                        </div>
                        <div class="col-4 col-md-5 col-lg-5 border-bottom border-primary border-2">
                            <h6 class="d-none d-md-block">Nome/Razão Social</h6>
                            <h6 class="d-block d-md-none">Nome</h6>
                        </div>
                        <div class="col-3 col-md-3 col-lg-3 border-bottom border-primary border-2 d-none d-md-block">
                            <h6>Telefone</h6>
                        </div>
                        <div class="col-5 col-md-1 col-lg-1 border-bottom border-primary border-2 text-center">
                            <h6>Editar</h6>
                        </div>
                        <!-- <div class="col-3 col-md-1 col-lg-1 border-bottom border-primary border-2 text-center">
                            <h6>Excluir</h6>
                        </div> -->
                    </div>
                    <?php
                    $query = "SELECT * FROM clientes c INNER JOIN tel_cliente t ON c.id_cliente = t.idcliente";
                    $result = mysqli_query($conexao, $query) or die('Erro no Banco de Dados');

                    $row = mysqli_fetch_assoc($result);

                    $total = mysqli_num_rows($result);

                    if ($total > 0) {
                        do {
                    ?>
                            <div class='row w-100 m-2'>
                                <div class='col-3 col-md-1 col-lg-1 text-muted border-2 border-muted border-bottom d-flex align-items-center'>
                                    <h6 class='mb-0'><?= $row['id_cliente'] ?></h6>
                                </div>
                                <div class='col-4 col-md-5 col-lg-5 text-muted border-2 border-muted border-bottom d-flex align-items-center'>
                                    <h6 class='mb-0 text-uppercase'><?= $row['nome_cliente'] ?></h6>
                                </div>
                                <div class='col-md-3 col-lg-3 text-muted border-2 border-muted border-bottom d-flex align-items-center d-none d-md-block'>
                                    <h6 class='mb-0'><?= $row['ddd_tel_cli'] ?>&nbsp;<?= $row['num_tel_cli'] ?></h6>
                                </div>
                                <div type='button' class='border-0 bg-transparente text-success col-5 col-md-1 col-lg-1 text-center border-2 border-muted border-bottom' data-bs-toggle='modal' data-bs-target='#EditCli<?= $row['id_cliente'] ?>'>
                                    <i class='fa-solid fa-pen'></i>
                                </div>

                                <!-- <div type='button' class='border-0 bg-transparent text-danger col-3 col-md-1 col-lg-1 text-center border-2 border-muted border-bottom' data-bs-toggle="modal" data-bs-target="#modalexclui<?= $row['id_cliente'] ?>">
                                    <i class='fa-solid fa-trash'></i>
                                </div> -->
                                <!-- alerta de confirmação -->
                                <!-- <div class="modal fade" id="modalexclui<?= $row['id_cliente'] ?>" tabindex="-1" aria-labelledby="examplemodalexclui<?= $row['id_cliente'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="examplemodalexclui<?= $row['id_cliente'] ?>">Você quer mesmo excluir esse cliente?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form method='post' action='../actions/excluir_cli'>
                                                    <input class="d-none" name="idcliente" value="<?= $row['id_cliente'] ?>" readonly />
                                                    <button type="submit" class="btn btn-success">Excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                    <?php
                        } while ($row = mysqli_fetch_assoc($result));
                    };
                    ?>
                </div>
                <!-- Dados do Cliente Selecionado -->
                <?php
                $query = "SELECT * FROM clientes c INNER JOIN tel_cliente t ON c.id_cliente = t.idcliente INNER JOIN endereco_cliente e ON c.id_cliente = e.idcliente WHERE iduser = $id_user";
                $result = mysqli_query($conexao, $query) or die('Erro no Banco de Dados');

                $row = mysqli_fetch_assoc($result);

                $total = mysqli_num_rows($result);

                if ($total > 0) {
                    do {
                ?>
                        <div class="modal fade" id="EditCli<?= $row['id_cliente'] ?>" tabindex="-1" aria-labelledby="EditCliLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form class="modal-content" method='post' action='../actions/edit_cli'>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="EditCliLabel">Editar Dados do Cliente</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- nome e cpf/cnpj -->
                                        <div class="d-none align-items-center name col-1 my-2">
                                            <label for="id_cliente">
                                                <h6 class="mb-0">ID:</h6>
                                            </label>
                                            <input type="number" readonly class="form-control-sm border-secondary ms-2" name="id_cliente" id="id_cliente" value="<?= $row['id_cliente'] ?>">
                                        </div>
                                        <div class="d-flex flex-wrap align-items-center justify-content-around">
                                            <div class="name col-12 my-2">
                                                <label for="name">
                                                    <h5>Nome/Razão Social: <b class="text-danger">*</b></h5>
                                                </label>
                                                <input type="text" maxlength="80" class="form-control text-uppercase" name="name" id="name" placeholder="Digite o Nome/Razão Social do cliente" value="<?= $row['nome_cliente'] ?>" required>
                                            </div>
                                            <div class="cpf col-12 my-2">
                                                <label for="cpf">
                                                    <h5>CPF/CNPJ: <b class="text-danger">*</b></h5>
                                                </label>
                                                <input type="text" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' name="cpf" maxlength="18" class="form-control" id="cpf" placeholder="Digite o CPF/CNPJ do cliente" value="<?= $row['cpf_cliente'] ?>" required>
                                            </div>
                                        </div>
                                        <!-- e-mail e telefones -->
                                        <div class="d-flex flex-wrap justify-content-around align-items-center">
                                            <div class="email col-12 my-2">
                                                <label for="email">
                                                    <h5>E-mail: <b class="text-danger">*</b></h5>
                                                </label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail do cliente" value="<?= $row['email_cliente'] ?>" required>
                                            </div>
                                            <div class="telefone col-12 my-2">
                                                <label for="tel">
                                                    <h5>Telefone: <b class="text-danger">*</b></h5>
                                                </label>
                                                <div class="d-flex">
                                                    <input type="number" name="ddd_tel" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" class="form-control w-25" id="ddd_tel" placeholder="DDD" value="<?= $row['ddd_tel_cli'] ?>" required>
                                                    <input type="number" name="num_tel" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" class="form-control ms-1 w-75" id="num_tel" placeholder="Número de telefone" value="<?= $row['num_tel_cli'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- CEP, RUA e NUMERO -->
                                        <div class="d-flex flex-wrap align-items-center justify-content-around">
                                            <div class="my-2 col-12 my-2">
                                                <label for="cep">
                                                    <h5>CEP: <b class="text-danger">*</b></h5>
                                                </label>
                                                <input class="form-control" onkeypress='mascaraMutuario(this,Cep)' onblur='clearTimeout()' type="text" name="cep" id="cep" maxlength="9" required placeholder="Digite o CEP (apenas números)" value="<?= $row['cep_end_cliente'] ?>" />
                                            </div>
                                            <div class="col-12 my-2">
                                                <label for="logradouro">
                                                    <h5>Logradouro: <b class="text-danger">*</b></h5>
                                                </label>
                                                <input class="form-control" type="text" name="logradouro" id="logradouro" value="<?= $row['logradouro_end_cliente'] ?>" size="45" />
                                            </div>

                                        </div>
                                        <!-- NUMERO, COMPLEMENTO BAIRRO, CIDADE, ESTADO -->
                                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                                            <div class="col-12 col-sm-6 my-2">
                                                <label for="numero">
                                                    <h5>Número: <b class="text-danger">*</b></h5>
                                                </label>
                                                <input class="form-control" type="text" name="numero" id="numero" value="<?= $row['num_end_cliente'] ?>" size="5" required />
                                            </div>
                                            <div class="col-12 col-sm-5 my-2">
                                                <label for="complemento">
                                                    <h5>Complemento:</h5>
                                                </label>
                                                <input class="form-control" type="text" name="complemento" id="complemento" value="<?= $row['comple_end_cliente'] ?>" size="5" />
                                            </div>
                                            <div class="col-12 my-2">
                                                <label for="bairro">
                                                    <h5>Bairro: <b class="text-danger">*</b></h5>
                                                </label>
                                                <input class="form-control" type="text" name="bairro" id="bairro" value="<?= $row['bairro_end_cliente'] ?>" maxlength="25" />
                                            </div>
                                            <div class="col-12 my-2">
                                                <label for="cidade">
                                                    <h5>Cidade: <b class="text-danger">*</b></h5>
                                                </label>
                                                <input class="form-control" type="text" name="cidade" id="cidade" value="<?= $row['cidade_end_cliente'] ?>" size="25" />
                                            </div>
                                            <div class="col-12 my-2">
                                                <label for="estado">
                                                    <h5>Estado: <b class="text-danger">*</b></h5>
                                                </label>
                                                <select class="form-select" name="estado" id="estado">
                                                    <option value="<?= $row['uf_end_cliente'] ?>"><?= $row['uf_end_cliente'] ?></option>
                                                    <option value="AC">Acre</option>
                                                    <option value="AL">Alagoas</option>
                                                    <option value="AP">Amapá</option>
                                                    <option value="AM">Amazonas</option>
                                                    <option value="BA">Bahia</option>
                                                    <option value="CE">Ceará</option>
                                                    <option value="DF">Distrito Federal</option>
                                                    <option value="ES">Espírito Santo</option>
                                                    <option value="GO">Goiás</option>
                                                    <option value="MA">Maranhão</option>
                                                    <option value="MT">Mato Grosso</option>
                                                    <option value="MS">Mato Grosso do Sul</option>
                                                    <option value="MG">Minas Gerais</option>
                                                    <option value="PA">Pará</option>
                                                    <option value="PB">Paraíba</option>
                                                    <option value="PR">Paraná</option>
                                                    <option value="PE">Pernambuco</option>
                                                    <option value="PI">Piauí</option>
                                                    <option value="RJ">Rio de Janeiro</option>
                                                    <option value="RN">Rio Grande do Norte</option>
                                                    <option value="RS">Rio Grande do Sul</option>
                                                    <option value="RO">Rondônia</option>
                                                    <option value="RR">Roraima</option>
                                                    <option value="SC">Santa Catarina</option>
                                                    <option value="SP">São Paulo</option>
                                                    <option value="SE">Sergipe</option>
                                                    <option value="TO">Tocantins</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="col-12 justify-content-center d-flex flex-wrap pt-4 ps-2">

                                            <button class="btn btn-success m-2 col-12 col-sm-6 col-md-4 py-2" onclick="confirmacao()" type="submit" id="salvar">
                                                <i class="fa-solid fa-check"></i>
                                                Salvar Dados
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>




                <?php
                    } while ($row = mysqli_fetch_assoc($result));
                };
                ?>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto">
        <div class="container text-center text-black-50">
            <p>Todos os direitos reservados &copy; 2023&nbsp;|&nbsp;Desenvolvido por <strong><a href="https://linkedin.com/in/lyonwitt" target="_blank" class="text-decoration-none text-black-50">Witt Dev - Soluções Web</a></strong></p>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="../js/form.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
    function mascaraMutuario(o, f) {
        v_obj = o
        v_fun = f
        setTimeout('execmascara()', 1)
    }
    
    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }
    
    function cpfCnpj(v) {
    
        //Remove tudo o que não é dígito
        v = v.replace(/\D/g, "")
    
        if (v.length <= 11) { //CPF
    
            //Coloca um ponto entre o terceiro e o quarto dígitos
            v = v.replace(/(\d{3})(\d)/, "$1.$2")
    
            //Coloca um ponto entre o terceiro e o quarto dígitos
            //de novo (para o segundo bloco de números)
            v = v.replace(/(\d{3})(\d)/, "$1.$2")
    
            //Coloca um hífen entre o terceiro e o quarto dígitos
            v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
    
        } else if (v.length > 11 & v.length == 14) { //CNPJ
    
            //Coloca ponto entre o segundo e o terceiro dígitos
            v = v.replace(/^(\d{2})(\d)/, "$1.$2")
    
            //Coloca ponto entre o quinto e o sexto dígitos
            v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")
    
            //Coloca uma barra entre o oitavo e o nono dígitos
            v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")
    
            //Coloca um hífen depois do bloco de quatro dígitos
            v = v.replace(/(\d{4})(\d)/, "$1-$2")
    
        }
    
        return v
    
    }
    
    function Cep(v) {
    
        //Remove tudo o que não é dígito
        v = v.replace(/\D/g, "")
    
        if (v.length <= 8) {
            //Coloca um hífen entre o terceiro e o quarto dígitos
            v = v.replace(/(\d{5})(\d{1,2})/, "$1-$2")
    
        }
    
        return v
    
    }
    
    
    // ENDEREÇO AUTOMATICO PELO CEP //
    $("#cep").focusout(function () {
        $.ajax({
            url: 'https://cdn.apicep.com/file/apicep/' + $(this).val() + '.json',
    
            dataType: 'json',
    
            success: function (resposta) {
                $("#logradouro").val(resposta.address);
                $("#bairro").val(resposta.district);
                $("#cidade").val(resposta.city);
                $("#estado").val(resposta.state);
    
                $("#numero").focus();
            }
        });
    });
    </script>
</body>

</html>