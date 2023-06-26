<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        $login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
        $e_mail = filter_var(trim($_POST['e_mail']),FILTER_SANITIZE_EMAIL);
        $password = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
        $link = mysqli_connect("localhost", "root", "", "course", 3306);
        require 'phpmailer/src/Exception.php';
        require 'phpmailer/src/PHPMailer.php';
        require 'phpmailer/src/SMTP.php';
        if (!$link) {
            echo "Ошибка: Невозможно установить соединение с MySQL.";
            echo "Код ошибки errno: " . mysqli_connect_errno();
            exit;
        }
        echo "Соединение с MySQL установлено!";

        if(mb_strlen($login)<2 || mb_strlen($login)>20)
        {
            header("Location: registr.php?unsuccess=0");
            echo "Превышен лимит ввода логина";
            exit();
        }
        else if(mb_strlen($e_mail)<3 || mb_strlen($e_mail)>50)
        {
            header("Location: registr.php?unsuccess=0");
            echo "Превышен лимит ввода почты";
            exit();
        }
        else if(mb_strlen($password)<3 || mb_strlen($password)>20)
        {
            header("Location: registr.php?unsuccess=0");
            echo "Превышен лимит ввода пароля";
            exit();
        }
            echo "nope";
            $query=mysqli_query($link, "SELECT * FROM Users where e_mail = '$e_mail'");
            $user = $query->fetch_assoc();
            if(empty($user) or count($user) == 0)
            {
                $query3 = mysqli_query($link,"SELECT * FROM Users where login_user = '$login' ");
                $user2 = $query3->fetch_assoc();
                if(empty($user2) or count($user2) ==0)
                {

                    $mail = new PHPMailer(true);
                    try{
                        $email_user = $e_mail;
                        $login_user = $login;
                        $password_user = $password;
                        $mail->isSMTP();
                        $mail->CharSet = "UTF-8";
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'girelkirill@gmail.com';
                        $mail->Password = 'wffbhjwqtzlmbrcw';
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;
                        $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;}; 
                        $mail->setFrom('girelkirill@gmail.com');
                        echo "$id_request";
                        $mail->addAddress($email_user);
                        $text = "Ваш ответ на запрос, дорогой ";
                        $body_text = "Поздравляем. Регистрация вашего аккаунта прошла успешна. Ваш пароль:'$password_user'";
                        $mail->isHTML(true);
                        $mail->Subject =$text.$login_user;
                        $mail->Body=$body_text;
                        
                        $mail->send();
                        echo "Такой пользователь не найден";
                        if ($mail->send()) {$result = "success";} 
                        else {
                            header("Location: registr.php?error_mail=0");
                            $result = "error";
                        }
                        $result=mysqli_query($link, "INSERT INTO Users (login_user,e_mail,password_user) VALUES ('$login','$e_mail','$password')"); 
                    }catch (Exception $e) {
                        header("Location: registr.php?error_mail=0");
                        $result = "error";
                        $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
                    }
                    
                    echo json_encode(["result" => $result, "status" => $status]);                    
                }
                else if(empty($user2) or count($user2) != 0)
                {
                    header("Location: registr.php?unsuccessed_login=0");
                    echo "Такой пользователь найден";
                    exit();
                }
            }
            else if(empty($user) or count($user) != 0)
            {
                header("Location: registr.php?unsuccessed=0");
                echo "Такой пользователь найден";
                echo "$e_mail";
                exit(); 
            }
            $query2=mysqli_query($link, "SELECT * FROM Users where e_mail = '$e_mail'");
            $org2 = $query2->fetch_assoc();
                setcookie('org',0, time() + 3600,"/");
                
                setcookie('user_id',$org2['id_user'], time() + 3600,"/");
                setcookie('user_email',$org2['e_mail'], time() + 3600,"/");
                setcookie("user",1, time()+ 3600, "/");

        if ( $query==true) {
            header("Location: global_page.php?success=1");
        }
        else {echo "Данные введены неверно!";
            echo "$login";
            echo "$e_mail";
            echo "$password";
        }
?>