<!doctype html>
<html lang="en">
  <head>
  	<title>Website menu 06</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="page.css">

	</head>
	<body>
	<?php 
		if(isset($_COOKIE["id_afish_cookie"]))
		{
			unset($_COOKIE['id_afish_cookie']);
			setcookie('id_afish_cookie', null, -1, '/');
		}
	?>
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
						<li class="nav-item"><a href="global_page.php" class="nav-link">Главная</a></li>
						<li class="nav-item active"><a href="main.php" class="nav-link">Афиша</a></li>
						<li class="nav-item"><a href="./museum.php" class="nav-link">Музеи</a></li>
						<li class="nav-item"><a href="./exposition.php" class="nav-link">Выставки</a></li>
						<li class="nav-item"><a href="lecture.php" class="nav-link">Лекции</a></li>
						<?php 
						if(isset($_COOKIE["org"]))
						{
							if($_COOKIE["org"] == 1):
							echo "<li class='nav-item '>";
							echo "<a href='add_afisha.php' class='nav-link active'>Добавить афишу</a>";
							echo "</li>";
							echo "<li class='nav-item'>";
							echo "<a href='add_museum.php' class='nav-link'>Добавить музей</a>";
							echo "</li>";
							endif;
						}
							
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

	  <p class="main__header">Афиша</p>
	  <form action="" method="POST" class="main__form">
            <div class="sort_genre">
                <label class='label_sort'>Тип события</label>
                <select name="textbox" id="combobox" class='select_sort'>
                    <option value="">Жанры</option>
                    <option value="художественная">художественная</option>
                    <option value="историческая">историческая</option>
                    <option value="фотография">фотография</option>
                    <option value="книжная">книжная</option>
                    <option value="тематическая">тематическая</option>
                    <option value="этнографическая">этнографическая</option>
                    <option value="персональная">персональная</option>
                    <option value="детям">детям</option>
                </select>
            </div>

            <?php 
				$link2 = mysqli_connect("localhost", "root", "", "course", 3306);
				
				if($result2 = mysqli_query($link2, "SELECT Afisha.num_afish as num_afish, min(Afisha.data_start) as data_start, max(Afisha.data_end) as data_end from Afisha where data_start = (select min(data_start) from Afisha) and data_end = (select max(data_end) from Afisha)"))
				{
					while($object = mysqli_fetch_object($result2))
					{
						echo "<div class='date-picker__container'>";
							echo "<label class='label_sort_data'>Начало даты афиши</label>";
							echo "<input type='date' min='$object->data_start' max='$object->data_end' name='data-start' class='select_sort'>";
						echo "</div>";
						
						echo "<div class='date-picker__container'>";
							echo "<label class='label_sort_data'>Конец даты афиши</label>";
							echo "<input type='date' min='$object->data_start' max='$object->data_end' name='data-end' class='select_sort'>";
						echo "</div>";
					}       
					mysqli_free_result($result2);
				}
				mysqli_close($link2);
				?>
            <div class='free_check'>
                <input type="checkbox" value="value1" name="choice" id="services">
                <label for="services" style='color:black;'>
                    Бесплатно
                </label>
            </div>
            <button type='submit' class='btn btn-secondary'>Применить</button>
        </form>
		<div class="grid_afisha">

			<?php

			$link = mysqli_connect("localhost", "root", "", "course",3306);

			$search = '';
			$check  = '';
			$calendar  = '';
			$choice  = '';
			$array = [];

			if(isset($_POST['search'])) {
				$search = "name_afish like '%".$_POST['search']."%'";
				$array['search'] = $search;
			}
			if(isset($_POST['textbox'])) {
				$check = "Afisha.genre_afisha = '" . $_POST['textbox'] . "'";
				$array['check'] = $check;
			}
			if(isset($_POST['data-start']) && isset($_POST['data-end'])) {
				
				$date_calendar_start = $_POST['data-start'];
				$date_calendar_end = $_POST['data-end'];
				
				$calendar = "data_start<='$date_calendar_start' and data_end>'$date_calendar_end'";
				$array['calendar'] = $calendar;
			}
			if(isset($_POST['choice'])) {
				$choice = 'Afisha.cost_ticket = 0';
				$array['choice'] = $choice;
			}

			$newString = '';
			
			// Массив из параметров 
			// ToDo: придумать способ соеденить эти параметры в одно целое, конечно же разделяя
			// словами 'and' (Прим. param1 and param2 and param3 and ... paramN)
			foreach ($array as $i => $value) {
				if($i != count($array)) {
					$newString = $newString . "$value" . " and ";
				} else {
					$newString = $newString . "$value";
				}
			}
			echo "$newString";
			$sql = "SELECT Afisha.num_afish as num_afish, Afisha.name_afish as name_afish, Afisha.photo as photo, avg(Comments.rating) as avg_rating, Afisha.cost_ticket as cost_ticket FROM Afisha left join Comments on Comments.num_afish = Afisha.num_afish
			where " . $newString . "group by Afisha.name_afish order by avg_rating desc"; // Последний кусок запроса выводить только при наличии хотя бы одного параметра ("group by Afisha.name_afish order by avg_rating desc")

			// echo "$sql"; //Для просмотра всей строки запроса раскоментить

			if ($result = mysqli_query($link, $sql)) 
			{
				while( $row = mysqli_fetch_assoc($result) )
				{
					if($row['avg_rating'] == null)
					{
						$row['avg_rating'] = 0;
					}
					echo "<form action='exh_info.php' class='grid_img' method='post'>";
						echo "<button value='$row[num_afish]' name='call' class='accept_form'>";
							echo "<img src='$row[photo]' width='210' height='300'>";
							// echo "$row[name_afish]";
							// echo "$row[avg_rating]";
							echo "<div class='text_rating'>$row[avg_rating]★</div>";
						echo "</button>";
						// echo "<p style='position:absolute; display:flex; margin-top:335px;'>cost:$row[cost_ticket]</p>";
					echo "</form>";
				}
			mysqli_free_result($result);
			}
			mysqli_close($link);
			?>
</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

