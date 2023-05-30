<?php

        $id = $_POST["num_afish"];

        $link = mysqli_connect("localhost", "root", "", "course", 3306);

        if (!$link) {
            echo "Ошибка: Невозможно установить соединение с MySQL.";
            echo "Код ошибки error: " . mysqli_connect_errno();
            exit;
        }
        echo "Соединение с MySQL установлено!";

        $query=mysqli_query($link, "DELETE FROM Afisha WHERE num_afish = $id"); 
        header("Location: Adminafisha.php");

        mysqli_close($link);
?> 