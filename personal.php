<!doctype html>
<html lang="en">
  <head>
  	<title>Website menu 06</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">  -->
	<!-- new bootstrap -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	
	<link rel="stylesheet" href="css/style.css">
	<style>
		.form-control:focus {
          box-shadow: none;
          border-color: #BA68C8
      }

      .profile-button {
          background: rgb(99, 39, 120);
          box-shadow: none;
          border: none
      }

      .profile-button:hover {
          background: #682773
      }

      .profile-button:focus {
          background: #682773;
          box-shadow: none
      }

      .profile-button:active {
          background: #682773;
          box-shadow: none
      }

      .back:hover {
          color: #682773;
          cursor: pointer
      }

      .labels {
          font-size: 11px
      }

      .add-experience:hover {
          background: #BA68C8;
          color: #fff;
          cursor: pointer;
          border: solid 1px #BA68C8
      }
	  .a.button{
        -webkit-appearance: button;
        -moz-appearance: button;
        appearance: button;
        text-decoration: none;
        color: initial;
    	} 
	</style>
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
					<li class="nav-item dropdown profile__btn active">
						<a class="nav-link" href="personal.php" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
						<div class="dropdown-menu" aria-labelledby="dropdown04">
							<a class="dropdown-item" href="personal.php">Зайти в кабинет</a>
							
							<a class="dropdown-item" href="exit.php">Выйти</a>
						</div>
					</li>
				</div>
			</nav>
	  <p class="main__header">Личный кабинет</p>
    
	  <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center  py-1">
                <!-- <img class="rounded-circle mt-5" width="150px" height="200px" src="user.png"> -->
					<?php 
					if(isset($_COOKIE["user"]))
					{
						if(isset($_COOKIE["user_email"]))
						{
							if($_COOKIE["user"] ==1):
								$user_email = $_COOKIE["user_email"];
								echo "<span class='font-weight-bold'>Пользователь</span><span class='text-black-50'>$user_email</span>";
							endif;
						}
						
					}
					?>
					<?php 
					if(isset($_COOKIE["org"])){
						if(isset($_COOKIE["org_email"]))
						{
							$org_email = $_COOKIE["org_email"];
							if($_COOKIE["org"] ==1):
								echo "<span class='font-weight-bold'>Организатор</span><span class='text-black-50'>$org_email</span>";
							endif;
						}
					}
					
					?>
					<?php 
					if(isset($_COOKIE["admin"])){
						if($_COOKIE["admin"]==1)
					{
						echo "<span class='font-weight-bold'>Администратор</span>";
					}
					}
					?>
            	</div>
				<div class="col-md-5 border-right">
						<div class="p-3 py-5">
							<div class="d-flex justify-content-between align-items-center mb-3">
								<h4 class="text-right">Profile Settings</h4>
							</div>
							<form action="correct_data.php" method="POST">
								<div class="row mt-2">
				<?php 
				
				if(isset($_COOKIE["user"]))
				{
					if($_COOKIE['user']==1){
						if(isset($_COOKIE['user_id']))
						{
							$id_user = $_COOKIE['user_id'];
							$link = mysqli_connect("localhost", "root", "", "course", 3306);
							if($result = mysqli_query($link, "SELECT Users.id_user as id_user,Users.e_mail as e_mail, Users.login_user as login_user, Users.password_user as password_user from Users where id_user = $id_user"))
							{
								while($row = mysqli_fetch_assoc($result))
								{
										 echo "<div class='input_profile'><label class='labels'>ФИО(логин)</label><input type='text' class='form-control' placeholder='$row[login_user]' value='' name='login'></div>";
										echo "<div class='input_profile'><label class='labels'>E_mail</label><input type='text' class='form-control' value='' placeholder='$row[e_mail]' pattern='^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$' name='e_mail'></div>";
										echo "<div class='input_profile'><label class='labels'>password</label><input type='text' class='form-control' placeholder='$row[password_user]' value='' name='pass'></div>";
								}       
								mysqli_free_result($result);
							}
							mysqli_close($link);
						}
					}
					
				}
				?>
								</div>
							
									<!-- <div class="input_profile"><label class="labels">ФИО(логин)</label><input type="text" class="form-control" placeholder="login" value="" name="login"></div>
									<div class="input_profile"><label class="labels" >E_mail</label><input type="text" class="form-control" value="" placeholder="e_mail" pattern="^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" name="e_mail"></div>
									<div class="input_profile"><label class="labels">password</label><input type="text" class="form-control" placeholder="password" value="" name="pass"></div> -->
								
								<!-- <div class="row mt-3"> -->
								<!-- </div> -->
								
								<div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
							</form>
							
						</div>
					</div>
					<div class="col-md-4">
						<div class="p-3 py-5">
							<div class="col-md-12"> 
								<?php 
								if(isset($_COOKIE["admin"]))
								{
									if($_COOKIE["admin"] ==1):
										echo "<a class='border px-3 p-1 add-experience' href='Adminbron.php'>Таблица бронирований</a>";
										echo " &nbsp;";
										echo " &nbsp;";
										echo "<a class='border px-3 p-1 add-experience' href='Adminafisha.php'>Таблица афиш</a>";
										echo " &nbsp;";
										echo " &nbsp;";
										echo "<a class='border px-3 p-1 add-experience' href='AdminRequest.php'>Таблица заявок</a>";
										echo " &nbsp;";
										echo " &nbsp;";
										echo "<a class='border px-3 p-1 add-experience' href='AdminMuseum.php'>Таблица музеев</a>";
										echo " &nbsp;";
										echo " &nbsp;";
										echo "<a class='border px-3 p-1 add-experience' href='AdminComment.php'>Таблица комментариев</a>";
										echo " &nbsp;";
										echo " &nbsp;";
										echo "<a class='border px-3 p-1 add-experience' href='AdminUsers.php'>Таблица пользователей</a>";
										// <a href="turnir.php" class="button">Go to Google</a>
									endif;
								}
								
								?>
								<?php
								if(isset($_COOKIE['user']))
								{
									if($_COOKIE["user"] ==1):
										// echo "<span class='border px-3 p-1 add-experience' onclick='document.location='Adminbron.php''>Посмотреть брони</span>";
										echo "<a class='border px-3 p-1 add-experience' href='afisha_info_user.php'>Посмотреть свои брони</a>";
										echo " &nbsp;";
										echo "<a class='border px-3 p-1 add-experience' href='request_org_user.php'>Подать заявку на организатора</a>";
										echo " &nbsp;";
									endif;
								}
								
								?>
								<?php
								if(isset($_COOKIE["org"]))
								{
									if($_COOKIE["org"] ==1):
										echo "<a class='border px-3 p-1 add-experience' href='afisha_info_org.php'>Посмотреть свои афиши</a>";
										echo " &nbsp;";
									endif;
								}
								
								?>
							</div> 
							<br>
						</div>
					</div>
        	</div>
    	</div>
		

	</section>
	<?php if (isset($_GET['input_data'])) {?>
					<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
					<script>
						Swal.fire({
							icon: 'error',
							title: 'Данные не заполнены корректно',
							showConfirmButton: true,
							confirmButtonColor: '#ff0000'
						})
					</script>
			<?php   } ?>

		<?php if (isset($_GET['unsuccessed'])) {?>
					<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
					<script>
						Swal.fire({
							icon: 'error',
							title: 'Логин уже используется',
							showConfirmButton: true,
							confirmButtonColor: '#ff0000'
						})
					</script>
			<?php   } ?>

		<?php if (isset($_GET['unsuccess'])) {?>
				<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
				<script>
					Swal.fire({
						icon: 'error',
						title: 'Электронная почта уже используется',
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
							title: 'Данные успешно изменены',
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