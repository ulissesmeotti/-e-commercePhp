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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $cliente = mysqli_real_escape_string($connect, $_POST['cliente']);
    $produto = mysqli_real_escape_string($connect, $_POST['produto']);
    $quantidade = mysqli_real_escape_string($connect, $_POST['quantidade']);
    $valor = mysqli_real_escape_string($connect, $_POST['valor']);
    $endereco = mysqli_real_escape_string($connect, $_POST['endereco']);

    $sql = "INSERT INTO pedidos (cliente, produto, quantidade, valor, endereco) VALUES ('$cliente', '$produto', '$quantidade', '$valor', '$endereco')";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        $success_message = "Pedido criado com sucesso.";
    } else {
        $error_message = "Erro ao criar o pedido: " . mysqli_error($connect);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $pedido_id = $_POST['pedido_id'];

    $sql = "DELETE FROM pedidos WHERE id = '$pedido_id'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        $success_message = "Pedido excluído com sucesso.";
    } else {
        $error_message = "Erro ao excluir o pedido: " . mysqli_error($connect);
    }
}

$sql = "SELECT * FROM pedidos";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) > 0) {
    $pedidos = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
mysqli_close($connect);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Controle de Pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
        }

        .form-submit {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .pedidos-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pedidos-table th,
        .pedidos-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .pedidos-table th {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
        }

        .action-buttons form {
            display: inline-block;
            margin-right: 5px;
        }

        .action-buttons button {
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Controle de Pedidos</h1>

        <?php if (isset($success_message)) { ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php } ?>

        <?php if (isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>

        <h2>Criar Pedido</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="cliente" class="form-label">Cliente:</label>
            <input type="text" id="cliente" name="cliente" class="form-input" required>

            <label for="produto" class="form-label">Produto:</label>
            <input type="text" id="produto" name="produto" class="form-input" required>

            <label for="quantidade" class="form-label">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" class="form-input" required>

            <label for="valor" class="form-label">Valor:</label>
            <input type="number" id="valor" name="valor" class="form-input" step="0.01" required>

            <label for="endereco" class="form-label">Endereco:</label>
            <input type="text" id="endereco" name="endereco" class="form-input" required>

            <input type="submit" name="submit" value="Criar Pedido" class="form-submit">
        </form>

        <h2>Pedidos</h2>
        <?php if (isset($pedidos)) { ?>
            <table class="pedidos-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                        <th>Endereco</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido) { ?>
                        <tr>
                            <td><?php echo $pedido['id']; ?></td>
                            <td><?php echo $pedido['cliente']; ?></td>
                            <td><?php echo $pedido['produto']; ?></td>
                            <td><?php echo $pedido['quantidade']; ?></td>
                            <td><?php echo $pedido['valor']; ?></td>
                            <td><?php echo $pedido['endereco']; ?></td>
                            <td class="action-buttons">
                                <form method="POST" action="editar-pedido.php">
                                    <input type="hidden" name="pedido_id" value="<?php echo $pedido['id']; ?>">
                                    <button type="submit" name="edit">Editar</button>
                                </form>
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="pedido_id" value="<?php echo $pedido['id']; ?>">
                                    <button type="submit" name="delete">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Nenhum pedido encontrado.</p>
        <?php } ?>
    </div>
</body>
</html>
