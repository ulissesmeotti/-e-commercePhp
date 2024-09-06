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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["id"];
  $nome = $_POST["nome"];
  $comentario = $_POST["comentario"];


  $sql = "UPDATE avaliacoes SET nome='$nome', comentario='$comentario' WHERE id='$id'";

  if (mysqli_query($connect, $sql)) {
    echo "Avaliacao atualizado com sucesso";
    header("Location: cadastro-avaliacoes.php");
    exit();
  } else {
    echo "Erro ao atualizar o Avaliacao: " . mysqli_error($connect);
  }
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $sql = "SELECT * FROM avaliacoes WHERE id='$id'";
  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($result);
} else {
  echo "ID do comentário não fornecido";
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Comentário</title>
  <style>
  body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f4f4f4;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    h1 {
      text-align: center;
    }

    form {
      margin-top: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    .btn-submit {
      display: block;
      width: 100%;
      padding: 10px;
      margin-top: 20px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .btn-submit:hover {
      background-color: #45a049;
    }
  </style>  </style>
</head>
<body>
  <div class="container">
    <h1>Editar Produto</h1>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required>

      <label for="comentario">Comentario:</label>
      <input type="text" id="comentario" name="comentario" value="<?php echo $row['comentario']; ?>" required>

      <input type="submit" value="Atualizar Avaliação" class="btn-submit">
    </form>

  </div>
</body>
</html>

