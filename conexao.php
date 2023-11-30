<?php
class crud
{
    public static function conect()
    {
        try {
            $con = new PDO('mysql:host=localhost; dbname=crudsystem', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $error1) {
            echo 'Alguma coisa deu errado, não foi possível conectar ao seu banco de dados: ' . $error1->getMessage();
        } catch (Exception $error2) {
            echo 'Erro genérico: ' . $error2->getMessage();
        }
    }

    public static function Selectdata()
    {
        $data = array();
        try {
            $p = self::conect()->prepare('SELECT * FROM crudtable');
            $p->execute();
            $data = $p->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            echo 'Erro ao executar a consulta: ' . $error->getMessage();
        }
        return $data;
    }

    public static function delete($id)
    {
        $p = self::conect()->prepare('DELETE FROM crudtable WHERE id=:id');
        $p->bindValue(':id', $id);
        $p->execute();
    }

    public static function getUsuarioById($id)
    {
    $usuario = array();
    try {
        $p = self::conect()->prepare('SELECT * FROM crudtable WHERE id = :id');
        $p->bindValue(':id', $id);
        $p->execute();
        $usuario = $p->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo 'Erro ao obter usuário: ' . $error->getMessage();
    }
    return $usuario;
    }

    public static function update($id, $nome, $sobrenome, $email, $senha)
    {
        try {
            $con = self::conect();
            $query = "UPDATE crudtable SET Nome = :nome, Sobrenome = :sobrenome, Email = :email, Senha = :senha WHERE id = :id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sobrenome', $sobrenome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $error) {
            echo 'Erro ao atualizar usuário: ' . $error->getMessage();
        }
    }

}
?>
