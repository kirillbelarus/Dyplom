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
						<li class="nav-item"><a href="main.php" class="nav-link">Афиша</a></li>
						<li class="nav-item"><a href="./museum.php" class="nav-link">Музеи</a></li>
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
    
    <div class="grid_afisha2 adding-section">
        <?php
            session_start();
            $link = mysqli_connect("localhost", "root", "", "course",3306);
			if(isset($_COOKIE['user_id']))
			{
            	$id_user = $_COOKIE["user_id"];
			}
            if ($result = mysqli_query($link, "SELECT login_user,password_user from Users where id_user = '$id_user'")) 
			{
				while( $row = mysqli_fetch_assoc($result) )
				{
                    $_SESSION["login_user"]="$row[login_user]";
                    $today = date("Y-m-d");
                    $_SESSION["date_submission"] = "$today";
					$_SESSION["password_user"] = "$row[password_user]";
                }
                mysqli_free_result($result);
			}
			mysqli_close($link);
        ?>
        <p>Заявка на организатора</p>
      <form class="adding__afisha" action="./add_request_org.php" method="post">
                <input type="text" placeholder="название музея" class="form-control" name="name_museum">                
                <input type="text" placeholder="адрес" class="form-control" name="adress">
                <input type="text" placeholder="телефон" class="form-control" name="telephone">
                <input type="text" placeholder="время работы" class="form-control" name="time_work">
                             
                <input type="submit" class="btn btn-secondary">
      </form>
    </div>
</section>


<?php if (isset($_GET['success'])) {?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Заявка успешно отправлена',
                    showConfirmButton: true,
                    confirmButtonColor: '#ff7878'
                })
            </script>
    <?php   } ?>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script> 

	</body>
  <script>
</script>
</html>