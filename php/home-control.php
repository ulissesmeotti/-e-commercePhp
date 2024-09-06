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

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM login_home WHERE login = '$login' AND senha = '$senha'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['logged_in'] = true;
        header('Location: home-control.html');
        exit();
    } else {
        $error_message = "Login ou senha inválidos.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Acesso Administrativo</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f2f2f2;
            color: black;
        }

        h1 {
            text-align: center;
            color: black;

        }

        .error {
            color: red;
        }

        .login-form label {
            display: block;
            margin-bottom: 10px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
        }

        .login-form .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Acesso Administrativo</h1>

        <?php if (isset($error_message)) { ?>
            <p class="error">
                <?php echo $error_message; ?>
            </p>
        <?php } ?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login-form">
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <input type="submit" value="Acessar" class="btn-submit">
        </form>
    </div>
</body>

</html>