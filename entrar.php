<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <!-- CSS -->
    <link rel="stylesheet" href="styles/cadastro.css">
    <link rel="stylesheet" href="styles/entrar.css">
</head>
<body>
    <?php
        require('./conexao.php');

        if(isset($_POST['botaoEntrar'])){
            $_SESSION['validate']=false;
            $nome=$_POST['Nome'];
            $senha=$_POST['Senha'];

            $p = crud::conect()->prepare('SELECT * FROM crudtable WHERE Nome = :n AND Senha = :p');
            $p->bindValue(':n', $nome);
            $p->bindValue(':p', $senha);
            $p->execute();
            $p->fetch(PDO::FETCH_ASSOC);

            if($p->rowCount()>0){
                $_SESSION['Nome']= $nome;
                $_SESSION['Senha']= $senha;
                $_SESSION['validate']= true; 
                header('location:sucesso.php');

            } else {
                echo 'Certifique-se de que você está registrado!'; 
            }

        }
    ?>

    <div class="formulario">
        <div class="titulo">
            <p>Crie sua Conta</p>
        </div>
        <form action="" method="post">
            <input type="text" name="Nome" placeholder="Nome">
            <input type="text" name="Senha" placeholder="Senha">
            <input type="submit" value="Entrar" name="botaoEntrar">
        </form>
    </div>

    <script>
            alert('Entre na sua conta!');
    </script>
</body>
</html>