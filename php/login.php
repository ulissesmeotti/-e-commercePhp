<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecommerce";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $senhaHash = md5($senha);

    $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senhaHash'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: produtos.php");
        exit;
    } else {
        echo "Usuário não encontrado.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <input type="submit" name="btn-entrar" value="Entrar">

        <h3>Ainda não possui cadastro? Faça agora de forma gratuita!</h3>
        <li><a href="cadastrar.php" id="btncadas">Cadastre-se</a></li>
    </form>

</body>

</html>
