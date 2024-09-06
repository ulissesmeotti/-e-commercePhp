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
  $idade = $_POST["idade"];
  $cargo = $_POST["cargo"];
  $salario = $_POST["salario"];
  $dataNascimento = $_POST["dataNascimento"];

  $sql = "UPDATE funcionarios SET nome='$nome', idade='$idade', cargo='$cargo', salario='$salario', data_nascimento='$dataNascimento' WHERE id='$id'";

  if (mysqli_query($connect, $sql)) {
    echo "Funcionário atualizado com sucesso";
    header("Location: cadastro-funcionarios.php");
    exit();
  } else {
    echo "Erro ao atualizar o funcionário: " . mysqli_error($connect);
  }
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $sql = "SELECT * FROM funcionarios WHERE id='$id'";
  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($result);
} else {
  echo "ID do funcionário não fornecido";
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Funcionário</title>
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
  </style>
</head>
<body>
  <div class="container">
    <h1>Editar Funcionário</h1>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required>

      <label for="idade">Idade:</label>
      <input type="number" id="idade" name="idade" value="<?php echo $row['idade']; ?>" required>

      <label for="cargo">Cargo:</label>
      <input type="text" id="cargo" name="cargo" value="<?php echo $row['cargo']; ?>" required>

      <label for="salario">Salário:</label>
      <input type="number" id="salario" name="salario" step="0.01" value="<?php echo $row['salario']; ?>" required>

      <label for="dataNascimento">Data de Nascimento:</label>
      <input type="date" id="dataNascimento" name="dataNascimento" value="<?php echo $row['data_nascimento']; ?>" required>

      <input type="submit" value="Atualizar Funcionário" class="btn-submit">
    </form>
  </div>
</body>
</html>
