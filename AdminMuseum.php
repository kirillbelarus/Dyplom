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
                                if($_COOKIE["org"] == 1):
                                echo "<li class='nav-item '>";
                                echo "<a href='add_afisha.php' class='nav-link'>Добавить афишу</a>";
                                echo "</li>";
                                echo "<li class='nav-item'>";
                                echo "<a href='add_museum.php' class='nav-link'>Добавить музей</a>";
                                echo "</li>";
                                endif;
                            ?>	
                                    <?php 
                                        // if($_COOKIE["org"] == 1 || $_COOKIE['user'] ==1):
                                        //     echo "<a class='dropdown-item' href='registr.php'>Зарегистрироваться</a>";
                                        //     echo "<a class='dropdown-item' href='sign.php'>Войти</a>";
                                        // endif;
                                        ?>	
                        </ul>
                    </div>
                    <li class="nav-item dropdown profile__btn">
                        <a class="nav-link" href="personal.php" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="personal.php">Зайти в кабинет</a>
                            <?php 
                                // if($_COOKIE["org"] == 1 || $_COOKIE['user'] ==1):
                                //     echo "<a class='dropdown-item' href='registr.php'>Зарегистрироваться</a>";
                                //     echo "<a class='dropdown-item' href='sign.php'>Войти</a>";
                                // endif;
                                ?>	
                            
                            <a class="dropdown-item" href="exit.php">Выйти</a>
                        </div>
                    </li>
                </div>
    </nav>

    <table border="1" style="width:75%; margin-right:auto; margin-left:auto; margin-top:100px;" class="styled-table">
        <tr style='text-align: center;'>
            <th>Название музея</th>
            <th>ФИО организатора</th>
            <th>Почта музея</th>
            <th>Количество афиш</th> 
            <th>Адрес музея</th> 
            <th>Телефон музея</th>
            <th>Время работы</th>
            <!-- <th></th> -->
            <!-- <th></th>  -->
        </tr>
        <?php
             $link = mysqli_connect("localhost", "root", "", "course", 3306);
                if ($result = mysqli_query($link, 'SELECT Catalog_Museum.id_museum as id_museum,Catalog_Museum.name_museum as name_museum, count(Afisha.num_afish) as count_afish,Organiz.fio_org as fio, 
                Catalog_Museum.adress as adress,Catalog_Museum.tel as tel,Catalog_Museum.e_mail as e_mail,Catalog_Museum.time_work as time_work 
                from Catalog_Museum inner join Organiz on Catalog_Museum.id_org = Organiz.id_org left join Afisha on  Catalog_Museum.id_museum = Afisha.id_museum
                group by id_museum'))
                {
                  while( $row = mysqli_fetch_assoc($result) )
                  {
                      echo "<tr style='text-align:center'>";
                      echo "<form action='delete_admin_museum.php' method='POST'>";
                      echo "<td>".$row['name_museum']."</td>";
                      echo "<td>".$row['fio']."</td>";
                      echo "<td>".$row['e_mail']."</td>";
                      echo "<td>".$row['count_afish']."</td>";
                      echo "<td>".$row['adress']."</td>";
                    //   echo "<td>".$row['name_afish']."</td>";
                      echo "<td>".$row['tel']."</td>";
                      echo "<td>".$row['time_work']."</td>";
                      echo "<td style='justify-content: center;'>"
                        ."<button type='submit' name='udal_user' value='".$row['id_museum']."'>Удалить</button>"
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

