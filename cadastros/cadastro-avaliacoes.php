<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$connect = mysqli_connect($servername, $username, $password, $dbname);
if (!$connect) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

function getAvaliacoes($connect) {
    $sql = "SELECT * FROM avaliacoes";
    $result = mysqli_query($connect, $sql);
    return $result;
}

function adicionarAvaliacao($connect, $nome, $comentario) {
    $nome = mysqli_real_escape_string($connect, $nome);
    $comentario = mysqli_real_escape_string($connect, $comentario);
    $sql = "INSERT INTO avaliacoes (nome, comentario) VALUES ('$nome', '$comentario')";
    $result = mysqli_query($connect, $sql);
    return $result;
}

function excluirAvaliacao($connect, $id) {
    $sql = "DELETE FROM avaliacoes WHERE id = '$id'";
    $result = mysqli_query($connect, $sql);
    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["adicionar"])) {
    $nome = $_POST["nome"];
    $comentario = $_POST["comentario"];
    adicionarAvaliacao($connect, $nome, $comentario);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["excluir"])) {
    $id = $_POST["excluir"];
    excluirAvaliacao($connect, $id);
}

$avaliacoes = getAvaliacoes($connect);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Avaliações dos Clientes</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    header {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
    
    section {
      padding: 20px;
    }
    
    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      grid-gap: 20px;
    }
    
    .avaliacao {
      border: 1px solid #ddd;
      padding: 20px;
    }
    
    .avaliacao h3 {
      margin-top: 0;
    }
    
    .avaliacao p {
      margin-bottom: 0;
      word-wrap: break-word;
    }
    
    .form-container {
      margin-bottom: 20px;
    }
    
    .form-container label {
      display: block;
      margin-bottom: 10px;
    }
    
    .form-container input[type="text"],
    .form-container textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
    }
    
    .form-container input[type="submit"] {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <header>
    <h1>Avaliações dos Clientes</h1>
  </header>

  <section>
    <div class="form-container">
      <h2>Adicionar Avaliação</h2>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="avaliacao-form">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="comentario">Comentário:</label>
        <textarea id="comentario" name="comentario" required></textarea>

        <input type="submit" value="Adicionar" name="adicionar">
      </form>
    </div>

    <h2>Avaliações dos Clientes</h2>
    <div class="grid-container">
      <?php while ($row = mysqli_fetch_assoc($avaliacoes)) { ?>
        <div class="avaliacao">
          <h3><?php echo $row["nome"]; ?></h3>
          <p><?php echo $row["comentario"]; ?></p>
          <a href="editar-avaliacao.php?id=<?php echo $row['id']; ?>">Editar</a>
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="avaliacao-form">
            <input type="hidden" name="excluir" value="<?php echo $row["id"]; ?>">
            <input type="submit" value="Excluir">
          </form>
        </div>
      <?php } ?>
    </div>
  </section>
</body>
</html>
