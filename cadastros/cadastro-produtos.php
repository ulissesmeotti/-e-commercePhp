<!DOCTYPE html>
<html>
<head>
  <title>Cadastro de Produtos</title>
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
    input[type="file"] {
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
    <h1>Cadastro de Produtos</h1>
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

      $nome = $_POST["nome"];
      $valorCompra = $_POST["valorCompra"];
      $valorVenda = $_POST["valorVenda"];
      $fornecedor = $_POST["fornecedor"];
      $cor = $_POST["cor"];
      $medidas = $_POST["medidas"];

      if ($_FILES["imagem"]["name"]) {
        $target_dir = "imagens/";
        $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["imagem"]["tmp_name"]);
        if ($check === false) {
          $error_message = "O arquivo enviado não é uma imagem.";
          $uploadOk = 0;
        }

        if (file_exists($target_file)) {
          $error_message = "Já existe um arquivo com esse nome.";
          $uploadOk = 0;
        }

        if ($_FILES["imagem"]["size"] > 500000) {
          $error_message = "O arquivo enviado é muito grande. O tamanho máximo permitido é de 500KB.";
          $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
          $error_message = "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
          $uploadOk = 0;
        }

        if ($uploadOk == 1) {
          if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
            $imagem = basename($_FILES["imagem"]["name"]);
          } else {
            $error_message = "Ocorreu um erro ao fazer o upload do arquivo.";
          }
        }
      } else {
        $imagem = ""; 
      }

      if (!isset($error_message)) { 
        $sql = "INSERT INTO produtos (nome, valor_compra, valor_venda, fornecedor, cor, medidas, imagem) 
                VALUES ('$nome', '$valorCompra', '$valorVenda', '$fornecedor', '$cor', '$medidas', '$imagem')";

        if (mysqli_query($connect, $sql)) {
          echo "<p>Produto cadastrado com sucesso!</p>";
        } else {
          echo "Erro ao cadastrar o produto: " . mysqli_error($connect);
        }
      } else {
        echo $error_message; 
      }

      mysqli_close($connect);
    }
    ?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <label for="nome">Nome do Produto:</label>
      <input type="text" id="nome" name="nome" required>

      <label for="valorCompra">Valor de Compra:</label>
      <input type="number" id="valorCompra" name="valorCompra" step="0.01" required>

      <label for="valorVenda">Valor de Venda:</label>
      <input type="number" id="valorVenda" name="valorVenda" step="0.01" required>

      <label for="fornecedor">Nome do Fornecedor:</label>
      <input type="text" id="fornecedor" name="fornecedor" required>

      <label for="cor">Cor do Produto:</label>
      <input type="text" id="cor" name="cor" required>

      <label for="medidas">Medidas do Produto:</label>
      <input type="text" id="medidas" name="medidas" required>

      <label for="imagem">Imagem:</label>
      <input type="file" id="imagem" name="imagem" accept="image/*" required>

      <input type="submit" value="Cadastrar Produto" class="btn-submit">
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

    $sql = "SELECT * FROM produtos";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo "<h2>Produtos Cadastrados</h2>";
      echo "<table>";
      echo "<tr><th>ID</th><th>Nome</th><th>Valor de Compra</th><th>Valor de Venda</th><th>Fornecedor</th><th>Cor</th><th>Medidas</th><th>Imagem</th></tr>";

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["valor_compra"] . "</td>";
        echo "<td>" . $row["valor_venda"] . "</td>";
        echo "<td>" . $row["fornecedor"] . "</td>";
        echo "<td>" . $row["cor"] . "</td>";
        echo "<td>" . $row["medidas"] . "</td>";
        echo "<td><img src='imagens/" . $row["imagem"] . "' width='100'></td>";
        echo '<td><a href="editar-produto.php?id=' . $row["id"] . '">Editar</a> | <a href="excluir-produto.php?id=' . $row["id"] . '">Excluir</a></td>';
        echo "</tr>";
      }

      echo "</table>";
    } else {
      echo "<p>Nenhum produto cadastrado ainda.</p>";
    }

    mysqli_close($connect);
    ?>
  </div>
</body>
</html>
