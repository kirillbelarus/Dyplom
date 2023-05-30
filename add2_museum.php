<?php
$name_museum = $_POST["name_museum"];
$id_org = $_COOKIE["org_id"];
$adress = $_POST["adress"];
$tel = $_POST["telephone"];
$e_mail = $_POST["email"];
$time_work = $_POST["time_work"];
// $photo = $_POST["download_image"];
$file = $_FILES['myfile'];
echo "$file";
echo "xui";
echo "<br>";
$link = mysqli_connect("localhost", "root", "", "course", 3306);
// echo "$data_start";
echo $file['name'][0];
echo "xui2";
echo "<br>";
if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL.";
    echo "Код ошибки errno: " . mysqli_connect_errno();
    exit;
}

echo "Соединение с MySQL установлено!";
$url_img = "./images/".$file['name'][0];
echo "$name_museum";
echo "1";
echo "$adress";
echo "2";
echo "$tel";
echo "3";
echo "$e_mail";
echo "4";
echo "$time_work";
echo "5";
echo "$url_img";
echo "6";
echo "$id_org";
echo "7";
echo "xui3";
$query=mysqli_query($link, "INSERT INTO Catalog_Museum (name_museum,adress,tel,e_mail,time_work,photo,id_org)
 VALUES ('$name_museum','$adress','$tel','$e_mail','$time_work','$url_img','$id_org')"); 
if ( $query==true) {
    header("Location: add_museum.php?success=1");}
else {echo "Данные введены неверно!";}

mysqli_close($link);
?>