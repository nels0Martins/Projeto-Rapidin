<?php
require('./conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    crud::delete($id);
    header('Location: usuarios.php');
    exit();
} else {
    echo 'ID não especificado para exclusão.';
}
?>
