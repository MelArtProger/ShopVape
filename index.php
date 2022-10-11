<?php
session_start();
require "inc.php";
require "func/connect.php";
require "struct/header.php";
require "struct/reclam.php";
?>

<section>
	<div>
		<div class="center wow fadeInDown">
			<h2>Ассортимент Darth Vapor Shop</h2> 
		</div>	
	</div>
</section>

<?php
$STH = $DBH->query('SELECT * from tovar');  
$row=$STH->fetchAll(PDO::FETCH_ASSOC);
foreach ($row as $row1)
echo "<div class='col-md-3' align='center'><table class='row-tovar' cellpadding='30' cellspacing='10'><tr><td><a href='show-tovar.php?idT=".$row1['idT']."'>
<img src='PhotoT/".$row1['photoT']."'style='width:250px; height:250px'><p><div align='center' style='width:250px; height:75px'><h3>".$row1['nazT']."</a>
<div style='width:250px; height:25px;'><p>Цена: ".$row1['priceProd']."<span class='rub'>Р</span></div></div></h3></td></tr></table></div>";
?>

<body>
<div class='footer-text'>
<div class='container'>
<br>
<br>
<h2>
Darth Vapor Shop
</h2>
<h3>На сегодняшний день, электронные сигареты - это не только новая мода, переросшая в целую культуру, но и лучшее средство для тех, кто давно собирается бросить курить. Наш вайп шоп предназначен не только для тех, кто лишь недавно начал вливаться в данную среду, но и для тех, кто уже давно следит за всеми новинками мира электронных сигарет и хочет пополнить свою коллекцию девайсов и жидкостей.<br></h3>
<h2>Девайсы и атомайзеры</h2>
<h3>В нашем магазине электронных сигарет представлен широкий выбор различных девайсов, предназначенных для парения. Среди них вы сможете найти как популярные батарейные моды, к которым необходимо докупить атомайзер, так и целый комплект, уже готовый к использованию. Сотрудники нашего магазина всегда готовы помочь вам с выбором, если вы не знаете, какое именно устройство стоит купить новичку. Продвинутым вэйперам мы можем предложить отличный выбор среди плат, баков и девайсов, который порадует любого покупателя, зашедшего на наш интернет магазин.<br>
<br>
Покупателю стоит заранее задуматься о размерах его будущего девайса, о доступной мощности и автономности в использовании. Также, если вы не собираетесь покупать уже готовый комплект, то не стоит забывать о важном выборе между баком и дрипкой. Если вы стремитесь к более автономному и удобному варианту, то стоит обратить внимание на бак. В случае, если вам важнее иметь больше пара и вкуса, и вы готовы пожертвовать автономностью и удобством, то ваш выбор - это дрипка. Однако, вы всегда можете проконсультироваться с сотрудниками нашего магазина, которые готовы ответить на любой вопрос покупателя.<br>
</h3>
<h2>Аксессуары</h2>
<h3>Помимо самого девайса, каждый обладатель электронный сигареты должен иметь целый ряд аксессуаров, которые также представлены в нашем интернет магазине:<br>
<br>
<p>-Испарители или проволоку с ватой для спиралей</p>
<p>-Инструменты</p>
<p>-Зарядные устройства для аккумуляторов</p>
<p>-Дриптип</p>
</h3>
<h2>Жидкости</h2>
<h3>Специальные жидкости для парения - это обязательный атрибут любого владельца электронной сигареты. Именно в них определяется количество никотина, потребляемого вэйпером и вкус пара. В нашем вайп шопе вы сможете выбрать именно ту жидкость, которая порадует ваши вкусовые рецепторы, а благодаря различному процентному соотношению компонентов и никотина, сможете регулировать потребление никотина, постепенно снижая его. <br>
<br>
Электронные сигареты, купить которые вы сможете в нашем вайп шопе порадуют любого, кто действительно хочет бросить курить, а широкий выбор девайсов, комплектующих, жидкостей и низкая цена значительно облегчат эту задачу, сделав её приятной для пользователя.<br>
<br>
</h3>
</div>
</div>


    <footer class="footer">
        <div class="container">
			<div class="col-sm-4 col-xs-4">
				<div>
					<a class="navbar-brand" href="index.php"><img align='center' src="images/logo1.png" align='center' alt="logo" style='padding-left: auto;'></a>
				</div>	
			</div>
            <div class="footer-padding">
                <div class="footer-widget-list ">
                    <ul class="address">
                        <h4>
                        <li><span class="fa fa-map-marker"></span> Нижний Новгород </li>
						&nbsp&nbsp&nbsp&nbsp
                        <li><span class="fa fa-phone"></span>+79867688308</li>
						&nbsp&nbsp&nbsp&nbsp
                        <li class="support-link"><span class="fa fa-envelope-o"></span> shopnn@mail.ru</li>
						</h4>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
<a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647; display: none;"><i class="fa fa-arrow-up"></i></a>
</body>
<!--
		<div id="newsletter-popup-conatiner">
            <div id="newsletter-pop-up">
                <div class="subscribe-pop-up">
                    <div class="title-subscribe" align='center'>
                        <h1>Есть ли вам 18 лет?</h1>
                    </div>
					<br>
					<br>
                    <form id="newsletter-form" method="post" action="#">
                        <div class="content-subscribe"> 
                            <div class="actions">
                                <button class="button-subscribe" title="" type="submit">Нет</button>
                            </div>
							<div class="actions">
                                <button class="hide-popup" title="" type="button">Да</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
-->
    <!-- scrollUp JS-->		
<script src="js/scrollUp/jquery.scrollUp.min.js"></script>
<script src="js/scrollUp/jquery.scrollUp.min.js"></script>
<script src="js/scrollUp/jquery.meanmenu.js"></script>	
<script src="js/scrollUp/owl.carousel.min.js"></script>
<script src="js/scrollUp/jquery-price-slider.js"></script>		
<script src="js/scrollUp/main.js"></script>