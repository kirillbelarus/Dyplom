<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign UP</title>
    <link rel="stylesheet" href="1.css">
    <link rel="stylesheet" href="2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
</head>
<body>

<div class="swiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="./images/slider/1.jpg" alt="1"></div>
        <div class="swiper-slide"><img src="./images/slider/2.jpg" alt="2"></div>
        <div class="swiper-slide"><img src="./images/slider/3.jpg" alt="3"></div>
        <div class="swiper-slide"><img src="./images/slider/4.jpg" alt="4"></div>
    </div>

    </div>

<div class="body-background">
    <form action="check.php" class="container-fluid d-flex justify-content-center align-items-center h-100" method="post">
      
      <div class="card text-center">
          <h4>Создайте профиль</h4>
          <div>
              <span>Уже есть профиль?</span>
              <a href="sign.php" class="text-decoration-none">Войти</a>
          </div>
          
          <div class="block_text">
              <input type = "text" class="form-control" required placeholder="Username" name="login" id = "login">
          </div>
          
          <div class="block_text">
              <input type = "text" class="form-control" required placeholder="E-mail" pattern="^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" name="e_mail" id = "e_mail">
          </div>
          <div class="block_text">
              <input  type = "password" class="form-control" required  placeholder="Password" name="pass" id = "pass">
          </div>
          
          <div class="button_sign block_text">
              <button class="btn btn-primary btn-block btn-signup text-uppercase otpr">
                  <span>Зарегистрироваться</span>
                  
              </button>
          </div>
          <!-- <div class="px-3">
              <div class="mt-2 form-check d-flex flex-row">
              <input class="form-check-input" type="checkbox" value="value1" name="choice" id="services">
              <label class="form-check-label ms-2" for="services">
                Желаете ли вы войти как организатор?
              </label>
            </div>
          </div> -->
      </div>
  </form> 
 
  <?php       
    // setcookie('user',$user['name'], time() - 3600,"/");
    // setcookie('admin',$admin['name'], time() - 3600,"/");
    // setcookie('org',$org['name'], time() - 3600,"/");
    // header("Location: sign.php");
    ?>
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script type="module">
  import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.esm.browser.min.js'

  const swiper = new Swiper('.swiper', {
    loop: true,
    autoplay: {
        delay: 3000,
    },
    effect: 'fade',
    allowTouchMove: false
  })
</script>
<?php if (isset($_GET['unsuccess'])) {?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Авторизация не прошла',
                    showConfirmButton: true,
                    confirmButtonColor: '#ff0000'
                })
            </script>
    <?php   } ?>
    <?php if (isset($_GET['unsuccessed'])) {?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Электронная почта уже существует',
                    showConfirmButton: true,
                    confirmButtonColor: '#ff0000'
                })
            </script>
    <?php   } ?>
    <?php if (isset($_GET['unsuccessed_login'])) {?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Логин уже существует',
                    showConfirmButton: true,
                    confirmButtonColor: '#ff0000'
                })
            </script>
    <?php   } ?>
    <?php if (isset($_GET['success'])) {?>
					<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
					<script>
						Swal.fire({
							icon: 'success',
							title: 'Данные успешно изменены',
							showConfirmButton: true,
							confirmButtonColor: '#ff7878'
						})
					</script>
			<?php   } ?>
<!-- <script>
	$('.otpr').click(function() {

		var a = document.getElementById('login').value;
		var b = document.getElementById('e_mail').value;
		var c = document.getElementById('pass').value;

		if (a.length == 0 || b.length == 0 || c.length == 0) {
			alert('Не все поля заполнены');
		}
		else
		{
			if (a.match(/[0-9]/) || a.length <= 2)
			{
				alert('Логин должен содержать больше 2 символов и эти символы должны быть буквами')
			}
			else
			{
				if (b.match(/[0-9]/) || b.length <= 2)
				{
				alert('Почта доложна содержать больше 2 символов и эти символы должны быть буквами')
				}
			else
			{
				if (c.match(/[0-9]/) || c.length <= 2) 
				{
					alert('Пароль должен быть формата');
				}
				else
				{
					$.ajax({
           			type: "POST",
            		url: 'check.php',
            		data: {FIO:a, Theme:b, Phone:c},       
            		success: function(data) {
            			alert('Добавлено');
            		}   
            	});
				}
				
			}
			}
		}
	})
	</script> -->

</body>
</html>