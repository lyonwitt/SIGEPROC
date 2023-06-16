<?php
// Inicia sessões
session_start();

// Verifica se existe os dados da sessão de login
if(isset($_SESSION['username']) && isset($_SESSION['id'])) {
    echo "<script>location.href='../pages/me';</script>";
}
?>