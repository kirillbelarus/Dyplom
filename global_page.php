<!doctype html>
<html lang="en">
  <head>
  	<title>Website menu 06</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/style.css">
	</head>
	<body>
	<section class="ftco-section">
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
			<div class="container">
				<a class="navbar-brand" href="main.php">YourMinsk <span>art/beauty</span></a>
				
				<form action="#" class="searchform order-sm-start order-lg-last" method="POST">
					<div class="form-group d-flex">
						<?php 
							if(isset($_POST['search']))
								$value = $_POST['search'];
							else
								$value ="";
								echo "<input type='text' name = 'search' value='$value' class='form-control pl-3' placeholder='Поиск'>";
						?>
						<!-- <input type="text" class="form-control pl-3" placeholder="Search"> -->
						<button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>
					</div>
				</form>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fa fa-bars"></span> Меню
				</button>
				<div class="collapse navbar-collapse" id="ftco-nav">
					<ul class="navbar-nav m-auto">
						<li class="nav-item active"><a href="global_page.php" class="nav-link">Главная</a></li>
						<li class="nav-item"><a href="./main.php" class="nav-link">Афиша</a></li>
						<li class="nav-item"><a href="./museum.php" class="nav-link">Музеи</a></li>
						<li class="nav-item"><a href="./exposition.php" class="nav-link">Выставки</a></li>
						<li class="nav-item"><a href="lecture.php" class="nav-link">Лекции</a></li>
						<?php 
						if(isset($_COOKIE['org']))
							if($_COOKIE["org"] == 1):
							echo "<li class='nav-item '>";
							echo "<a href='add_afisha.php' class='nav-link active'>Добавить афишу</a>";
							echo "</li>";
							echo "<li class='nav-item'>";
							echo "<a href='add_museum.php' class='nav-link'>Добавить музей</a>";
							echo "</li>";
							endif;
						?>	
					</ul>
				</div>
				<li class="nav-item dropdown profile__btn">
					<a class="nav-link" href="personal.php" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
					<div class="dropdown-menu" aria-labelledby="dropdown04">
						<a class="dropdown-item" href="personal.php">Зайти в кабинет</a>
						<a class="dropdown-item" href="exit.php">Выйти</a>
					</div>
				</li>
			</div>
		</nav>
    
		<?php 
			$link = mysqli_connect("localhost", "root", "", "course",3306);

			if ($result = mysqli_query($link, "SELECT id_museum,name_museum, photo from Catalog_Museum")) 
			{
				echo "<div class='container'>";
					echo "<div class='swiper gallery-slider'>";
					
						echo "<div class='swiper-wrapper'>";
							while( $row = mysqli_fetch_assoc($result) )
							{
								echo "<div class='swiper-slide'>
								<img src=$row[photo] alt='1'>
								<p class='swiper-text'>$row[name_museum]</p>
								</div>";
					
							}
						echo "</div>";
						echo "<div class='swiper-button-prev'>";
						echo "<img src='./images/arrow2.png'>";
						echo "</div>";
						echo "<div class='swiper-button-next'>";
						echo "<img src='./images/arrow.png'>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			mysqli_free_result($result);
			}
			mysqli_close($link);
		?>
		<div class="main_information">
			<h1 style='font-weight: bold;text-align:center;margin-top:5%;'>Афиша Минска — Куда сходить в Минске</h1>
			<p class="desc_main">Куда сходить в Минске — достопримечательности, 
				выставки, концерты, театры, шоу, спорт и активный отдых, отдых с детьми. 
				Самые интересные места и события Минска. Куда сходить в Минске зимой и летом, что посмотреть с детьми, 
				какие интересные места есть в окрестностях: парки, музеи, пространства, исторические места и достопримечательности. 
				ТвойМинск — это электронная афиша Минска. Мы знаем куда сходить отдохнуть в Минске туристу и жителю города. 
				У нас вы найдете всю информацию о лучших событиях Минска. Мы лучше всех знаем куда сходить сегодня, завтра или как 
				провести выходные в Минске.</p>
		</div>
		<?php 
			$link2 = mysqli_connect("localhost", "root", "", "course",3306);
			echo "<h1 class='afisha_text'>Афиша</h1>";
			if ($result2 = mysqli_query($link2, "SELECT num_afish, photo from Afisha")) 
			{
				echo "<div class='container-slider'>";
					echo "<div class='swiper afisha-slider'>";
						echo "<div class='swiper-wrapper'>";
					while( $row = mysqli_fetch_assoc($result2) )
					{
						echo "<div class='swiper-slide'><img src=$row[photo] alt='1'></div>";	
					}
						echo "</div>";
						echo "<div class='swiper-button-prev'>";
						echo "<img src='./images/arrow2.png'>";
						echo "</div>";
						echo "<div class='swiper-button-next'>";
						echo "<img src='./images/arrow.png'>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			mysqli_free_result($result2);
			}
			mysqli_close($link2);
		?>
		<div class="main_information">
			<!-- <h1 class="title_main">Афиша Минска — Куда сходить в Минске</h1> -->
			<br>
			<br>

			<?php
				$link3 = mysqli_connect("localhost","root","","course",3306);
				if($result3 = mysqli_query($link3,'SELECT count(num_afish) as num_afish from Afisha'))
				{
					while( $row = mysqli_fetch_assoc($result3) )
					{
						echo "<p class='desc_main'>ТвойМинск — Лучший сайт о самых интересных событиях Минска.
						Мы знаем куда сходить отдохнуть в Минске. Лучшие события, музеи и выставки Минска. 
						События для взрослых и детей, самые интересные места Минска! Мы собираем все интересные события Минска в одном месте.
						Кудамоскоу в курсе $row[num_afish] событий, которые пройдут в Минске.</p>";
					}
					
					mysqli_free_result($result3);
				}
				mysqli_close($link3);
			?>
		</div>

    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script type="module">
    // import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.esm.browser.min.js'

   


</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
	// console.log(document.querySelectorAll(".gallery_slider"));
	const gallery_slider = new Swiper('.gallery-slider', {
    loop: true,
	observer: true,
	observeParents: true,
	observeSlideChildren: true,
    autoplay: {
        delay: 3000,
    },
	navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  	},
    effect: 'fade',
    allowTouchMove: false
    })

	const afisha_slider = new Swiper('.afisha-slider', {
    loop: true,
	slidesPerView:1,
	spaceBetween: 40,
	observer: true,
	observeParents: true,
	observeSlideChildren: true,
	breakpoints: {
    // when window width is >= 320px
    576: {
      slidesPerView: 2,
    //   spaceBetween: 20
    },
    // when window width is >= 480px
    768: {
      slidesPerView: 3,
    //   spaceBetween: 30
    },
    // when window width is >= 640px
    991: {
      slidesPerView: 4,
    //   spaceBetween: 40
    }
  },
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
    })
</script>
</body>
</html>