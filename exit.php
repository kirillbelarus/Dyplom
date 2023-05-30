<?php 
    setcookie('user',$user['name'], time() - 3600,"/"); 
    setcookie('admin',$admin['name'], time() - 3600,"/");
    setcookie('org',$org['name'], time() - 3600,"/");
    setcookie('user_email',$e_mail['name'], time() - 3600,"/");
    setcookie('org_email',$e_mail_org['name'], time() - 3600,"/");
    setcookie('user_id',$user_id['name'], time() - 3600,"/");
    setcookie('org_id',$org_id['name'], time() - 3600,"/");
    setcookie('id_afish_cookie',$id_afish_cookie['name'],time()-3600,"/");
    header("Location: sign.php");
?>