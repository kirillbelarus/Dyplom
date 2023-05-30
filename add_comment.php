<?php
session_start();
$id_afish = $_COOKIE["id_afish_cookie"];
$id_user = $_COOKIE["user_id"];
$comment_text = $_POST["message"];
$rating = $_POST["rating"];
$link = mysqli_connect("localhost", "root", "", "course", 3306);
// echo gettype ($id_user);
// echo gettype ($comment_text);
// echo gettype ($rating);
// echo "$comment_text";
echo "$id_afish";
if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL.";
    echo "Код ошибки errno: " . mysqli_connect_errno();
    exit;
}
echo "Соединение с MySQL установлено!";

$query=mysqli_query($link, "INSERT INTO Comments (id_user,num_afish,comment_text,rating) VALUES ($id_user,'$id_afish','$comment_text',$rating)"); 
if ( $query==true) {
    header("Location: exh_info.php");
}
else {echo "Данные введены неверно!";}

mysqli_close($link);
?>