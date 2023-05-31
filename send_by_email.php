<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    if(isset($_POST["add_user"])){
        $link = mysqli_connect("localhost", "root", "", "course", 3306);
      if (!$link) {
          echo "Ошибка: Невозможно установить соединение с MySQL.";
          echo "Код ошибки error: " . mysqli_connect_errno();
          exit;
      }
      echo "Соединение с MySQL установлено!";
        $id_request = $_POST['add_user'];
        if ($result = mysqli_query($link, "SELECT id_request,id_user,e_mail,login_user,tel,password_user from Request where id_request = '$id_request'"))
                {
                  while( $row = mysqli_fetch_assoc($result) )
                  {
                    $mail = new PHPMailer(true);
                    $email_user = $row['e_mail'];
                    $login_user = $row['login_user'];
                    $tel = $row['tel'];
                    $password_user = $row['password_user'];
                    $mail->isSMTP();
                    $mail->CharSet = "UTF-8";
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'girelkirill@gmail.com';
                    $mail->Password = 'bvypznaepcxrrqcz';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
            
                    $mail->setFrom('girelkirill@gmail.com');
                    echo "$id_request";
                    $mail->addAddress($row['e_mail']);
                    $text = "Ваш ответ на запрос, дорогой ";
                    $body_text = "Мы рады вам сообщить, что вам предьявлены права организатора. 
                    Для входа с правами необходимо выйти из действующего аккакунта и при входе поставить галочку 'организатор'.
                    Пароль и логин остаются те же. Ваш пароль:'$row[password_user]'";
                    $mail->isHTML(true);
                    $mail->Subject =$text.$row['login_user'];
                    $mail->Body=$body_text;
                    
                    $mail->send();
            
                    echo "$login_user";
                    $query=mysqli_query($link, "INSERT INTO Organiz (e_mail,fio_org,tel,password_org) VALUES ('$email_user','$login_user','$tel','$password_user')"); 
                    $query2=mysqli_query($link, "DELETE FROM Request WHERE id_request = $id_request");
                    if ( $query==true) {
                        header("Location: AdminRequest.php?success=1");
                    }
                    else {echo "Данные введены неверно!";}
                  }
                  mysqli_free_result($result);
                }
            mysqli_close($link);
    }
    echo "check1";
    if(isset($_POST["delete_user"])){
        $link = mysqli_connect("localhost", "root", "", "course", 3306);
      if (!$link) {
          echo "Ошибка: Невозможно установить соединение с MySQL.";
          echo "Код ошибки error: " . mysqli_connect_errno();
          exit;
      }
      echo "Соединение с MySQL установлено!";
      echo "check2";
        $id_request = $_POST['delete_user'];
        echo "$id_request";
        if ($result2 = mysqli_query($link, "SELECT id_request,id_user,e_mail,login_user,tel,password_user from Request where id_request = '$id_request'"))
                {
                  echo "check3";
                  while( $row = mysqli_fetch_assoc($result2) )
                  {
                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'girelkirill@gmail.com';
                    $mail->Password = 'bvypznaepcxrrqcz';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
            
                    $mail->setFrom('girelkirill@gmail.com');
                    echo "$id_request";
                    $mail->addAddress($row['e_mail']);
                    $text = "Ваш ответ на запрос, дорогой ";
                    $body_text = "К сожалению, мы вынуждены вам отказать в предоставлении вам прав организатора. Всего вам наилучшего! Оствайтесь всегда с нами!)";
                    $mail->isHTML(true);
                    $mail->Subject =$text.$row['login_user'];
                    $mail->Body=$body_text;
            
                    $mail->send();
                    $query=mysqli_query($link, "DELETE FROM Request WHERE id_request = $id_request");
                    if ( $query==true) {
                        header("Location: AdminRequest.php?success=1");
                    }
                    else {echo "Данные введены неверно!";}
                  }
                  mysqli_free_result($result2);
                }
                mysqli_close($link);   
    }
?>