<!doctype html>
<html lang="en">
  <head>
  	<title>buy ticket</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


	<div class="grid_ticket_afisha">
        <h1 class="name_ticket">Покупка билета афиши</h1>
        <form action="add_ticket_afisha.php"  class="form__container" method="POST"> 
            <?php
            session_start();
            $link = mysqli_connect("localhost", "root", "", "course", 3306);
            if(isset($_POST['purchase'])){
                $id = $_POST["purchase"];
            }
            else{
                $id = 0;
            }
            if(isset($_SESSION["num_afish"]))
            {
                // echo "$_SESSION['num_afish']";
                $num_afish = $_SESSION["num_afish"];
                // echo "$num_afish";
            }
                if($query = mysqli_query($link, "SELECT Afisha.num_afish as num_afish,Afisha.name_afish as name_afish,Afisha.data_start as data_start,
                Afisha.data_end as data_end,Afisha.photo as photo,Afisha.cost_ticket as cost_ticket from Afisha where num_afish = '$id'"))
                { 
                    while( $row = mysqli_fetch_assoc($query) )
                    {
                        echo "<img src='$row[photo]' class='photo_ticket'>";
                        echo "<div class='box'>";
                            // echo "$row[num_afish]";
                            echo "<p>Название мероприятия: $row[name_afish]</p>";
                            echo "<p>Стоимость одного билета: $row[cost_ticket]р</p>";
                            // echo "<p>Стоимость одного билета: $row[cost_ticket]*р</p>";
                            echo "<input type='text' placeholder='кол-во билетов' id='kol_ticket' name='kol_ticket' class='form-control value='''> ";
                            echo "<input type='text' placeholder='введите время' name='time_bron' class='form-control'>";
                            if($result = mysqli_query($link, "SELECT Afisha.data_start as data_start, Afisha.data_end as data_end FROM Afisha where num_afish = '$num_afish'"))
                            {
                                while($object = mysqli_fetch_object($result))
                                {
                                    // echo "<option id='select_afish' value='$object->num_afish'>$object->name_afish</option>"; 
                                    echo "<input type='date' min='$object->data_start' max='$object->data_end' name='data_event' class='form-control'>";
                                }       
                            }   
                            echo "<select name='textbox' id='combobox' class='form-control'>";
                            echo "    <option value=''>Нужен ли гид?</option>";
                            echo "    <option value='yes'>Да</option>";
                            echo "    <option value='net'>Нет</option>";
                            echo "</select>";
                            // echo "<h4 id='sum' style='text-align: center;'>Общая сумма заказа: ".$row['totalSum']."р.</h4>";
                            echo "<input type='submit' class='btn btn-info'>";
                        echo "</div>";
                    }
                    
                    mysqli_free_result($query);
                }
            ?>
        </form>
	</div>
    
	</section>

    <?php if (isset($_GET['success'])) {?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Регистрация билета прошла успешна',
                    showConfirmButton: true,
                    confirmButtonColor: '#ff7878'
                })
            </script>
    <?php   } ?>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

