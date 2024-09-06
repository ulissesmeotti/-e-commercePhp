<!DOCTYPE html>
<html>
<head>
  <title>Produtos Cadastrados</title>
  <p>Clique em "Avaliações" para ver as avaliacoes do nosso site</p><a href="avaliacoes.php" class="title-button">Avaliações</a>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    .title-button {
      margin-left: 10px;
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
  <h1>Produtos Cadastrados</h1>
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

    $sql = "SELECT * FROM produtos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="product">
                <img src="imagens/<?php echo $row['imagem']; ?>" alt="<?php echo $row['nome']; ?>">
                <h2><?php echo $row['nome']; ?></h2>
                <p><strong>Valor de Venda:</strong> R$ <?php echo $row['valor_venda']; ?></p>
                <p><strong>Cor:</strong> <?php echo $row['cor']; ?></p>
                <p><strong>Medidas:</strong> <?php echo $row['medidas']; ?></p>
                <a href="checkout.html?produto=<?php echo urlencode($row['nome']); ?>&valor=<?php echo urlencode($row['valor_venda']); ?>">Comprar</a>
            </div>
            <?php
        }
    } else {
        echo "Nenhum produto cadastrado.";
    }

    $conn->close();
    ?>
  </div>
</body>
</html>
