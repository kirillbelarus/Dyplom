<!doctype html>
<html lang="en">
  <head>
  	<title>Museum info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,500&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="css/style.css">

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
								echo "<input type='text' name = 'search' value='$value' class='form-control pl-3' placeholder='Search'>";
						?>
						<button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>
					</div>
				</form>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fa fa-bars"></span> Меню
				</button>
				<div class="collapse navbar-collapse" id="ftco-nav">
					<ul class="navbar-nav m-auto">
						<li class="nav-item"><a href="global_page.php" class="nav-link">Главная</a></li>
						<li class="nav-item"><a href="main.php" class="nav-link">Афиша</a></li>
						<li class="nav-item active"><a href="./museum.php" class="nav-link">Музеи</a></li>
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
						<?php 
							// if($_COOKIE["org"] == 1 || $_COOKIE['user'] ==1):
							// 	echo "<a class='dropdown-item' href='registr.php'>Зарегистрироваться</a>";
							// 	echo "<a class='dropdown-item' href='sign.php'>Войти</a>";
							// endif;
							?>	
						
						<a class="dropdown-item" href="exit.php">Выйти</a>
					</div>
				</li>
			</div>
		</nav>


	
		<?php 
            $id_museum = filter_var(trim($_POST['id_museum']),FILTER_SANITIZE_STRING);
            // session_start();
			$link = mysqli_connect("localhost", "root", "", "course",3306);
			// $id_museum = $_SESSION["id_museum"];
           	if ($result = mysqli_query($link, "SELECT id_museum,name_museum, adress, tel,e_mail,time_work,photo from Catalog_Museum where id_museum =$id_museum ")) 
			{
				while( $row = mysqli_fetch_assoc($result) )
				{
					echo "<div class='grid_museum'>";
					echo "<img src='$row[photo]' id='museum_info_photo'>";
					echo "<p class='name_museum'>$row[name_museum]</p>";
							echo "<p class='name_logo_museum' style='color:#250000;'>Мероприятия музея</p>";
							echo "<div class='block_info_museum'>";
							$link2 = mysqli_connect("localhost", "root", "", "course",3306);
									echo "<div class='exh_museum'>";
										if ($result2 = mysqli_query($link2, "SELECT Afisha.num_afish as num_afish, Afisha.photo as photo, Afisha.name_afish as name_afish from Afisha where id_museum = '$id_museum' ")) 
										{
											while( $pow = mysqli_fetch_assoc($result2) )
											{
												echo "<form action='exh_info.php' class='grid_img' method='post'>";
													echo "<button value='$pow[num_afish]' name='call' class='accept_form'>";
														echo "<img src='$pow[photo]' width='210' height='300'>";
														// echo "$row[name_afish]";
													echo "</button>";
												echo "</form>";
											}
										mysqli_free_result($result2);
										}
										// mysqli_close($link2);

									echo "</div>";

									echo "<div class='inf_museum'>";
										echo "<div class='text_info_museum'>";
											echo "<img src='./images/icons/location.png'width='35px' height='35px'>";
											echo "<p style='vertical-align: middle;font-size:20px'>$row[adress]</p>";
										echo "</div>";
											echo "<br>";
										echo "<div class='text_info_museum'>";
											echo "<img style='margin-top:15px;' src='./images/icons/telephone.png' width='25px' height='25px'>";              
											echo "<p>$row[tel]</p>";
										echo "</div>";
											echo "<br>";
										echo "<div class='text_info_museum'>";
											echo "<img style='margin-top:12px;' src='./images/icons/email.png' width='25px' height='25px'>";
											echo "<p>$row[e_mail]</p>";
										echo "</div>";
										if ($result3 = mysqli_query($link2, "SELECT Afisha.num_afish as num_afish, Afisha.photo as photo, max(Comments.rating) as rating,Afisha.name_afish as name_afish 
										from Afisha left join Comments on Comments.num_afish = Afisha.num_afish where rating = (Select max(rating) from Afisha) and id_museum = '$id_museum'")) 
										{
											$kol =0;
											while( $pow = mysqli_fetch_assoc($result3) )
											{

												echo "<form  action='exh_info.php'  method='post'>";
													echo "<button value='$pow[num_afish]' name='call' class='accept_form'>";
														echo "<img src='$pow[photo]' width='250' height='350'>";
														// echo "$row[name_afish]";
													echo "</button>";
												echo "</form>";
											}
										mysqli_free_result($result3);
										}
										mysqli_close($link2);
										
									echo "</div>";
								echo "</div>";
								echo "<div id='map' style='width: 100%; height:500px'></div>";
						echo "</div>";
						$adress = $row['adress'];
						$ch = curl_init('https://geocode-maps.yandex.ru/1.x/?apikey=f454d8d6-5999-4751-944c-fca88ad04479&format=json&geocode=' . urlencode($adress));
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLOPT_HEADER, false);
						$res = curl_exec($ch);
						curl_close($ch);
						
						$res = json_decode($res, true);
						// print_r($res);
						function round_up($value, $places)
						{
							$mult = pow(10, abs($places));
							return $places < 0 ?
							ceil($value / $mult) * $mult :
								ceil($value * $mult) / $mult;
						}
						$coordinates = $res['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
						$coordinates = explode(' ', $coordinates);
						// print_r($coordinates);
						// echo "<br>";
						// print_r($coordinates[0]);
						// echo "<br>";
						// print_r($coordinates[1]);
						// echo "<br>";  
						$first_coord = $coordinates[1];
						$second_coord =$coordinates[0];
						// echo $first_coord;
				}
			// mysqli_free_result($result);
			}
			// mysqli_close($link);
		?>
	
	
</section>


      <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
      <script type="text/javascript">
var coordinator_first = '<?php echo $first_coord;?>';
var coordinator_second = '<?php echo $second_coord;?>';
  ymaps.ready(init);		
  function init() {
    // alert($second_coord);
    // alert("d");
    var myMap = new ymaps.Map("map", {
      center: [coordinator_first,coordinator_second],
      zoom: 18
    }, {
      searchControlProvider: 'yandex#search'
    });
  // console.log($second_coord);
  // console.log('i like');
	var myPlacemark = new ymaps.Placemark([coordinator_first,coordinator_second], {
		iconCaption: 'музей находится здесь'
	}, {
		preset: 'islands#pinkDotIcon'
	});
	myMap.geoObjects.add(myPlacemark)
}
</script>
	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>