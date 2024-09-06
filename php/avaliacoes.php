<!DOCTYPE html>
<html>
<head>
  <title>Comentarios Cadastrados</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      margin-bottom: 20px;
    }

    .product-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .product {
      width: 300px;
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ddd;
    }

    .product img {
      max-width: 100%;
    }

    .product h2 {
      margin-top: 10px;
    }

    .product p {
      margin: 5px 0;
    }
  </style>
</head>
<body>
  <h1>Avaliacoes dos Usuários</h1>
  <div class="product-container">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecommerce";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM avaliacoes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="product">
                <h2><strong>Nome:</strong> <?php echo $row['nome']; ?></h2>
                <p><strong>Comentário:</strong> <?php echo $row['comentario']; ?></p>  
            </div>
            <?php
        }
    } else {
        echo "Nenhum comentario cadastrado.";
    }

    $conn->close();
    ?>
  </div>
</body>
</html>
