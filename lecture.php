<!doctype html>
<html lang="en">
  <head>
  	<title>Лекции</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
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
						<li class="nav-item"><a href="./museum.php" class="nav-link">Музеи</a></li>
						<li class="nav-item"><a href="./exposition.php" class="nav-link">Выставки</a></li>
						<li class="nav-item active"><a href="lecture.php" class="nav-link">Лекции</a></li>
						<?php 
						if(isset($_COOKIE['org']))
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


	  <p class="main__header" style='color:#250000;'>Лекции</p>
	<div class="grid_exposition">
		<?php 
			session_start();
			$link = mysqli_connect("localhost", "root", "", "course",3306);
			if(isset($_POST['search'])){
				$sql = "SELECT Afisha.num_afish as num_afish, Afisha.name_afish as name_afish, Afisha.photo as photo, Afisha.genre_afisha as genre, avg(Comments.rating) as rating, 
				Afisha.cost_ticket as cost_ticket,Afisha.data_start as data_start,Afisha.data_end as data_end 
				FROM Afisha left join Comments on Comments.num_afish = Afisha.num_afish where type_event = 'лекция' and name_afish like '%".$_POST['search']."%'";
				
			}
			else{
				$sql = "SELECT Afisha.num_afish as num_afish,avg(Comments.rating) as rating,Afisha.genre_afisha as genre,Afisha.data_start as data_start,Afisha.data_end as data_end,Afisha.photo as photo, Afisha.name_afish as name_afish, Catalog_Museum.id_museum 
				from Afisha inner join Catalog_Museum on Afisha.id_museum = Catalog_Museum.id_museum left join Comments on Comments.num_afish = Afisha.num_afish
				where type_event = 'лекция' group by num_afish";
			}
			if ($result = mysqli_query($link, $sql)) 
			{
				while( $row = mysqli_fetch_assoc($result) )
				{
					echo "<form action='exh_info.php' class='grid_img' method='post'>";
						echo "<button value='$row[num_afish]' name='call' class='accept_form'>";
							echo "<img src='$row[photo]' width='210' height='300'>";
							// echo "$row[name_afish]";
						echo "</button>";
                        echo "<div class='exposition-group'>";
						echo "<div class='info__exposition'>";
							echo "<p style='color:#250000;'><b>Название афиши:</b> $row[name_afish]</p>";
							if($row['rating']>0)
							{
								echo "<p style='color:#250000;'><b>Рейтинг афиши:</b>  $row[rating]</p>";
							}
							else
								echo "<p style='color:#250000;'><b>Рейтинг афиши:</b> 0</p>";
							echo "<p style='color:#250000;'><b>Жанр афиши:</b>  $row[genre]</p>";
							echo "<p style='color:#250000;'><b>Дата проведения: </b> ".$row["data_start"]." – ".$row["data_end"]."</p>";
						echo "</div>";
                            echo "<div class='group-of-btns'>";
							echo "</form>";
							if(isset($_COOKIE["admin"]))
							{
								if($_COOKIE["admin"]==1)
								{
									echo "<form action='deleteexposition.php' method='POST'>";
									echo "<button class='btn btn-info' value='$row[num_afish]' name='udal'>Удаление</button>";
									echo "</form>";
								}
								
							}
							if(isset($_COOKIE["user"]))
							{
								if($_COOKIE["user"]==1)
								{
									echo "<form action='buyticket_afisha.php' method='POST'>";
									$_SESSION["num_afish"]="$row[num_afish]";
									echo "<button class='btn btn-info' value='$row[num_afish]' name='purchase'>Купить билет</button>";
									echo "</form>";
								}
								
							}
							echo "<form action='exh_info.php' method='POST'>";
							echo "<button class='btn btn-info' value='$row[num_afish]' name='call'>Просмотр информации</button>";
							echo "</form>";
                            echo "</div>";
						
                    echo "</div>";
					
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

