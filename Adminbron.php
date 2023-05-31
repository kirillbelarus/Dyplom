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
    <style>
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        
        }
        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }
        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
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

        <form action="" method="POST" style="margin-left:40%; margin-top:100px;">
            <?php
                if(isset($_POST['name_afish']))
                {
                  $value = $_POST['name_afish'];
                }
                else{
                  $value = "";
                }
                echo "<input placeholder='введите название афиши..' name='name_afish' value='$value'/>";  
            ?>
            
            <button type="submit">Поиск</button>
        </form>

    <table border="1" style="width:75%; margin-right:auto; margin-left:auto; margin-top:100px;" class="styled-table">
        <tr>
            <th>название музея</th>
            <th>имя афиши</th>
            <th>почта</th> 
            <th>дата визита</th>
            <th>кол-во человек</th>
            <th>удалить</th> 
        </tr>
        <?php
             $link = mysqli_connect("localhost", "root", "", "course", 3306);
                if(isset($_POST['name_afish']))
                    $sql = "SELECT * FROM Bron inner join Catalog_Museum on Catalog_Museum.id_museum = Bron.id_museum inner join Users on Users.id_user = Bron.id_user inner join Afisha on Afisha.num_afish = Bron.num_afish where name_afish = '$_POST[name_afish]'";
                else
                    $sql = 'SELECT * FROM Bron inner join Catalog_Museum on Catalog_Museum.id_museum = Bron.id_museum inner join Users on Users.id_user = Bron.id_user inner join Afisha on Afisha.num_afish = Bron.num_afish';
                if ($result = mysqli_query($link, $sql))
                {
                  while( $row = mysqli_fetch_assoc($result) )
                  {
                      echo "<tr>";
                      echo "<form action='deletebron.php' method='POST'>";
                      echo "<td>".$row['name_museum']."</td>";
                      echo "<td>".$row['name_afish']."</td>";
                      echo "<td>".$row['e_mail']."</td>";
                      echo "<td>".$row['data_visit']."</td>";
                      echo "<td>".$row['kol_chel']."</td>";
                      echo "<td style='justify-content: center; display:flex;'>"
                        ."<button type='submit' name='id_user' value='".$row['id_user']."'>Удалить</button>"
                        ."</td>";
                      echo "</form>";
                      echo "</tr>";
                  }
                echo '</table>';
                mysqli_free_result($result);
                }
                    
            ?>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>

