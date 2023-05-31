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
      <form action="" method="POST">
            <input type='date' name='data_start2' value='' class='form-control adding__date-start'/>
            <br>
            <button type="submit" class="btn btn-secondary">Ввести дату</button>
      </form>
      <form class="adding__afisha" enctype="multipart/form-data" action="./add2_afisha.php" method="post">
        <?php 
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
        ?>
        
        <?php 
              if(isset($_POST['data_start2']))
              {
                $min_value = $_POST['data_start2'];
                echo "<input type='date' name='data_end' min='$min_value' class='form-control adding__date-end'>";
              }
              else
              {
                echo "input first date";
              }
                ?>
                <input type="text" placeholder="название афиши" class="form-control" name="name_afish">
                <input type="text" placeholder="введите цену" class="form-control" name="cost_ticket">
    
                <div class="upload-file-container">
                  <img id="image" src="#" alt="" />						
                  <div class="upload-file-container-text">
                    <span>Добавить фото</span>
                      <input type="file" name="pic" id="pic" size="25" />
                  </div>
                </div>	
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
                
                <input type="submit"  value="Upload" class="btn btn-secondary">
      </form>
    </div>
</section>


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

	<!-- <script src="js/jquery.min.js"></script> -->
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script> 

	</body>
  <script>
    document.getElementById('first_data').disabled = true;
  // $(document).on('change', '[type="date"]', function (e) {
  //   console.log(this.value);
  // });

   $(document).on('ready', function(){
  function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgInput").change(function(){
    readURL(this);
  });
});

    bannerImage = document.getElementById('bannerImg');
    imgData = getBase64Image(bannerImage);
    localStorage.setItem("imgData", imgData);

    function getBase64Image(img) {
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;

    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);

    var dataURL = canvas.toDataURL("image/png");

    return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
}

</script>
</html>