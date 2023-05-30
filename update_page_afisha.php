<?php
$id_afisha = $_POST["ID"];
// $name_team = $_POST["data_start"];
// $age = $_POST["data_end"];
$p_min = $_POST["price_min"];
$p_max = $_POST["price_max"];
$link = mysqli_connect("localhost", "root", "", "course", 3306);

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL.";
    echo "Код ошибки errno: " . mysqli_connect_errno();
    exit;
}
echo "Соединение с MySQL установлено!";

$query=mysqli_query($link, "SELECT Afisha.photo as photo from Afisha (name_team,age_category,fio_instructor) VALUES ('$name_team','$age','$fio')"); 
if ( $query==true) {
    header("Location: team.php");}
else {echo "Данные введены неверно!";}

mysqli_close($link);
?>