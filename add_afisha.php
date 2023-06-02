<!doctype html>
<html lang="en">
  <head>
  	<title>add</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,500&display=swap" rel="stylesheet">

	 <link rel="stylesheet" href="css/style.css"> 
  <link rel="stylesheet" href="3.css">


	</head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<body>
	<section class="ftco-section">
    <nav class="navbar navbar-expand-lg navbar-dark ftco_nаavbar bg-dark ftco-navbar-light" id="ftco-navbar">
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
							echo "<li class='nav-item active'>";
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

    <div class="grid_afisha2 adding-section">
      <!-- <form action="" method="POST">
            <input type='date' name='data_start2' value='' class='form-control adding__date-start'/>
            <br>
            <button type="submit" class="btn btn-secondary">Ввести дату</button>
      </form> -->
      
      <form class="adding__afisha" enctype="multipart/form-data" action="./add2_afisha.php" method="post">
        <?php 
        session_start();
       
          $link = mysqli_connect("localhost", "root", "", "course",3306);
            if($result = mysqli_query($link, "SELECT id_museum, name_museum FROM Catalog_Museum"))
            {
              echo '<div class="box">';
              echo '<select class="form-control" name="ID">'; 
              echo '<option value="">Выберите музей</option>';
                while($object = mysqli_fetch_object($result))
                {
                  echo "<option value='$object->id_museum'>$object->name_museum</option>"; 
                }
              echo '</select>';
              echo '</div>';
              mysqli_free_result($result);
            }
            $today = date("Y-m-d");
            echo "<div class='date-picker__container'>";
            echo "<label class='label_sort_data'>Начало даты афиши</label>";
            echo "<input type='date' min='$today' name='data-start' class='select_sort'>";
            
          echo "</div>";
            
          echo "<div class='date-picker__container'>";
            echo "<label class='label_sort_data'>Конец даты афиши</label>";
            echo "<input type='date' min='$today' name='data-end' class='select_sort'>";
          echo "</div>";
            $calendar  = '';
            $array = [];
            if(isset($_POST['data-start']) && isset($_POST['data-end']) && $_POST['data-end'] != '' && $_POST['data-start'] != '') {
              $date_calendar_start = $_POST['data-start'];
              $date_calendar_end = $_POST['data-end'];
              
              
              // $_SESSION['data-end'] = $date_calendar_end;
              $calendar = "data_start<='$date_calendar_start' and data_end>'$date_calendar_end'";
              $array['calendar'] = $calendar;
            }
            
              // if(isset($_POST['data_start2']))
              // {
              //   $min_value = $_POST['data_start2'];
              //   echo "<input type='date' name='data_end' min='$min_value' class='form-control adding__date-end'>";
              // }
              // else
              // {
              //   echo "input first date";
              // }

              $newString = '';
              $i = 1;
            
              foreach ($array as &$value) {
                if($i != count($array)) {
                $newString = $newString . $value . " and ";
                } else {
                $newString = $newString . $value . " ";
                }
            
                $i++;
              }
              unset($value);
            
              $where = ' ';
            
              if($newString != '') {
                $where = ' where ';
              }
              echo "x";
              // echo "$array['calenda']";
              echo "$newString";
                ?>
                <input type="text" placeholder="название афиши" class="form-control" name="name_afish">
                <input type="text" placeholder="введите цену" class="form-control" name="cost_ticket">
    
                <img id="image" src="#" alt="" />						
                <input type="file" name="pic" id="pic" size="25" />
                <select name="combo_type" class="form-control" id="combo_type">
                    <option value="">выберите тип афиши:</option>
                    <option value="лекция">лекция</option>
                    <option value="выставка">выставка</option>
                </select>
                <select name="combo_genre" class="form-control" id="combo_genre">
                    <option value="">выберите жанр афиши:</option>
                    <option value="художественная">художественная</option>
                    <option value="историческая">историческая</option>
                    <option value="фотография">фотография</option>
                    <option value="книжная">книжная</option>
                    <option value="тематическая">тематическая</option>
                    <option value="этнографическая">этнографическая</option>
                    <option value="персональная">персональная</option>
                    <option value="детям">детям</option>
                </select>
                
                <input type="submit"  value="Загрузить" class="btn btn-secondary">
      </form>
    </div>
</section>
<?php if (isset($_GET['unsuccess'])) {?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Дата окончания меньше даты начала!',
                    showConfirmButton: true,
                    confirmButtonColor: '#ff0000'
                })
            </script>
    <?php   } ?>

<?php if (isset($_GET['success'])) {?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Афиша успешно добавлена ',
                    showConfirmButton: true,
                    confirmButtonColor: '#ff7878'
                })
            </script>
    <?php   } ?>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script> 

	</body>
</html>