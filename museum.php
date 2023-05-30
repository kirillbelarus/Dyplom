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
	<div class="grid_exposition">
		
		<?php 
		if(isset($_POST['search'])){
			$sql = "SELECT id_museum, name_museum, adress, e_mail, time_work, photo from Catalog_Museum where name_museum like '%".$_POST['search']."%'";
		}
		else{
			$sql = "SELECT id_museum, name_museum, adress, e_mail, time_work, photo from Catalog_Museum ";
		}
			$link = mysqli_connect("localhost", "root", "", "course",3306);
			if ($result = mysqli_query($link, $sql)) 
			{

				while( $row = mysqli_fetch_assoc($result) )
				{
					echo "<div class='container'>";
						
						echo "<img  class='photo_museum' src='$row[photo]'>";
						echo "<div class='block_info_museum1'>";
							echo "<b>Название музея:</b>";
							echo "$row[name_museum]";
							echo "<br>";
							echo "<b>Адрес музея:</b>";
							echo "$row[adress]";
							echo "<br>";
							echo "<b>Электронная почта:</b>";
							echo "$row[e_mail]";
							echo "<br>";
								echo "<div class='group-of-btns'>";
									if(isset($_COOKIE["user"]))
									{
										if($_COOKIE["user"] == 1){
											// echo "<br>";
											echo "<form action='buyticket.php' method='post'>";
												echo "<button value='$row[id_museum]' name='purchase' class='btn  btn-info'>";
												echo  "Купить билеты";
												echo "</button>";
											echo "</form>";
										}	
									}

									if(isset($_COOKIE["admin"]))
									{
										if($_COOKIE["admin"]==1)
										{
											// echo "<br>";
											echo "<form  action='deletemuseum.php' method='POST'>";
											echo "<button class='btn btn-info' value='$row[id_museum]' name='udal'>Удаление</button>";
											echo "</form>";
										}	
									}
									// echo "<br>";
									echo "<form action='museum_info.php' method='post'>";
										echo "<button value='$row[id_museum]' name='id_museum' id='id_museum'   class='btn btn-info'>";
										echo  "Подробнее";
										echo "</button>";
									echo "</form>";
								echo "</div>";
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

