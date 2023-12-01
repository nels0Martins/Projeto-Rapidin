<!-- script de atualização com uso do objeto update() --> 
<?php
require('./conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['botaoAtualizar'])) {
        $nome = $_POST['Nome'];
        $sobrenome = $_POST['Sobrenome'];
        $email = $_POST['Email'];
        $senha = $_POST['Senha'];
        $confiSenha = $_POST['confiSenha'];

        crud::update($id, $nome, $sobrenome, $email, $senha);

        header('Location: usuarios.php');
        exit();
    } else {

        $usuario = crud::getUsuarioById($id);

        if ($usuario) {
            ?>

            <!-- Formulario de atualização da conta -->
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Atualizar Usuário</title>
                <!-- CSS -->
                <link rel="stylesheet" href="styles/cadastro.css">
            </head>
            <body>
                <div class="formulario">
                    <div class="titulo">
                        <p>Atualize sua Conta</p>
                    </div>
                    <form action="" method="post">
                        <input type="text" name="Nome" value="<?php echo isset($usuario['nome']) ? $usuario['nome'] : ''; ?>" placeholder="Nome" required>
                        <input type="text" name="Sobrenome" value="<?php echo isset($usuario['sobrenome']) ? $usuario['sobrenome'] : ''; ?>" placeholder="Sobrenome" required>
                        <input type="email" name="Email" value="<?php echo isset($usuario['email']) ? $usuario['email'] : ''; ?>" placeholder="Email" required>
                        <input type="password" name="Senha" placeholder="Nova Senha">
                        <input type="password" name="confiSenha" placeholder="Confirme a nova senha">
                        <input type="submit" value="Atualizar" name="botaoAtualizar">
                    </form>
                </div>
            </body>
            </html>
            <!-- Condições -->
            <?php
        } else {
            echo 'Usuário não encontrado.';
        }
    }
} else {
    echo 'ID não especificado para atualização.';
}
?>
