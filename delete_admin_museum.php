<?php 
    echo "Форма удаления";
    $id = $_POST['udal_user'];

    $link = mysqli_connect("localhost", "root", "", "course",3306);

    if (!$link) {
        echo "Ошибка: Невозможно установить соединение с MySQL.";
        echo "Код ошибки error: " . mysqli_connect_errno();
        exit;
    }
    echo "Соединение с MySQL установлено!";

    $query=mysqli_query($link, "DELETE FROM Catalog_Museum WHERE id_museum = $id"); 
        header("Location: AdminMuseum.php");

    mysqli_close($link);
?>