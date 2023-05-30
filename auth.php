<?php
    $login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
    $check = $_POST['choice'];
    $link = mysqli_connect("localhost", "root", "", "course", 3306);

    if(mb_strlen($login)<2 || mb_strlen($login)>20)
        {
            echo "Превышен лимит ввода логина";
            exit();
        }
    else if(mb_strlen($password)<3 || mb_strlen($password)>20)
        {
            echo "Превышен лимит ввода пароля";
            exit();
        }

        if (!$link) {
            echo "Ошибка: Невозможно установить соединение с MySQL.";
            echo "Код ошибки errno: " . mysqli_connect_errno();
            exit;
        }
        echo "Соединение с MySQL установлено!";
        if("$login" == 'admin' and "$password" == 'admin')
        {
            $query=mysqli_query($link, "SELECT * FROM Organiz");
            setcookie('admin',1,time() + 3600,"/");
            setcookie("org",0, time()+ 3600, "/"); 
            setcookie("user",0, time()+ 3600, "/");    
        }
        else{
            if($check == 'value1')
        {
            echo "selected";
            $query=mysqli_query($link, "SELECT * FROM Organiz where fio_org = '$login' and password_org = '$password'");
            $org = $query->fetch_assoc();
            if(empty($org) or count($org) == 0)
            {
                echo "Такой пользователь не найден";
                // echo "$e_mail";
                header("Location: sign.php?unsuccess=1");
                exit();
            }
            $query2=mysqli_query($link, "SELECT * FROM Organiz where fio_org = '$login' and password_org = '$password'");
            $org2 = $query2->fetch_assoc();
            $query3=mysqli_query($link, "SELECT * FROM Organiz where fio_org = '$login' and password_org = '$password'");
            $org_email = $query3->fetch_assoc();
            setcookie('org',1, time() + 3600,"/");
            setcookie('org_id',$org2['id_org'], time() + 3600,"/");
            setcookie('admin',0,time() + 3600,"/");
            setcookie('org_email',$org_email['e_mail'], time() + 3600,"/");
            setcookie("user",0, time()+ 3600, "/");
            // setcookie('org',$org2['fio_org'], time() + 3600,"/");
            // echo $org2['e_mail'];
        }
        else{
            echo "nope";
            $query=mysqli_query($link, "SELECT * FROM Users where login_user = '$login' and password_user = '$password'");
            // $user = mysqli_fetch_assoc($query);
            $user = $query->fetch_assoc();
            if(empty($user) or count($user) == 0)
            {
                echo "Такой пользователь не найден";
                echo "$e_mail";
                header("Location: sign.php?unsuccess=0");
                exit();
                // $result=mysqli_query($link, "INSERT INTO Users (login_user,e_mail,password_user) VALUES ('$login','$e_mail','$password')");   
            }
            $query2=mysqli_query($link, "SELECT * FROM Users where login_user = '$login' and password_user = '$password'");
            $org2 = $query2->fetch_assoc();
            $query3=mysqli_query($link, "SELECT * FROM Users where login_user = '$login' and password_user = '$password'");
            $user_email  = $query3->fetch_assoc();
                setcookie('org',0, time() + 3600,"/");
                setcookie('user_id',$org2['id_user'], time() + 3600,"/");
                setcookie('admin',0,time() + 3600,"/");
                setcookie('user_email',$user_email['e_mail'], time() + 3600,"/");
                setcookie("user",1, time()+ 3600, "/");
                // setcookie('user',$org2['login_user'], time() + 3600,"/");
                // echo $org2['e_mail'];
                // echo $org2['login_user'];
        }
        }
        
        if ( $query==true) {
            header("Location: main.php");}
        else {
            header("Location: sign.php?unsuccess=1");
        }

    mysqli_close($link);
?>
 
<!-- $query=mysqli_query($link, "SELECT * FROM Users where login_user = '$login' and password_user = '$password'");
        // $user = mysqli_fetch_assoc($query);
        $user = $query->fetch_assoc();
        if(empty($user) or count($user) == 0)
        {
            echo "Такой пользователь не найден";
            exit();
        }

        setcookie('user',$user['login_user'], time() + 3600,"/");
        echo $user['login_user'];
        if ( $query==true) {
            header("Location: main.php");}
        else {echo "Данные введены неверно!";
            echo "$login";
            echo "$e_mail";
            echo "$password";}
 -->