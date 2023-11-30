<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <!-- CSS -->
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/cadastro.css">
</head>
<body>
    <?php 
        require('./conexao.php');

        if(isset($_POST['botaoCriarConta'])){
            $nome=$_POST['Nome'];
            $sobrenome=$_POST['Sobrenome'];
            $email=$_POST['Email'];
            $senha=$_POST['Senha'];
            $confiSenha=$_POST['confiSenha'];
           
            if(!empty($_POST['Nome']) && !empty($_POST['Sobrenome'])  && !empty($_POST['Email']) && !empty($_POST['Senha']))
            {
                if($senha == $confiSenha)
                {
                    $p=crud::conect()->prepare('INSERT INTO crudtable(Nome,Sobrenome, Email, Senha) VALUES(:n, :l, :e, :p)');
                    $p->bindValue(':n', $nome);
                    $p->bindValue(':l', $sobrenome);
                    $p->bindValue(':e', $email);
                    $p->bindValue(':p', $senha);
                    $p->execute();

                    echo 'Tivemos sucesso!';

                } else {
                    echo 'As senhas não são iguais!';
                }

                $_SESSION['Nome']= $nome;
                $_SESSION['Senha']= $senha;
                $_SESSION['validate']= true; 
                header('location:entrar.php');
            }
        }

    ?>
    <div class="formulario">

        <div class="titulo">
            <p>Crie sua Conta</p>
        </div>

        <form action="" method="post">
            <input type="text" name="Nome" placeholder="Nome">
            <input type="text" name="Sobrenome" placeholder="Sobrenome">
            <input type="email" name="Email" placeholder="Email">
            <input type="password" name="Senha" placeholder="Senha">
            <input type="password" name="confiSenha" placeholder="Confirme a senha">
            <input type="submit" value="Enviar" name="botaoCriarConta">

        </form>
    </div>

</body>
</html>