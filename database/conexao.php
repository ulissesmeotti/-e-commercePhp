<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "ecommerce";

$connect = mysqli_connect($servername, $username, $password, $db_name);

if(isset($_POST['btn-entrar'])){
    $email= mysqli_escape_string($connect, $_POST['email']);
    $senha= mysqli_escape_string($connect, $_POST['senha']);
    if(empty($email)or empty($senha)){
        echo 'Favor preencher os dados';
    }
    else{
        $sql="select email from usuario where email= '$email'";
        $resultado= mysqli_query($connect, $sql);
        if(mysqli_num_rows($resultado)>0){
            $senha= md5($senha);
            $sql="select * from usuario where email = '$email' and senha = '$senha'";
            $resultado= mysqli_query($connect, $sql);
            if(mysqli_num_rows($resultado)==1){
                $dados= mysqli_fetch_array($resultado);
                $_SESSION['logado']=true;
                $_SESSION["id_usuario"]=$dados['ID'];
                
                header('location:produtos.php');
                
            }
            
            
        }
        else{
            echo"usuario inexistente";
        }
    }
 }
    

if (isset($_POST['btn-cadastrar'])) {
    $email = mysqli_escape_string($connect, $_POST['email']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $telefone = mysqli_escape_string($connect, $_POST['telefone']);
    $endereco = mysqli_escape_string($connect, $_POST['endereco']);
    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    if (empty($email) or empty($senha) or empty($nome) or empty($telefone) or empty($endereco) or empty($cpf)) {
        echo 'Favor preencher os dados';
    } else {
        $sql = "select email from usuario where email= '$email'";
        $resultado = mysqli_query($connect, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            echo "Este nome de usuário já está em uso";
        } else {
            $senha = md5($senha);
            $sql = "INSERT INTO usuario (email, senha, nome, telefone, endereco, cpf) VALUES ('$email', '$senha', '$nome', '$telefone', '$endereco','$cpf')";
            if (mysqli_query($connect, $sql)) {
                echo "Usuário cadastrado com sucesso";
                header('location:index.php');


            } else {
                echo "Erro ao cadastrar o usuário: " . mysqli_error($connect);
            }
        }
    }

}


?>