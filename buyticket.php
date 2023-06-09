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


	<div class="grid_ticket_afisha">
    <h1 class="name_ticket">Покупка билета в музей</h1>
    <!-- <p class='name_afisha'>xren</p> -->
    <form action="add_buy.php"  class="form__container" method="POST">
      <!-- <form action="./add_buy.php" id="orderForm" method="post">  -->
        <!-- <img src='./images/back_museum.png' class="photo_ticket"> -->
        <?php

            session_start();
            $link = mysqli_connect("localhost", "root", "", "course", 3306);
            if(isset($_POST['purchase'])){
            $id = $_POST["purchase"];
            setcookie('id_museum',$id, time() + 3600,"/");
            }
            else{
                // $id = 0;
            }
            if(isset($_SESSION["museum_id"]))
            {
                $museum_id = $_SESSION["museum_id"];
                
            }
            if(isset($id))
            {
                $arrFull = Array();

                if($query = mysqli_query($link, "SELECT Afisha.num_afish as num_afish, Afisha.name_afish as name_afish, Afisha.cost_ticket as cost_ticket, Afisha.photo as photo, Afisha.id_museum as id_museum 
                FROM Afisha inner join Catalog_Museum where $id= Afisha.id_museum group by Afisha.num_afish"))
                {
                    while($object = mysqli_fetch_assoc($query)) {
                        $_SESSION["museum_id"]="$object[id_museum]";
                        $_SESSION["new_num_afish"] = $object['num_afish'];
                        $arr_info = array(
                            "num" => "$object[num_afish]",
                            "photo" => "$object[photo]",
                            "name_duck" => "$object[name_afish]",
                            "cost" => "$object[cost_ticket]",
                        );
    
                        array_push($arrFull, $arr_info);
    
                        // echo "<p>Название мероприятия:<span class='name_afisha'>$object[name_afish]</span></p>";
    
                    }
                }


                if($query = mysqli_query($link, "SELECT Afisha.num_afish as num_afish, Afisha.name_afish as name_afish, Afisha.cost_ticket as cost_ticket, Afisha.photo as photo, Afisha.id_museum as id_museum 
                FROM Afisha inner join Catalog_Museum where $id= Afisha.id_museum group by Afisha.num_afish limit 1"))
                { 
                    
                    while($pow = mysqli_fetch_assoc($query))
                    {
                        
                        //   mysqli_free_result($query);
                        echo "<img src='$pow[photo]' class='photo_ticket' alt='$pow[name_afish]'>";
                        echo '<div class="box">';
                        
                            echo "<p>Название мероприятия:<span class='name_afisha'>$pow[name_afish]</span></p>";
                            echo "<p>Стоимость одного билета: <span class='cost-ticket'>$pow[cost_ticket]</span>р</p>";
                                echo '<select class="combobox_select form-control" name="ch">'; 
                                    echo '<option value="">Выберите мероприятия</option>';
                                    if($result = mysqli_query($link, "SELECT Afisha.num_afish as num_afish, Afisha.name_afish as name_afish, Afisha.photo as photo, Afisha.data_start as data_start, Afisha.data_end as data_end, Afisha.cost_ticket as cost_ticket, Afisha.id_museum as id_museum FROM Afisha inner join Catalog_Museum  where '$id'= Afisha.id_museum group by Afisha.num_afish"))
                                    {   
                                        
                                        while($object = mysqli_fetch_object($result))
                                        {
                                            

                                            echo "<option id='select_afish' value='$object->num_afish'>$object->name_afish</option>"; 
                                            // echo "<input type='date' min='$object->data_start' max='$object->data_end' name='data_event' class='form-control'>";
                                        }
                                    }
                                echo '</select>';
                                    if($result = mysqli_query($link, "SELECT Afisha.num_afish as num_afish, Afisha.name_afish as name_afish, Afisha.photo as photo, Afisha.data_start as data_start, Afisha.data_end as data_end FROM Afisha inner join Catalog_Museum  where '$id'= Afisha.id_museum group by Afisha.id_museum"))
                                    {
                                        while($object = mysqli_fetch_object($result))
                                        {
                                            // echo "<option id='select_afish' value='$object->num_afish'>$object->name_afish</option>"; 
                                            echo "<input type='date' min='$object->data_start' max='$object->data_end' name='data_event' class='form-control'>";
                                        }       
                                    }
                                    echo "<input type='text' placeholder='кол-во билетов' id='kol_ticket' name='kol_ticket' class='form-control'>";
                                    echo "<input type='text' placeholder='введите время' name='time_bron' class='form-control'>";
                                echo "<select name='textbox' id='combobox' class='form-control'>";
                                    echo "<option value=''>Нужен ли гид?</option>";
                                    echo "<option value='yes'>Да</option>";
                                    echo "<option value='net'>Нет</option>";
                                echo "</select>";
                                echo "<h4 id='sum' style='text-align: center;'>Общая сумма заказа: <span id='total-sum'></span>р.</h4>";
                                    echo "<input type='submit' class='btn btn-secondary'>";
                            echo '</div>';
                    }
                }
            }
        else{

            if($query = mysqli_query($link, "SELECT Afisha.num_afish as num_afish, Afisha.name_afish as name_afish, Afisha.cost_ticket as cost_ticket, Afisha.photo as photo, Afisha.id_museum as id_museum 
            FROM Afisha inner join Catalog_Museum  where '$_COOKIE[id_museum]'= Afisha.id_museum group by Afisha.num_afish"))
            { 
                $arrFull = Array();
                while( $row = mysqli_fetch_assoc($query) )
                {
                  
                    $_SESSION["museum_id"]="$row[id_museum]";
                    $_SESSION["new_num_afish"] = $row['num_afish'];
                    $arr_info = array(
                        "num" => "$row[num_afish]",
                        "photo" => "$row[photo]",
                        "name_duck" => "$row[name_afish]",
                        "cost" => "$row[cost_ticket]",
                    );
                    array_push($arrFull, $arr_info);
                } 
            }

            if($query = mysqli_query($link, "SELECT Afisha.num_afish as num_afish, Afisha.name_afish as name_afish, Afisha.cost_ticket as cost_ticket, Afisha.photo as photo, Afisha.id_museum as id_museum 
            FROM Afisha inner join Catalog_Museum  where '$_COOKIE[id_museum]'= Afisha.id_museum group by Afisha.num_afish limit 1"))
            { 
                while($pow = mysqli_fetch_assoc($query))
                {
                  
                //   mysqli_free_result($query);
                
                    echo '<div class="box">';
                        echo "<p class='name_afisha'>Название мероприятия:$pow[name_afish]</p>";
                        echo "<p>Стоимость одного билета: <span class='cost-ticket'>$pow[cost_ticket]</span>р</p>";
                            echo '<select class="combobox_select form-control" name="ch">'; 
                                echo '<option value="">Выберите мероприятия</option>';
                                if($result = mysqli_query($link, "SELECT Afisha.num_afish as num_afish, Afisha.name_afish as name_afish, Afisha.photo as photo, Afisha.data_start as data_start, Afisha.data_end as data_end FROM Afisha inner join Catalog_Museum  where '$_COOKIE[id_museum]'= Afisha.id_museum group by Afisha.num_afish"))
                                {
                                    while($object = mysqli_fetch_object($result))
                                    {
                                        echo "<option id='select_afish' value='$object->num_afish'>$object->name_afish</option>"; 
                                        // echo "<input type='date' min='$object->data_start' max='$object->data_end' name='data_event' class='form-control'>";
                                    }
                                }
                             echo '</select>';
                                if($result = mysqli_query($link, "SELECT Afisha.num_afish as num_afish, Afisha.name_afish as name_afish, Afisha.photo as photo, Afisha.data_start as data_start, Afisha.data_end as data_end FROM Afisha inner join Catalog_Museum  where '$_COOKIE[id_museum]'= Afisha.id_museum group by Afisha.id_museum"))
                                {
                                    while($object = mysqli_fetch_object($result))
                                    {
                                        // echo "<option id='select_afish' value='$object->num_afish'>$object->name_afish</option>"; 
                                        echo "<input type='date' min='$object->data_start' max='$object->data_end' name='data_event' class='form-control'>";
                                    }       
                                }
                                echo "<input type='text' placeholder='кол-во билетов' id='kol_ticket' name='kol_ticket' class='form-control'>";
                                echo "<input type='text' placeholder='введите время' name='time_bron' class='form-control'>";
                            echo "<select name='textbox' id='combobox' class='form-control'>";
                                echo "<option value=''>Нужен ли гид?</option>";
                                echo "<option value='yes'>Да</option>";
                                echo "<option value='net'>Нет</option>";
                            echo "</select>";
                            echo "<h4 id='sum' style='text-align: center;'>Общая сумма заказа: <span id='total-sum'></span>р.</h4>";
                                echo "<input type='submit' class='btn btn-secondary'>";
                        echo '</div>';
                }
            }
        }
          ?>
          <script type="text/javascript">
                let objj = '<?php echo json_encode($arrFull);?>';
                objj = JSON.parse(objj);
                const element = document.querySelector(".combobox_select");
                element.addEventListener("change",func);
                const event = document.querySelector(".photo_ticket");
                const event5 = document.querySelector(".name_afisha");
                const event3 = document.getElementsByName(".kol_ticket");
                const event4 = document.querySelector(".cost-ticket");
                // const event5 = document.
                function func(){
                    console.log(objj);
                    objj.forEach((el)=>{
                        if(el.num === this.value)
                        {
                            event.src=el.photo;
                            event3.innerHTML=el.kol_ticket;
                            event4.innerHTML=el.cost;
                            event5.innerHTML=el.name_duck;
                        }
                    })
                    
                };  
            </script>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let totalSum = document.getElementById('total-sum')
                let costTicket = document.querySelector('.cost-ticket')
    
                document.getElementById('kol_ticket').addEventListener('keyup', function (e) {
                    let count = e.target.value;
                    console.log(totalSum);
                    if(count.length < 3) {
                        totalSum.innerHTML = count * costTicket.innerHTML
                    } else {
                        this.value = this.value.slice(0, this.value.length - 1)
                    }
                })
            })
        </script>

	</div>
    
	</section>
    <script>
    $('.kol_ticket').blur(function() {
                var kol_ticket = $(this).val();
                var idTov = $(this).attr('id');
                console.log(idTov);
                console.log(kolvoTov);
                    if(!/^[0-9]+$/.test(kolvoTov) || kolvoTov <= 0)
                    {
                        $(this).val(1);
                        Swal.fire({
                        title: 'Неправильный формат количества',
                        showConfirmButton: true,
                        confirmButtonColor: '#ff7878',
                        });
                        var kolvoTov = $(this).val();

                        $.ajax({
                        type: "POST",
                        url: 'kolvo.php',
                        data: {val:kolvoTov, id:idTov},
                        success: function(data) {
                            result = JSON.parse(data);
                            $('#sum').html("Общая сумма заказа: " + result.sum + " руб.");

                        },
                        error: function(data) {
                            alert("Что то пошло не так( kolvo");
                        }
                    });


                    }
                    else
                    {
                        $.ajax({
                        type: "POST",
                        url: 'kolvo.php',
                        data: {val:kolvoTov, id:idTov},
                        success: function(data) {
                            result = JSON.parse(data);
                            $('#sum').html("Общая сумма заказа: " + result.sum + " руб.");

                        },
                        
                        error: function(data) {
                            alert("Что то пошло не так(" + data.error);
                        }
                    });
                    }
                    
             });
</script>

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

