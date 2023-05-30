<?php
session_start();
$login_user = $_SESSION["login_user"];
$date_submission = $_SESSION["date_submission"];
$password_user = $_SESSION["password_user"];
$id_user = $_COOKIE["user_id"];
$user_email = $_COOKIE["user_email"];
$name_museum = $_POST["name_museum"];
$adress = $_POST["adress"];
$tel = $_POST["telephone"];
$time_work = $_POST["time_work"];
$link = mysqli_connect("localhost", "root", "", "course", 3306);
echo "x";
echo "$date_submission";
if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL.";
    echo "Код ошибки errno: " . mysqli_connect_errno();
    exit;
}
echo "Соединение с MySQL установлено!";

echo "<br>";
echo "$id_user";
echo "<br>";
echo "$user_email";
echo "<br>";
echo "$login_user";
echo "<br>";
echo "$name_museum";
echo "<br>";
echo "$adress";
echo "<br>";
echo "xuina $tel";
echo "<br>";
echo "nexuina $time_work";

$query=mysqli_query($link, "INSERT INTO Request (id_user,e_mail,login_user,name_museum,adress,tel,password_user,time_work,date_submission) 
VALUES ($id_user,'$user_email','$login_user','$name_museum','$adress',$tel,'$password_user','$time_work','$date_submission')"); 

echo "$query";
if ( $query==true) {
    // header("Location: request_org_user.php?success=1");
}
else {echo "Данные введены неверно!";}

mysqli_close($link);
?>