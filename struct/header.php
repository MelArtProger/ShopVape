<head>
    <meta charset="utf-8">
    <title>Darth Vapor Shop</title>
	
	<link rel="shortcut icon" href="images/ico/favicon.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css" media="screen">
</head>

<body>
    <div id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-xs-2">
						<ul class="social-share">
                            <li><a href="https://vk.com/temka_of"><i>VK</i></a></li>
                            <li><a href="https://www.instagram.com/temka_official/"><i>Inst</i></a></li>
                        </ul>
						<div class="top-number"><p><h4><i class="fa fa-phone-square">+79867688308</i></h4></p></div>
                    </div>
					<div class="col-sm-4 col-xs-4">
						<div>
							<a class="navbar-brand" href="index.php"><img align='center' src="images/logo.png" align='center' alt="logo" style='padding-left: auto;'></a>
						</div>	
					</div>
					<div class="col-sm-4 col-xs-8" style='padding-left: 135px;'>
						<div class="search">
							<form action='search.php' method='get'>
								<input type="search" name='word' class="search-form" autocomplete="off" placeholder="Search">
								<i type='submit' name='search' class="fa fa-search"></i>
							</form>
						</div>
					</div>
					<div class="col-sm-4 col-xs-8">
						<ul class="header-r-cart">
                            <li><a class="cart" href="show-cart.php">Тележка</a>
                                <div class="mini-cart-content">
                                    <div class="cart-price-list">
                                        <p class="price-amount">
										<div id="cart">
											<?php
											if (isset($_SESSION['summa']))
											echo "<p><h3>Ваш заказ:<span id='summCart'>".$_SESSION['summa']."Р</span>";
											else
											echo "<p>Ваш заказ:<span id='summCart'>0 Р</span>";
											?>
											</p>
										</div>
										<div class="cart-buttons">
                                            <a href="show-cart.php">Оплатить</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
						</ul>
                    </div>
                </div>
            </div>
        </div> 

        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <?php
						$STH = $DBH->query('SELECT * from menu order by idM');  
						$row=$STH->fetchAll(PDO::FETCH_ASSOC);
						foreach ($row as $rowone){
						echo "<li class='dropdown'><a href='catalog.php?idM=".$rowone['idM']."' class='dropdown-toggle'>".$rowone['nazM']."<i class='fa fa-angle-down'></i></a>";
						?>
                        <ul class="dropdown-menu">
                            <?php
							$STH1 = $DBH->prepare('SELECT * from kategory where idM=?');  
							$STH1->execute(array($rowone['idM']));
							$row1=$STH1->fetchAll(PDO::FETCH_ASSOC);
							foreach ($row1 as $rowtwo){
							echo "<li><a href='show-kat.php?idK=".$rowtwo['idK'] . "'>".$rowtwo['nazK']."</a></li>";
							}
							?>
                        </ul>
                        </li>
						<?php
						}
						?>		
					</ul>
                </div>
            </div>
        </nav>
    </div>
</body>

<!--===============SCRIPT=================-->	
<script type="text/javascript" src="js/cart.js"></script> 
<script type="text/javascript" src="js/jquery-2.0.2.min.js"></script>	
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/main.js"></script>
<script src="js/wow.min.js"></script>
<!--	
<script src="js/scrollUp/jquery.meanmenu.js"></script>	
<script src="js/scrollUp/owl.carousel.min.js"></script>	
<script src="js/scrollUp/jquery-price-slider.js"></script>	
<script src="js/scrollUp/jquery.scrollUp.min.js"></script>
<script src="js/scrollUp/menu/jquery.sticky.js"></script>	
<script src="js/scrollUp/main.js"></script>
 id="sticker"
-->