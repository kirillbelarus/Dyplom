<?php
$name_museum = $_POST["name_museum"];
$id_org = $_COOKIE["org_id"];
$adress = $_POST["adress"];
$tel = $_POST["telephone"];
$e_mail = $_POST["email"];
$time_work = $_POST["time_work"];

$link = mysqli_connect("localhost", "root", "", "course", 3306);
if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL.";
    echo "Код ошибки errno: " . mysqli_connect_errno();
    exit;
}

echo "Соединение с MySQL установлено!";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tmpFile = $_FILES['pic']['tmp_name'];
    $newFile = './images/'.$_FILES['pic']['name'];
    $result = move_uploaded_file($tmpFile, $newFile);
    echo $_FILES['pic']['name'];
    if ($result) {
         echo ' was uploaded<br />';
    } else {
         echo ' failed to upload<br />';
    }
}

$query=mysqli_query($link, "INSERT INTO Catalog_Museum (name_museum,adress,tel,e_mail,time_work,photo,id_org)
 VALUES ('$name_museum','$adress','$tel','$e_mail','$time_work','$newFile','$id_org')"); 
if ( $query==true) {
    header("Location: add_museum.php?success=1");}
else {echo "Данные введены неверно!";}

mysqli_close($link);
?>