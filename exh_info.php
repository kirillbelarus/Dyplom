<!doctype html>
<html lang="en">
  <head>
  	<title>exh_info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="page.css">
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

	<div class="section-item">
		<?php
			session_start(); 
			if (isset($_POST['call'])){
                $id = $_POST['call'];
				setcookie("id_afish_cookie",$id, time()+ 3600, "/");
				// $_SESSION["id_afish"]=
            }
            else{
                $id = $_COOKIE["id_afish_cookie"];
            }
			$link = mysqli_connect("localhost", "root", "", "course",3306);
			
			if ($result = mysqli_query($link, "SELECT Afisha.num_afish as num_afish,Afisha.photo as photo,Afisha.id_museum as id_museum, Afisha.name_afish as name_afish, Afisha.type_event as type_event, Afisha.data_start as data_start, Afisha.data_end as data_end, Catalog_Museum.name_museum as name_museum  from Afisha inner join Catalog_Museum on Afisha.id_museum=Catalog_Museum.id_museum where '$id' = num_afish")) 
			{
				while( $row = mysqli_fetch_assoc($result) )
				{
					echo "<div class='item__container'>";
                        echo "<img src='$row[photo]' class='item__img'/>";
                        echo "<div class='item__info'>";
                        //make important
							echo "<div class='item__info-block'>";
								echo "<p>Мероприятие:<b>$row[name_afish]</b></p>";
								echo "<p>Тип мероприятия: <b>$row[type_event]</b></p>";
								echo "<p>Дата начала мероприятия: <b>$row[data_start]</b></p>";
								echo "<p>Дата окончания мероприятия: <b>$row[data_end]</b></p>";
								// $_SESSION['id_museum_exh'] = $row['id_museum'];
								echo "<form action='museum_info.php' method='POST'>";
									$_SESSION['id_museum'] = "$row[id_museum]";
									echo "<p>Название музея: <a href='museum_info.php' class='link_museum' value='$row[id_museum]' name='id_museum'><b>$row[name_museum]</b></a></p>";
								echo "</form>";
								if(isset($_COOKIE['user']))
								{
									if($_COOKIE["user"]==1)
									{
										echo "<form action='buyticket_afisha.php' method='POST'>";
										$_SESSION["num_afish"]="$row[num_afish]";
										echo "<button class='btn btn-info' value='$row[num_afish]' name='purchase'>Купить билет</button>";
										echo "</form>";
									}
								}
								
							echo "</div>";
							echo "<a class='item__btn' href='main.php'>Назад</a>";
						echo "</div>";
                    echo "</div>";
					
				}
			mysqli_free_result($result);
			}
			mysqli_close($link);
		?>
	</div>
	<form action="add_comment.php" method='post'>
			<?php 
				echo "<div class='block_comment'>";
					echo "<div class='rating' id='rates' name='block'>";
						echo "<input class='input_star' value='5'  type='radio' id='1' name='rating'>";
						echo "<label class='label_star' for='1'>☆</label>";

						echo "<input class='input_star'  value='4' type='radio' id='2' name='rating'>";
						echo "<label class='label_star' for='2'>☆</label>";

						echo "<input class='input_star' value='3'  type='radio' id='3' name='rating'>";
						echo "<label class='label_star' for='3'>☆</label>";

						echo "<input class='input_star' value='2' type='radio' id='4' name='rating'>";
						echo "<label class='label_star' for='4'>☆</label>";

						echo "<input class='input_star' value='1' type='radio' id='5' name='rating'>";
						echo "<label class='label_star' for='5'>☆</label>";
					echo "</div>";
					echo "<br>";
						echo "<textarea type='text' placeholder='message..' name='message'></textarea><br>";
					echo "<br>";
					echo "<input type='submit'>";
				echo "</div>";
				
			?>
	</form>

	<?php 
            // if (isset($_POST['call'])){
            //     $id = $_POST['call'];
            //     // $_SESSION["id_tovar"]="$id_tovar";
            // }
            // else{
            //     $id_tovar = 0;
            // }
			// session_start(); 
        	

            $link2 = mysqli_connect("localhost", "root", "", "course",3306);
            if($result2 = mysqli_query($link2, "SELECT Afisha.num_afish as num_afish, Comments.comment_text as comment_text, Comments.rating as rating, Comments.id_user as id_user, Users.login_user as login_user  FROM Comments inner join Afisha on Comments.num_afish = Afisha.num_afish inner join Users on Users.id_user=Comments.id_user where Afisha.num_afish = $id "))
            {
					
                while( $pow = mysqli_fetch_assoc($result2) )
                {
                    echo "<div class='comment'>";
                        echo "<img src='user.png' width='80px' height='80px'>";
                        echo "<p class='mark_name'><span>$pow[login_user]</span>";
                        if($pow['rating']==1)
                        {
                            echo "<div class='rating'>";
                                echo "<input class='input_star'  type='radio'>";
                                echo "<label class='label_star'>★</label>";
                            echo "</div>";   
                        }
                        if($pow['rating']==2)
                        {
                            echo "<div class='rating'>";
                                echo "<input class='input_star'  type='radio'>";
                                echo "<label class='label_star'>★</label>";

                                echo "<input class='input_star'  type='radio'>";
                                echo "<label class='label_star'>★</label>";
                            echo "</div>";   
                        }
                        if($pow['rating']==3)
                        {
                            echo "<div class='rating'>";
                                echo "<input class='input_star' type='radio'>";
                                echo "<label class='label_star'>★</label>";

                                echo "<input class='input_star'  type='radio'>";
                                echo "<label class='label_star'>★</label>";

                                echo "<input class='input_star' type='radio'>";
                                echo "<label class='label_star'>★</label>";
                            echo "</div>";   
                        }
                        if($pow['rating']==4)
                        {
                            echo "<div class='rating'>";
                                echo "<input class='input_star' type='radio'>";
                                echo "<label class='label_star'>★</label>";

                                echo "<input class='input_star'  type='radio'>";
                                echo "<label class='label_star'>★</label>";

                                echo "<input class='input_star' type='radio'>";
                                echo "<label class='label_star'>★</label>";

                                echo "<input class='input_star'  type='radio'>";
                                echo "<label class='label_star'>★</label>";  
                            echo "</div>";   
                        }
                        if($pow['rating']==5)
                        {
                            echo "<div class='rating'>";
                                echo "<input class='input_star' type='radio'>";
                                echo "<label class='label_star'>★</label>";

                                echo "<input class='input_star' type='radio'>";
                                echo "<label class='label_star'>★</label>";

                                echo "<input class='input_star' type='radio'>";
                                echo "<label class='label_star'>★</label>";

                                echo "<input class='input_star'  type='radio'>";
                                echo "<label class='label_star'>★</label>";

                                echo "<input class='input_star' type='radio'>";
                                echo "<label class='label_star'>★</label>";
                            echo "</div>";   
                        }
                        echo "</p>";
                        echo "<div class='name'><p><span>$pow[comment_text]</span></p></div>";
                    echo "</div>";
                    echo "<br>";
                    echo "<br>";
                    echo "<br>";

					
                }
                mysqli_free_result($result2);
            }
            mysqli_close($link2);
        ?>

	</section>



	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

