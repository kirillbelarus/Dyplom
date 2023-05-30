<?php
$id1 = $_POST["ID"];
$id_org = $_COOKIE["org_id"];
$name_afish = $_POST["name_afish"];
$data_start = $_POST["data_start"];
$data_end = $_POST["data_end"];
$cost_ticket = $_POST["cost_ticket"];
$combo_type = $_POST["combo_type"];
$download_image = $_POST["download_image"];
$combo_genre = $_POST["combo_genre"];
$link = mysqli_connect("localhost", "root", "", "course", 3306);
echo "$data_start";
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



$query=mysqli_query($link, "INSERT INTO Afisha (id_museum,id_org,name_afish,type_event,data_start,data_end,photo,cost_ticket,genre_afisha) VALUES ('$id1','$id_org','$name_afish','$combo_type','$data_start','$data_end','$newFile','$cost_ticket','$combo_genre')"); 
if ( $query==true) {
    header("Location: add_afisha.php?success=1");}
else {echo "Данные введены неверно!";}

mysqli_close($link);
?>