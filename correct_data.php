<?php

        $login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
        $e_mail = filter_var(trim($_POST['e_mail']),FILTER_SANITIZE_EMAIL);
        $password = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);

        $id_user = $_COOKIE["user_id"];
        $id_org = $_COOKIE["org_id"];
        // $login = $_POST['login'];
        $link = mysqli_connect("localhost", "root", "", "course", 3306);

        if (!$link) {
            echo "Ошибка: Невозможно установить соединение с MySQL.";
            echo "Код ошибки errno: " . mysqli_connect_errno();
            exit;
        }
        echo "Соединение с MySQL установлено!";

        if(mb_strlen($login)<2 || mb_strlen($login)>20)
        {
            echo "Превышен лимит ввода логина";
            header("Location: personal.php?input_data=0");
            exit();
        }
        else if(mb_strlen($e_mail)<3 || mb_strlen($e_mail)>50)
        {
            echo "Превышен лимит ввода почты";
            header("Location: personal.php?input_data=0");
            exit();
        }
        else if(mb_strlen($password)<3 || mb_strlen($password)>20)
        {
            echo "Превышен лимит ввода пароля";
            header("Location: personal.php?input_data=0");
            exit();
        }
                if(isset($_COOKIE["org"]))
                {
                    if($_COOKIE["org"] ==1){
                        $query=mysqli_query($link, "SELECT * FROM Organiz where e_mail = '$e_mail'");
                        $org = $query->fetch_assoc();
    
                        // setcookie('org_id',$org['id_org'], time() + 3600,"/");
                        // $org_id = $_COOKIE["org_id"];
                        if(empty($org) or count($org) == 0)
                        {
                            echo "Такой пользователь не найден";
                            echo "$e_mail";
                            $query3=mysqli_query($link, "SELECT * FROM Organiz where e_mail = '$login'");
                            $org4 = $query3->fetch_assoc();
                            if(empty($org4) or count($org4) == 0)
                            {
                                $result=mysqli_query($link, " UPDATE Organiz  SET fio_org='$login', e_mail='$e_mail', password_org = '$password' where id_org = '$id_org'");
                            
                            }
                            else if(empty($org4) or count($org4) != 0)
                            {
                                header("Location: personal.php?unsuccessed=0");
                                echo "Такой пользователь найден";
                                exit();
                                    // $result=mysqli_query($link, "UPDATE Organiz  SET fio_org='$login', e_mail='$e_mail', password_org = '$password' where id_org = '$id_org' ");
        
                                // $result=mysqli_query($link, "INSERT INTO Organiz (fio_org,e_mail,password_org) VALUES ('$login','$e_mail','$password')");
                            }
                    
                        }
                        else if(empty($org) or count($org) != 0)
                        {
                            header("Location: personal.php?unsuccess=0");
                            echo "Такой пользователь найден";
                            exit();
                                // $result=mysqli_query($link, "UPDATE Organiz  SET fio_org='$login', e_mail='$e_mail', password_org = '$password' where id_org = '$id_org' ");
    
                            // $result=mysqli_query($link, "INSERT INTO Organiz (fio_org,e_mail,password_org) VALUES ('$login','$e_mail','$password')");
                        }
                        $query2=mysqli_query($link, "SELECT * FROM Organiz where e_mail = '$e_mail'");
                        $org2 = $query2->fetch_assoc();
                        $query3=mysqli_query($link, "SELECT * FROM Organiz where fio_org = '$login' and password_org = '$password'");
                        $org_email = $query3->fetch_assoc();
                        setcookie('org',1, time() + 3600,"/");
                        setcookie('org_id',$org2['id_org'], time() + 3600,"/");
                        setcookie('org_email',$org_email['e_mail'], time() + 3600,"/");
                        setcookie("user",0, time()+ 3600, "/");
                    }
                }
				
                if(isset($_COOKIE["user"]))
                {
                    if($_COOKIE['user']==1){
                        $query=mysqli_query($link, "SELECT * FROM Users where e_mail = '$e_mail'");
                        $org1 = $query->fetch_assoc();
    
                        // setcookie('org_id',$org['id_org'], time() + 3600,"/");
                        // $org_id = $_COOKIE["org_id"];
                        if(empty($org1) or count($org1) == 0)
                        {
                            $query2=mysqli_query($link, "SELECT * FROM Users where login_user = '$login'");
                            $org3 = $query2->fetch_assoc();
                            echo "Такой пользователь не найден";
                            if(empty($org3) or count($org3) == 0)
                            {
                                    echo "Такой пользователь не найден";
                                    echo "$login";
                                    $result=mysqli_query($link, " UPDATE Users  SET login_user='$login', e_mail='$e_mail', password_user = '$password' where id_user = '$id_user'");
                            
                            }
                            else if(empty($org3) or count($org3) != 0)
                            {
                                header("Location: personal.php?unsuccessed=0");
                                echo "Такой пользователь найден";
                                exit();
                                    // $result=mysqli_query($link, "UPDATE Organiz  SET fio_org='$login', e_mail='$e_mail', password_org = '$password' where id_org = '$id_org' ");
        
                                // $result=mysqli_query($link, "INSERT INTO Organiz (fio_org,e_mail,password_org) VALUES ('$login','$e_mail','$password')");
                            }
                            echo "$e_mail";
                            $result=mysqli_query($link, " UPDATE Users  SET login_user='$login', e_mail='$e_mail', password_user = '$password' where id_user = '$id_user'");
                    
                        }
                        else if(empty($org1) or count($org1) != 0)
                        {
                            header("Location: personal.php?unsuccess=0");
                            echo "Такой пользователь найден";
                            exit();
                                // $result=mysqli_query($link, "UPDATE Organiz  SET fio_org='$login', e_mail='$e_mail', password_org = '$password' where id_org = '$id_org' ");
    
                            // $result=mysqli_query($link, "INSERT INTO Organiz (fio_org,e_mail,password_org) VALUES ('$login','$e_mail','$password')");
                        }
                        $query2=mysqli_query($link, "SELECT * FROM Users where e_mail = '$e_mail'");
                        $user2 = $query2->fetch_assoc();
                        $query3=mysqli_query($link, "SELECT * FROM Users where login_user = '$login' and password_user = '$password'");
                        $user_email = $query3->fetch_assoc();
                        setcookie('user',1, time() + 3600,"/");
                        setcookie('user_id',$user2['id_user'], time() + 3600,"/");
                        setcookie('user_email',$user_email['e_mail'], time() + 3600,"/");
                        setcookie("org",0, time()+ 3600, "/");
                    }
                }
                
        if ( $query==true) {
            header("Location: personal.php?success=1");}
        else {echo "Данные введены неверно!";
            echo "$login";
            echo "$e_mail";
            echo "$password";
        }

        // mysqli_close($link);
?>