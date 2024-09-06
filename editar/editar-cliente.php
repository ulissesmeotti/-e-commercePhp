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
  $email = $_POST["email"];
  $senha = $_POST["senha"];
  $telefone = $_POST["telefone"];
  $endereco = $_POST["endereco"];
  $cpf = $_POST["cpf"];

  $sql = "UPDATE usuario SET email='$email', senha='$senha', telefone='$telefone', endereco='$endereco', cpf='$cpf' WHERE id='$id'";

  if (mysqli_query($connect, $sql)) {
    echo "Cliente atualizado com sucesso";
    header("Location: cadastro-clientes.php");
    exit();
  } else {
    echo "Erro ao atualizar o cliente: " . mysqli_error($connect);
  }
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $sql = "SELECT * FROM usuario WHERE id='$id'";
  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($result);
} else {
  echo "ID do produto não fornecido";
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Cliente</title>
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
    <h1>Editar Cliente</h1>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <label for="email">Email do Cliente:</label>
      <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>

      <label for="senha">Senha do Cliente:</label>
      <input type="number" id="senha" name="senha" value="<?php echo $row['senha']; ?>" required>

      <label for="telefone">Telefone do Cliente:</label>
      <input type="number" id="telefone" name="telefone" value="<?php echo $row['telefone']; ?>" required>

      <label for="endereco">Endereco do Cliente:</label>
      <input type="text" id="endereco" name="endereco" value="<?php echo $row['endereco']; ?>" required>

      <label for="cpf">Cpf do Cliente:</label>
      <input type="number" id="cpf" name="cpf" value="<?php echo $row['cpf']; ?>" required>

      <input type="submit" value="Atualizar Cliente" class="btn-submit">
    </form>

  </div>
</body>
</html>

