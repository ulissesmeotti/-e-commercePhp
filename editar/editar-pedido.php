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
    $cliente = $_POST["cliente"];
    $produto = $_POST["produto"];
    $quantidade = $_POST["quantidade"];
    $valor = $_POST["valor"];
    $endereco = $_POST["endereco"];

    $sql = "UPDATE pedido SET cliente='$cliente', produto='$produto', quantidade='$quantidade', valor='$valor', endereco='$endereco' WHERE id='$id'";

    if (mysqli_query($connect, $sql)) {
        echo "Pedido atualizado com sucesso";
        header("Location: cadastro-pedidos.php");
        exit();
    } else {
        echo "Erro ao atualizar o pedido: " . mysqli_error($connect);
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM pedido WHERE id='$id'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "Pedido não encontrado";
        exit();
    }
} else {
    echo "ID do pedido não fornecido";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Pedido</title>
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
    <h1>Editar Pedido</h1>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="cliente">Cliente:</label>
        <input type="text" id="cliente" name="cliente" value="<?php echo $row['cliente']; ?>" required>

        <label for="produto">Produto:</label>
        <input type="text" id="produto" name="produto" value="<?php echo $row['produto']; ?>" required>

        <label for="quantidade">Quantidade:</label>
        <input type="text" id="quantidade" name="quantidade" value="<?php echo $row['quantidade']; ?>" required>

        <label for="valor">Valor:</label>
        <input type="text" id="valor" name="valor" value="<?php echo $row['valor']; ?>" required>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo $row['endereco']; ?>" required>

        <input type="submit" value="Atualizar Pedido" class="btn-submit">
    </form>

</div>
</body>
</html>
