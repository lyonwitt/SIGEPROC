<?php
include ("config.php");

$username = $_POST['username'];
$senha = $_POST['senha'];

$query = sprintf("SELECT id_user, username FROM usuario WHERE username = '$username'");

$result = mysqli_query($conexao, $query) or die("Erro no banco de dados!");

$row = mysqli_fetch_assoc($result);

$total = mysqli_num_rows($result);

$id_user = $row["id_user"];

if($total == 1){
    $query2 = "SELECT pass FROM usuario WHERE pass = '$senha'";
    $result2 = mysqli_query($conexao, $query2);
    $row2 = mysqli_num_rows($result2);

    if($row2 == 1){
        session_start();

        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id_user;

        if ($_SESSION['id'] == 1 ||  $_SESSION['id'] == 2) {
            echo "<script>alert('Logado com sucesso!');</script>";
            header('Location: ../pages/me');
        } elseif ($_SESSION['id'] == 3) {
            echo "<script>alert('Logado com sucesso!');</script>";
            header('Location: ../pages/me');
        }

        
    } else {
        echo "<script>alert('Senha incorreta!');</script>";
        header('Location: ../');
    }
    
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../');
    echo "<script>alert('Algo deu errado. Tente outra vez!');</script>";
}
?>
