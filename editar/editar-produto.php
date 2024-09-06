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
  $valorCompra = $_POST["valorCompra"];
  $valorVenda = $_POST["valorVenda"];
  $fornecedor = $_POST["fornecedor"];
  $cor = $_POST["cor"];
  $medidas = $_POST["medidas"];

  $sql = "UPDATE produtos SET nome='$nome', valor_compra='$valorCompra', valor_venda='$valorVenda', fornecedor='$fornecedor', cor='$cor', medidas='$medidas' WHERE id='$id'";

  if (mysqli_query($connect, $sql)) {
    echo "Produto atualizado com sucesso";
    header("Location: cadastro-produtos.php");
    exit();
  } else {
    echo "Erro ao atualizar o produto: " . mysqli_error($connect);
  }
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $sql = "SELECT * FROM produtos WHERE id='$id'";
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
  <title>Editar Produto</title>
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

      <label for="nome">Nome do Produto:</label>
      <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required>

      <label for="valorCompra">Valor de Compra:</label>
      <input type="number" id="valorCompra" name="valorCompra" step="0.01" value="<?php echo $row['valor_compra']; ?>" required>

      <label for="valorVenda">Valor de Venda:</label>
      <input type="number" id="valorVenda" name="valorVenda" step="0.01" value="<?php echo $row['valor_venda']; ?>" required>

      <label for="fornecedor">Nome do Fornecedor:</label>
      <input type="text" id="fornecedor" name="fornecedor" value="<?php echo $row['fornecedor']; ?>" required>

      <label for="cor">Cor do Produto:</label>
      <input type="text" id="cor" name="cor" value="<?php echo $row['cor']; ?>" required>

      <label for="medidas">Medidas do Produto:</label>
      <input type="text" id="medidas" name="medidas" value="<?php echo $row['medidas']; ?>" required>

      <label for="imagem">Imagem do Produto:</label>
      <input type="image" id="imagem" name="imagem" value="<?php echo $row['imagem']; ?>" required>

      <input type="submit" value="Atualizar Produto" class="btn-submit">
    </form>

  </div>
</body>
</html>

