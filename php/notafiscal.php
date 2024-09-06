<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nota Fiscal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }
        
        p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <h1>Nota Fiscal</h1>
    <?php
    $notaFiscal = urldecode($_GET['nota']);
    $produto = isset($_GET['produto']) ? urldecode($_GET['produto']) : '';
    $valor = isset($_GET['valor_venda']) ? urldecode($_GET['valor_venda']) : '';
    $metodopagamento = isset($_GET['metodopagamento']) ? urldecode($_GET['metodopagamento']) : '';

    if (!empty($notaFiscal)) {
        echo "<p>Método de pagamento: $metodopagamento</p>";
        echo "<p>Produto: $produto</p>";
        echo "<p>Valor: $valor</p>";
        echo "<h2>Informações Pessoais:</h2>";
        echo "<pre>$notaFiscal</pre>";
    } else {
        echo "<p>Não há informações para exibir.</p>";
    }
    ?>
</body>

</html>
