<!DOCTYPE html>
<html>
<head>
  <title>Cadastro de Funcionários</title>
  <style>
    form {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
    }

    .btn-submit {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
    }

    /* Estilos para a tabela de funcionários */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    .btn-edit, .btn-delete {
      display: inline-block;
      padding: 6px 12px;
      margin-right: 5px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      text-decoration: none;
    }

    /* Estilos gerais */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      margin-bottom: 20px;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Cadastro de Funcionários</h1>

    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "ecommerce";

      $connect = mysqli_connect($servername, $username, $password, $dbname);

      if (!$connect) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
      }

      $nome = $_POST["nome"];
      $idade = $_POST["idade"];
      $cargo = $_POST["cargo"];
      $salario = $_POST["salario"];
      $dataNascimento = $_POST["dataNascimento"];

      $sql = "INSERT INTO funcionarios (nome, idade, cargo, salario, data_nascimento) 
              VALUES ('$nome', '$idade', '$cargo', '$salario', '$dataNascimento')";

      if (mysqli_query($connect, $sql)) {
        echo "<p>Funcionário cadastrado com sucesso!</p>";
      } else {
        echo "Erro ao cadastrar o funcionário: " . mysqli_error($connect);
      }

      mysqli_close($connect);
    }
    ?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required>

      <label for="idade">Idade:</label>
      <input type="number" id="idade" name="idade" required>

      <label for="cargo">Cargo:</label>
      <input type="text" id="cargo" name="cargo" required>

      <label for="salario">Salário:</label>
      <input type="number" id="salario" name="salario" step="0.01" required>

      <label for="dataNascimento">Data de Nascimento:</label>
      <input type="date" id="dataNascimento" name="dataNascimento" required>

      <input type="submit" value="Cadastrar Funcionário" class="btn-submit">
    </form>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecommerce";

    $connect = mysqli_connect($servername, $username, $password, $dbname);

    if (!$connect) {
      die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM funcionarios";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo "<h2>Funcionários Cadastrados</h2>";
      echo "<table>";
      echo "<tr><th>ID</th><th>Nome</th><th>Idade</th><th>Cargo</th><th>Salário</th><th>Data de Nascimento</th><th>Ações</th></tr>";

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["idade"] . "</td>";
        echo "<td>" . $row["cargo"] . "</td>";
        echo "<td>" . $row["salario"] . "</td>";
        echo "<td>" . $row["data_nascimento"] . "</td>";
        echo "<td>";
        echo '<a href="editar-funcionario.php?id=' . $row["id"] . '" class="btn-edit">Editar</a>';
        echo '<a href="excluir-funcionario.php?id=' . $row["id"] . '" class="btn-delete">Excluir</a>';
        echo "</td>";
        echo "</tr>";
      }

      echo "</table>";
    } else {
      echo "<p>Nenhum funcionário cadastrado ainda.</p>";
    }

    mysqli_close($connect);
    ?>
  </div>
</body>
</html>
