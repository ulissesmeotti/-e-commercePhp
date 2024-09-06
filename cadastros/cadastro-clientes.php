<!DOCTYPE html>
<html>
<head>
  <title>Cadastro de Clientes</title>
  <style>
 form {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="number"] {
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
    }  </style>
</head>
<body>
  <div class="container">
    <h1>Cadastro de Clientes</h1>
    
    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $servername = "localhost";
      $username = "root";
      $password = "";
      $db_name = "ecommerce";
      
      $connect = mysqli_connect($servername, $username, $password, $db_name);
      
      if (!$connect) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
      }
      $email = $_POST["email"];
      $senha = $_POST["senha"];
      $telefone = $_POST["telefone"];
      $endereco = $_POST["endereco"];
      $cpf = $_POST["cpf"];
      
      $sql = "INSERT INTO usuario (email, senha, telefone, endereco, cpf) 
              VALUES ('$email', '$senha', '$telefone', '$endereco', '$cpf')";
      
      if (mysqli_query($connect, $sql)) {
        echo "<p>Cliente cadastrado com sucesso!</p>";
      } else {
        echo "Erro ao cadastrar o Cliente: " . mysqli_error($connect);
      }
      mysqli_close($connect);
    }
    ?>
    
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="email">Email do Cliente:</label>
      <input type="email" id="email" name="email" required>
      
      <label for="senha">Senha do Cliente:</label>
      <input type="number" id="senha" name="senha" required>
      
      <label for="telefone">Telefone do Cliente:</label>
      <input type="number" id="telefone" name="telefone" required>
      
      <label for="endereco">Endereco do Cliente:</label>
      <input type="text" id="endereco" name="endereco" required>
      
      <label for="cpf">Cpf do Cliente:</label>
      <input type="number" id="cpf" name="cpf" required>

      <input type="submit" value="Cadastrar Cliente" class="btn-submit">
    </form>
    
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "ecommerce";

    $connect = mysqli_connect($servername, $username, $password, $db_name);

    if (!$connect) {
      die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM usuario";
    $result = mysqli_query($connect, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      echo "<h2> Clientes Cadastrados</h2>";
      echo "<table>";
      echo "<tr><th>ID</th><th>Email</th><th>Senha</th><th>Telefone</th><th>Endereco</th><th>Cpf</th></tr>";
      
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["senha"] . "</td>";
        echo "<td>" . $row["telefone"] . "</td>";
        echo "<td>" . $row["endereco"] . "</td>";
        echo "<td>" . $row["cpf"] . "</td>";
        echo '<td><a href="editar-cliente.php?id=' . $row["id"] . '">Editar</a> | <a href="excluir-cliente.php?id=' . $row["id"] . '">Excluir</a></td>';
        echo "</tr>";
      }
      
      echo "</table>";
    } else {
      echo "<p>Nenhum cliente cadastrado ainda.</p>";
    }
    
    mysqli_close($connect);
    ?>
  </div>
</body>

