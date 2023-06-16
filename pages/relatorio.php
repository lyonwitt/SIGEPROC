<?php
include('../actions/verifica.php');
$id_user = $_SESSION['id'];

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
        <!-- RELATORIO -->
        <div class="card m-3">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                Gere o seu relatório mensal
                <i class="fa-solid fa-circle-info"></i>
            </h5>
            <div class="card-body" id="buttons_serv">
                <div class="d-flex flex-wrap justify-content-between col-12">

                    <div class="d-flex flex-wrap">
                        <form class="input-group m-2" method="post" action="../actions/gerar_relatorio" target="_blank">
                            <select class="form-select" aria-label="Selecione o mês" id="mes_ref" name="mes_ref">
                                <option selected disabled>Mês</option>
                                <option>Janeiro</option>
                                <option>Fevereiro</option>
                                <option>Março</option>
                                <option>Abril</option>
                                <option>Maio</option>
                                <option>Junho</option>
                                <option>Julho</option>
                                <option>Agosto</option>
                                <option>Setembro</option>
                                <option>Outubro</option>
                                <option>Novembro</option>
                                <option>Dezembro</option>
                            </select>
                            <select class="form-select" aria-label="Selecione o ano" id="ano_ref" name="ano_ref">
                                <option selected disabled>Ano</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                                <option>2026</option>
                            </select>
                            <button class="btn border-0 btn-success rounded-end d-flex align-items-center" type="submit">
                                <h6 class="my-0">Gerar Relatório</h6>
                            </button>
                        </form>
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