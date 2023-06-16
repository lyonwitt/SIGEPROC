<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>SIGEPROC - Sistema de Gerenciamento de Produção Capilar</title><!-- FONTAWESOME -->
    <link rel="stylesheet" href="font-awesome/css/all.css">
    <link rel="shortcut icon" href="font-awesome/svgs/solid/gears.svg" type="image/x-icon">
    <!-- FONTES -->
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Open+Sans:wght@300;400;500;600;700&family=Roboto:wght@100;300;400;500;700&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body class="login">
    <header class="text-login w-100 pt-4 px-2">
        <h2 class="text-muted text-center mb-5">SIGEPROC - Sistema de Gerenciamento de Produção Capilar</h2>
    </header>
    <section class="conteudo d-flex justify-content-center align-items-center flex-column">
        <div class="area-login px-3 pt-4">
            <h4 class="text-white mb-4 text-center">Área de Login</h4>
            <form method="post" action="actions/login.php">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user text-muted"></i></span>
                    <input type="text" class="form-control" placeholder="Digite o seu usuário" name="username" id="username" aria-label="Usuário"
                        aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock text-muted"></i></span>
                    <input type="password" class="form-control form-control" placeholder="Digite a sua senha" name="senha" id="senha" aria-label="Senha"
                        aria-describedby="basic-addon1">
                </div>
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <h6 class="col-8"><a href="pages/esqueceu_senha.php"
                            class="text-white text-decoration-none">Esqueceu a senha?</a></h6>
                    <button type="submit" name="entrar" class="btn btn-primary col-4">Entrar</button>
                </div>
            </form>
        </div>
    </section>
    <footer class="footer position-absolute bottom-0 w-100">
        <div class="container text-center text-muted">
            <p>Todos os direitos reservados &copy; 2023&nbsp;|&nbsp;Desenvolvido por <strong><a href="https://linkedin.com/in/lyonwitt" target="_blank" class="text-decoration-none text-secondary">Witt Dev - Soluções Web</a></strong></p>
        </div>
    </footer>
</body>

</html>