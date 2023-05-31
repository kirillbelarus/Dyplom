<?php
session_start();
$id_museum = $_SESSION["museum_id"];
$num_afish = $_SESSION["new_num_afish"];
$id_user = $_COOKIE["user_id"];
$kol_ticket = $_POST["kol_ticket"];
$time_bron = $_POST["time_bron"];
$data_event = $_POST["data_event"];
// $num_afish = $_POST["ch"];
$combo = $_POST["textbox"];
$link = mysqli_connect("localhost", "root", "", "course", 3306);

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL.";
    echo "Код ошибки errno: " . mysqli_connect_errno();
    exit;
}
echo "Соединение с MySQL установлено!";

$query=mysqli_query($link, "INSERT INTO Bron (id_museum,id_user,num_afish,data_visit,time_visit,kol_chel,gid) VALUES ('$id_museum','$id_user','$num_afish','$data_event','$time_bron','$kol_ticket','$combo')"); 
if ( $query==true) {
    header("Location: buyticket_afisha.php?success=1");
}
else {echo "Данные введены неверно!";}

mysqli_close($link);
?>