<?php

        $id = $_POST["id_bron"];

        $link = mysqli_connect("localhost", "root", "", "course", 3306);

        if (!$link) {
            echo "Ошибка: Невозможно установить соединение с MySQL.";
            echo "Код ошибки error: " . mysqli_connect_errno();
            exit;
        }
        echo "Соединение с MySQL установлено!";
        $query=mysqli_query($link, "DELETE FROM Bron WHERE id_bron = $id"); 

        header("Location: Adminbron.php");

        mysqli_close($link);
?> 