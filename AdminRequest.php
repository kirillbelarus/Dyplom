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
                                echo "<a href='add_afisha.php' class='nav-link'>Добавить афишу</a>";
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
        <?php
            
            $link_5 = mysqli_connect("localhost", "root", "", "course", 3306);
            $check = "SELECT count(id_request) as count_id FROM Request";
            if($result5 = mysqli_query($link_5, $check))
            {
                while( $row = mysqli_fetch_assoc($result5) )
                {
                    $_SESSION['count_bron'] = $row['count_id'];
                }
            
            mysqli_free_result($result5);
                }
            if($_SESSION['count_bron']==0)
            {
                echo "<p style='font-size: 50px;
                text-align: center;margin-top:15%'>Заявок нет</p>";
            }
            else{
                echo " <form action='' method='POST' style='margin-left:40%; margin-top:100px;'>";
           
                if(isset($_POST['name_afish']))
                {
                  $value = $_POST['name_afish'];
                }
                    
                else{
                  $value = "";
                }
                echo "<input placeholder='введите логин пользователя..' name='name_afish' value='$value'/>";  
       
            
                echo "<button type='submit'>Поиск</button>";
                echo " </form>";
                echo "<table border='1' style='width:75%; margin-right:auto; margin-left:auto; margin-top:100px;' class='styled-table'>";
                echo " <tr style='text-align: center;'>";
                echo "   <th>Почта пользователя</th>";
                echo "  <th>Логин пользователя</th>";
                echo "  <th>Наименование музея</th> ";
                echo "  <th>Адрес музея</th>";
                echo "  <th>Номер телефона</th>";
                echo "  <th>Время работы</th>";
                echo "  <th>Дата отправления заявки</th>";
                echo "  <th></th>";
                echo "  <th></th> ";
                echo " </tr>";
             $link = mysqli_connect("localhost", "root", "", "course", 3306);
                if(isset($_POST['name_afish']))
                {
                    $sql="SELECT id_request,id_user,e_mail,login_user,name_museum,adress,tel,time_work,date_submission from Request where login_user='$_POST[name_afish]'";
                }
                else
                    $sql="SELECT id_request,id_user,e_mail,login_user,name_museum,adress,tel,time_work,date_submission from Request";
                if ($result = mysqli_query($link, $sql))
                {
                  while( $row = mysqli_fetch_assoc($result) )
                  {
                      echo "<tr style='text-align:center'>";
                      echo "<form action='send_by_email.php' method='POST'>";
                      echo "<td>".$row['e_mail']."</td>";
                      echo "<td>".$row['login_user']."</td>";
                    //   echo "<td>".$row['name_afish']."</td>";
                      echo "<td>".$row['name_museum']."</td>";
                      echo "<td>".$row['adress']."</td>";
                      echo "<td>".$row['tel']."</td>";
                      echo "<td>".$row['time_work']."</td>";
                      echo "<td>".$row['date_submission']."</td>";
                      echo "<td style='justify-content: center;'>"
                        ."<button type='submit' name='add_user' value='".$row['id_request']."'>Добавить</button>"
                        ."</td>";
                        echo "<td style='justify-content: center;'>"
                        ."<button type='submit' name='delete_user' value='".$row['id_request']."'>Удалить</button>"
                        ."</td>";
                      echo "</form>";
                      echo "</tr>";
                  }
                echo '</table>';
                mysqli_free_result($result);
                }
            }     
            ?>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>