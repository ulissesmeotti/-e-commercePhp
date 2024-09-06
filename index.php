
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Fones de Ouvidos</title>
</head>
<body>

    <header>
        <a href="#" class="logo"><i class='bx bx-headphone'></i>NEERO</a>

        <ul class="navegação">
            <li><a href="cadastrar.php">Cadastre-se</a></li>
            <a href="home-control.php" class="btn-controle">Controle do Sistema</a>
            <li><a href="avaliacoes.php">Avaliações</a></li>
            <li><a href="login.php">Entre</a></li>
        </ul><!--navegação-->

        <div class="header-icons">
            <a href="carrinho.html">
                <i class="bx bx-cart"></i>
            </a>            
              <div id="menu"><i class='bx bx-menu'></i></div>
        </div><!--header-icons-->
    </header>

    <section class="home">
        <div class="home-img">
            <img src="product1.png" class="one">
        </div><!--home-img-->

        <div class="home-text">

            <h1>Wireless <br> Headphones</h1>
            <h5>The smarter way to listen</h5>
            <h3>$199.00</h3>
            <a href="produtos.php" class="btn">Shop Now</a>
            
        </div><!--home-text-->
    </section><!--home-->


    <div class="main">
        <div class="row">
            <li><img src="main1.png" onclick="slider('product1.png')"></li>
        </div><!--row-->

        <div class="row2">
            <li><img src="main2.png" onclick="slider('product2.png')"></li>
        </div><!--row2-->

        <div class="row3">
            <li><img src="main3.png" onclick="slider('product3.png')"></li>
        </div><!--row3-->
    </div><!--main-->





     
  
    <script>
        function slider (anything){
            document.querySelector ('.one') .src = anything;
        };

       let menu = document.querySelector ('#menu-icon');
       let navbar = document.querySelector ('.navbar');

       menu.onclick = () => {
        menu.classList.toggle ('bx-x');
        navbar.classList.toggle ('open');
       }
    </script>
    
</body>
</html>