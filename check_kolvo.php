<?php 
	session_start();
	$link = mysqli_connect("localhost", "root", "", "course", 3306);

    if (!$link) {
        echo "Ошибка: Невозможно установить соединение с MySQL.";
        echo "Код ошибки errno: " . mysqli_connect_errno();
        exit;
    }
    echo "Соединение с MySQL установлено!";

	$infa = $_POST['val'];
	$idTovara = $_POST['id'];
	$query=mysqli_query($connection,"update cart set kolvoTov='$infa' where idTov='$idTovara';");

	$a = $_SESSION['order'];
	$sql = "SELECT sum(tovar.cena * cart.kolvoTov) as totalSum FROM tovar inner join cart on cart.idTov = tovar.ID where idZak='$a'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($result);



        $arr = array();
        $arr['sum'] =$row['totalSum'];
         
                    
	echo json_encode($arr);
?>