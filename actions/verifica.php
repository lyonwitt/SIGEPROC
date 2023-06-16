<?php
// Inicia sessões
session_start();

// Verifica se existe os dados da sessão de login
if(!$_SESSION['username'] && !$_SESSION['id'])
{
echo "<script>alert('Em Nome de Jesus de Cristo de Nazaré, eu orderno que você saia daqui');</script>";
// Usuário não logado! Redireciona para a página de login
header("Location: ../");
exit();
}
?>