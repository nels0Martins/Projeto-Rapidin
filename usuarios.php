<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <!-- CSS -->
    <link rel="stylesheet" href="styles/tabela.css">
</head>
<body>
    <!-- Lista --> 
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Email</th>
                <th>Senha</th>
                <th>Deletar</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <!-- Puxar do banco os dados e colocar na tabela --> 
            <?php
            require('./conexao.php');

            $usuarios = crud::Selectdata();

            if (count($usuarios) > 0) {
                foreach ($usuarios as $usuario) {
                    echo '<tr>';
                    foreach ($usuario as $key => $value) {
                        if ($key !== 'id') {
                            echo '<td>' . $value . '</td>';
                        }
                    }

                    echo '<td><a href="deletar.php?id=' . $usuario['id'] . '"><img src="assets/deletar.svg" alt="Clique aqui para deletar!"></a></td>';

                    echo '<td><a href="atualizar.php?id=' . $usuario['id'] . '"><img src="assets/editar.svg" alt="Clique aqui para editar!"></a></td>';

                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Script js -->
    <script>
        alert('Acessando página de administrador!');
    </script>
</body>
</html>
