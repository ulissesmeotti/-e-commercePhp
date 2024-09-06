<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "ecommerce";

$connect = mysqli_connect($servername, $username, $password, $db_name);

if (!$connect) {
  die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $sql = "DELETE FROM usuario WHERE id='$id'";

  if (mysqli_query($connect, $sql)) {
    echo "Cliente excluído com sucesso";
    header("Location: cadastro-clientes.php");
    exit();
  } else {
    echo "Erro ao excluir o Cliente: " . mysqli_error($connect);
  }
} else {
  echo "ID do Cliente não fornecido";
  exit();
}
?>
