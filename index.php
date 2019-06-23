<!DOCTYPE html>
<html>
<head>
	<title>Главная страница</title>
	<!--Таблица стилей-->
	<link rel="stylesheet" type="text/css" href="style.css">
	<!--Прогресс бар-->
	<link rel="stylesheet" type="text/css" href="progress_bar.css">
	<!--jQuery-->
	<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
	<!--jQuery ui-->
	<link rel="stylesheet" href="ui/jquery-ui.css">
	<script src="ui/jquery-ui.js"></script>
	<!--Скрипт-->
	<script type="text/javascript" src="script.js"></script>

	<!--Слайдер и шрифт-->
	<link rel="stylesheet" href="swiper/dist/css/swiper.min.css">
	<script src="swiper/dist/js/swiper.min.js"></script>
	<script src="https://use.fontawesome.com/ff295dfd4d.js"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<!--Яндекс карты-->
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=d6a8f63d-9f85-430e-8442-04c33ec27a1a" type="text/javascript"></script>

	<!--Модальное окно-->
 	<link rel="stylesheet" href="fancybox/dist/jquery.fancybox.min.css" />
  	<script src="fancybox/dist/jquery.fancybox.min.js"></script>

  	<script type="text/javascript" src="page_scroll_indicator.js"></script>
  	<link rel="stylesheet" href="stylePartners.css">
  	<link rel="stylesheet" type="text/css" href="stylePrice.css">

</head>
<body>

	<?php
		// Константы базы данных
		$con = mysqli_connect("localhost", "root", "", "users") 
    	or die("Ошибка " . mysqli_error($link));
	?>

	<?php
	
	if(isset($_POST["registration"])){

	if(!empty($_POST['email_input']) && !empty($_POST['password_input']) && !empty($_POST['accept_password_input']) && !empty($_POST['name_input']) && $_POST['password_input'] == $_POST['accept_password_input']) 
	{
	    $email_input= htmlspecialchars($_POST['email_input']);
		$password_input=htmlspecialchars($_POST['password_input']);
		$name_input=htmlspecialchars($_POST['name_input']);
	 	$surname_input=htmlspecialchars($_POST['surname_input']);
	 	$phone_number_input=htmlspecialchars($_POST['phone_number_input']);
	 	
	 	$query=mysqli_query($con, "SELECT * FROM `all_users` WHERE email='$email_input'");
	  	$numrows=mysqli_num_rows($query);
	if($numrows==0)
	   {
		$sql="INSERT INTO `all_users` (email, password, name, surname, phone, status)
		VALUES('$email_input', '$password_input', '$name_input', '$surname_input', '$phone_number_input', '0')";

	  $result=mysqli_query($con, $sql);
	 if($result){
		$message = "Account Successfully Created";
	} else {
	 $message = "Failed to insert data information!";
	  }
		} else {
		$message = "That username already exists! Please try another one!";
	   }
		} else {
		$message = "All fields are required!";
		}
	}
	?>

<?php if (!empty($message)) {echo "<p class='error'>" . "MESSAGE: ". $message . "</p>";}
	mysqli_close($con);
?>

		<?php
			//session_start();
		?> 
		<?php
		
		/*if(isset($_SESSION["session_username"])){
		// вывод "Session is set"; // в целях проверки
		header("Location: intropage.php");
		}

		if(isset($_POST["login"])){

		if(!empty($_POST['email_input']) && !empty($_POST['password'])) {
		$email_input=htmlspecialchars($_POST['email_input']);
		$password_input=htmlspecialchars($_POST['password_input']);
		$query =mysqli_query($con, "SELECT * FROM `all_users` WHEREusername='$email_input' AND password='$password_input'");
		$numrows=mysqli_num_rows($query);
		if($numrows!=0)
	 {
	while($row=mysqli_fetch_assoc($query))
	 {
		$dbusername=$row['email'];/
	  $dbpassword=$row['password'];
	 }
	  if($email == $dbusername && $password == $dbpassword)
	 {
		// старое место расположения
		//  session_start();
		 $_SESSION['session_username']=$email;	 
	   header("Location: intropage.php");
		}
		} else {
		//  $message = "Invalid username or password!";
		
		echo  "Invalid email or password!";
	 }
		} else {
	    $message = "All fields are required!";
		}
		}*/
		?>

	<!--
	<div id="container">
		<div id="main">
			<div id="maps">sdgsgs</div>
			<div class="map_wrapper">
				<div id="map"></div>
		  		<div id="inputs_cord">
		  			<form>
		  				<span><input type="text" name="x" id="cord_x" placeholder="первая корда"></span>
		  				<span><input type="text" name="y" id="cord_y" placeholder="вторая корда"></span>
		  				<span><input type="text" name="адрес" placeholder="Улица Пушкина, Дом колотушкина, ТулГу"></span>
		  				<span><input type="button" name="" value="Жми сука" id="map-btn"></span>
		  			</form>
		  		</div>
			</div>
		</div>
	</div>
	-->

<div id="container">
	<div class="wrapper" id="wrapper">
		<div class="header">

		<div class="logo"><img src="images/logotip.png" class="logo__img"/>
            <ul class="navbar">
                <li class="navbar__item"><a class="navbar__link navbar__link--active " href="#our_part">ПАРТНЕРЫ</a></li>
                <li class="navbar__item"><a class="navbar__link" href="#ras_pr">РАССЧИТАТЬ СТОИМОСТЬ</a></li>
                <li class="navbar__item"><a class="navbar__link" href="#contact_hr">КОНТАКТЫ</a></li>
            </ul>
        </div>

        <ul class="navbar">
            <div class="navbar__item nav-right"><li><a id="call-btn-go" data-fancybox data-src="#modal-form-call" class="navbar__link" style="padding-right: 0;" href="#">ОБРАТНЫЙ ЗВОНОК</a></li></div>
            <div class="navbar__item nav-right"><a id="auth-btn-go" data-fancybox data-src="#modal-form-auth" class="navbar__link" style="padding-right: 0;" href="#">АВТОРИЗАЦИЯ</a></div>
            <span class="navbar__item">/</span>
            <div class="navbar__item nav-right"><a id="reg-btn-go" data-fancybox data-src="#modal-form-reg" class="navbar__link" style="padding-right: 0;" href="#">РЕГИСТРАЦИЯ</a></div>
        </ul>

			<!--<nav class="navbar navbar-expand-lg navbar-white bg-white">
            <a class="navbar-brand" href="#"><img src="images/log.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon">Here</span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Контакты <span class="sr-only"></span></a>
                </li>

                <li class="nav-item active">
                        <a class="nav-link" href="#">Обратный звонок <span class="sr-only"></span></a>
                </li>

                <li class="nav-item active">
                    <button id="auth-btn-go" class="nav-link" data-fancybox data-src="#modal-form-auth" class="nav-link">Авторизация <span class="sr-only"></span></button>
                </li>

                <li class="nav-item active">
                    <button id="reg-btn-go" class="nav-link" data-fancybox data-src="#modal-form-reg">Регистрация <span class="sr-only"></span></button>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Поиск...." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Найти</button>
              </form>
            </div>
          </nav> -->
		</div>
		<div class="content">
			<!--Слайдер-->
			<div class="slider">
				<div class="swiper-container">
			        <div class="swiper-button-prev">
			        	<i class="fa fa-angle-left" aria-hidden="true"></i>
			        </div>
			        <div class="swiper-button-next">
			        	<i class="fa fa-angle-right" aria-hidden="true"></i>
			        </div>
			        <div class="swiper-wrapper">

			            <div class="swiper-slide" data-swiper-autoplay="10000"><img src="images/slide1.jpg"></div>
			            <div class="swiper-slide" data-swiper-autoplay="1000"><img src="images/slide2.jpg"></div>
			            <div class="swiper-slide" data-swiper-autoplay="10000"><img src="images/slide3.jpg"></div>
			        </div>
			        <div class="swiper-pagination">
			        	
			        </div>
			    </div>
			</div>
			<div class="services">
				<h1 class="title" id="our_part">Наши партнеры</h1>
    

        <div class="partners">

                <div class="container">

                        <div class="slider-part">
                          <div class="slider-part__wrapper">
                            <div class="slider-part__item">
                              <div class="slider-part__content">
                                <div class="slider-part__content_header">
                                  <img class="slider-part__content_img" src="images/ek2.jpg" alt="">
                                  <span class="slider-part__content_section">K-Rain</span>
                                </div>
                                <h2 class="slider-part__content_title">Андрей Сахаров, K-Rain</h2>
                                <div class="slider-part__content_footer">
                                  <div class="slider-part__content_avatar">
                                    <img class="slider-part__content_photo" src="https://static.stratege.ru/trophies/NPWR13650_00/TROP000.PNG" alt="">
                                  </div>
                                 

                                  
                                </div>
                              </div>
                            </div>
                            <div class="slider-part__item">
                              <div class="slider-part__content">
                                <div class="slider-part__content_header">
                                  <img class="slider-part__content_img" src="http://u.kanobu.ru/editor/images/45/1a4ef35c-1848-487a-841a-79f81438b009.jpg" alt="">
                                  <span class="slider-part__content_section">10/10</span>
                                </div>
                                <h2 class="slider-part__content_title">Tony Salologvinov</h2>
                                <div class="slider-part__content_footer">
                                  <div class="slider-part__content_avatar">
                                    <img class="slider-part__content_photo" src="https://static.stratege.ru/trophies/NPWR13650_00/TROP000.PNG" alt="">
                                  </div>
                                  
 
                                 
                                </div>
                              </div>
                            </div>
                            <div class="slider-part__item">
                              <div class="slider-part__content">
                                <div class="slider-part__content_header">
                                  <img class="slider-part__content_img" src="https://mvclip.ru/content/images/artists/3/c7207f56230b4952baa78ee6a7760c5d.jpg" alt="">
                                  <span class="slider-part__content_section">Stigmata</span>
                                </div>
                                <h2 class="slider-part__content_title">Горящий Сентябрь</h2>
                                <div class="slider-part__content_footer">
                                  <div class="slider-part__content_avatar">
                                    <img class="slider-part__content_photo" src="https://static.stratege.ru/trophies/NPWR13650_00/TROP000.PNG" alt="">
                                  </div>
                                  

                                  
                                </div>
                              </div>
                            </div>
                            <div class="slider-part__item">
                              <div class="slider-part__content">
                                <div class="slider-part__content_header">
                                  <img class="slider-part__content_img" src="https://fm.cnbc.com/applications/cnbc.com/resources/img/editorial/2018/09/07/105439429-1536353186931screen-shot-2018-09-07-at-4.45.51-pm.530x298.jpg?v=1536353260" alt="">
                                  <span class="slider-part__content_section">Tesla</span>
                                </div>
                                <h2 class="slider-part__content_title">Как мне такое? ОФигенно!</h2>
                                <div class="slider-part__content_footer">
                                  <div class="slider-part__content_avatar">
                                    <img class="slider-part__content_photo" src="https://static.stratege.ru/trophies/NPWR13650_00/TROP000.PNG" alt="">
                                  </div>
                                  
  
                                  
                                </div>
                              </div>
                            </div>
                            <div class="slider-part__item">
                              <div class="slider-part__content">
                                <div class="slider-part__content_header">
                                  <img class="slider-part__content_img" src="https://medialeaks.ru/wp-content/uploads/2019/06/cover4.jpg" alt="">
                                  <span class="slider-part__content_section">Cyber77</span>
                                </div>
                                <h2 class="slider-part__content_title">Вкусный лимонад в жаркий день</h2>
                                <div class="slider-part__content_footer">
                                  <div class="slider-part__content_avatar">
                                    <img class="slider-part__content_photo" src="https://static.stratege.ru/trophies/NPWR13650_00/TROP000.PNG" alt="">
                                  </div>
                                 
                  
                                  
                                </div>
                              </div>
                            </div>
                            <div class="slider-part__item">
                              <div class="slider-part__content">
                                <div class="slider-part__content_header">
                                  <img class="slider-part__content_img" src="images/ekspert.jpg" alt="">
                                  <span class="slider-part__content_section">Совет эксперта из ДДП</span>
                                </div>
                                <h2 class="slider-part__content_title">Тихий Огонек моей души</h2>
                                <div class="slider-part__content_footer">
                                  <div class="slider-part__content_avatar">
                                    <img class="slider-part__content_photo" src="https://static.stratege.ru/trophies/NPWR13650_00/TROP000.PNG">
                                  </div>
                                  
                       
                                  
                                </div>
                              </div>
                            </div>
                            <div class="slider-part__item">
                              <div class="slider-part__content">
                                <div class="slider-part__content_header">
                                  <img class="slider-part__content_img" src="https://i.playground.ru/i/blog/238428/content/2t8gy0fh.jpg" alt="">
                                  <span class="slider-part__content_section"><a id="skyrim" target="_blank" href="https://elderscrolls.bethesda.net/ru/skyrim">КУПИ</a></span>
                                </div>
                                <h2 class="slider-part__content_title">Купил Скайрим???</h2>
                                <div class="slider-part__content_footer">
                                  <div class="slider-part__content_avatar">
                                    <img class="slider-part__content_photo" src="https://static.stratege.ru/trophies/NPWR13650_00/TROP000.PNG" alt="">
                                  </div>
                                  
                               
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                          <a class="slider-part__control slider-part__control_left" href="#" role="button"></a>
                          <a class="slider-part__control slider-part__control_right" href="#" role="button"></a>
                        </div>
                    
                      </div>
                      </div>
</div>
			
			<h1 class="title" id="ras_pr" style="margin-bottom: 0px;">Рассчитать примерную стоимость</h1>
			<div class="price">
				<div>
					<form class="form">
						<p>Укажите массу груза</p>
						<input type="text" id="mass" name="mass" placeholder="Масса груза (т)">
						<p>Укажите дату</p>
						<input id="date" type="text" name="date" placeholder="Дата">

						<p>Груз хрупкий или обычный?</p>
						<input id="standart_gruz" type="radio" name="group1" value="Обычный" checked> <span>Обычный</span>
						<input id="hrupkiy_gruz" type="radio" name="group1" value="Хрупкий"> <span>Хрупкий</span>

						<p>Требуется ли сопровождение охраны?</p>
						<input id="ohr_yes" type="radio" name="group4" value="Да" checked><span>Да</span>
						<input id="ohr_no" type="radio" name="group4" value="Нет"> <span>Нет</span>

						<p>Нужны ли услуги грузчиков?</p>
						<input id="gruz_yes" type="radio" name="group2" value="Да" checked><span>Да</span>
						<input id="gruz_no" type="radio" name="group2" value="Нет"> <span>Нет</span>

						<p>Понадобится ли для погрузки спецтехника</p>
						<input id="spec_yes" class="group3" type="radio" name="group3" value="Да" checked><span>Да</span>
						<input class="group3" type="radio" name="group3" value="Нет"><span>Нет</span>

						<p>Для перехода к указанию начальной и конечной точки маршрута нажмите на кнопку</p>
						<input id="price-btn" type="button" name="price-btn" value="Перейти">

					</form>	
				</div>..
				<div id="maps" class="map"></div>
			</div>
		</div>
		<div class="footer">
            <div class="menu">
                <p class="menu__title"><a href="#" id="contact_hr" class="menu__link">Контакты</a></p>
                <a href="#" class="menu__link">8-800-555-35-35</a>


            </div>
            <div class="menu">
                <p class="menu__title"><a href="#" class="menu__link">О нас</a></p>
                <a href="#" class="menu__link">Наш адрес</a>
                <a href="#" class="menu__link">Вакансии</a>
                <a href="#" class="menu__link">Партнеры</a>
                

            </div>
            
            <div class="menu">
                <p class="menu__title"><a href="#" class="menu__link">Заказать доставку</a></p>
                <a href="#" class="menu__link">Рассчитать стоимость</a>
                <a href="#" class="menu__link">Регистрация</a>
                <a href="#" class="menu__link">Авторизация</a>
            </div>
            <div class="menu">
                <p class="menu__row">
                    <a href="https://www.instagram.com/todd.bethesda/"> <img src="https://icon2.kisspng.com/20171220/iee/instagram-png-logo-5a3a21744805b9.4072373415137590922953722.jpg" /></a>
                    <a href=""> <img src="https://png.icons8.com/metro/1600/vk-com.png" /></a>
                    <a href=""> <img src="https://png.icons8.com/metro/1600/facebook.png" /></a>
    
                </p>
                
           
            </div>
		</div>
	</div>

</div>







	<!--Форма регистрации-->
	<form method="post" action="" class="form-reg" id="modal-form-reg" style="display:none;">
	    <div class="form-reg-wrapper">
	      <div class="labels">
	        <p>E-mail *</p>
	        <p>Пароль *</p>
	        <p>Подтверждение пароля *</p>
	        <p>Имя *</p>
	        <p>Фамилия</p>
	        <p>Телефон</p>
	      </div>
	      <div class="inputs">
	        <span><input type="text" name="email_input" class="text_input"></span>
	        <span><input type="password" name="password_input" class="password_input" id="view1_input"><input class="img_view" type="button" name="view1" id="view1_btn"></span>
	        <span><input type="password" name="accept_password_input" class="password_input" id="view2_input"><input class="img_view" type="button" name="view2" id="view2_btn"></span>
	        <span><input type="text" name="name_input" class="text_input"></span>
	        <span><input type="text" name="surname_input" class="text_input"></span>
	        <span><input type="text" name="phone_number_input" placeholder="+7 (999) 999 99 99" id="phone" class="text_input"></span>
	      </div>
	    </div>

	    <div class="accept_agreement_div"><input type="checkbox" checked> <span>СОГЛАСЕН С </span><a href="#">УСЛОВИЯМИ ОБРАОБОТКИ ПЕРСОНАЛЬНЫХ ДАННЫХ</a></div>
	    <input type="submit" class="reg-btn" name="registration" value="ЗАРЕГИСТРИРОВАТЬСЯ">
	    <?/*php if (!empty($message)) {echo "<p class='error'>" . "MESSAGE: ". $message . "</p>";}
			mysqli_close($con)*/;
		?>
	    <p class="footer_p">* Поля, обязательные для заполнения</p>
  	</form>

  	<!--Форма авторизации-->
	<form method="post" action="sendmail.php" class="form-auth" id="modal-form-auth" style="display:none;">
	    <div class="form-auth-wrapper">
	      <div class="labels">
	        <p style="margin-right: 100px">E-mail</p>
	        <p>Пароль</p>
	      </div>
	      <div class="inputs">
	        <span><input type="text" name="email_input" class="text_input"></span>
	        <span><input type="password" name="password_input3" class="password_input" id="view3_input"><input class="img_view" type="button" name="view3" id="view3_btn"></span>
	      </div>
	    </div>

	    <input type="submit" class="auth-btn" name="login" value="АВТОРИЗОВАТЬСЯ">
  	</form>

  	<!--Форма обратного звонка-->
	<form method="post" action="" class="form-call" id="modal-form-call" style="display:none;">
	    <div class="form-call-wrapper">
	      <div class="labels">
	        <p>Ваше имя *</p>
	        <p>Номер мобильного телефона *</p>
	      </div>
	      <div class="inputs">
	        <span><input type="text" name="name1_input" class="text_input"></span>
	        <span><input type="text" placeholder="+7 (999) 999 99 99" name="phone_call_input" class="text_input" id="phone_call_input"></span>
	      </div>
	    </div>

	    <div class="accept_agreement_div"><input type="checkbox" checked> <span>СОГЛАСЕН С </span><a href="#">УСЛОВИЯМИ ОБРАБОТКИ ПЕРСОНАЛЬНЫХ ДАННЫХ</a></div>

	    <input type="submit" class="call-btn" name="call" value="Заказать звонок"> <!--data-fancybox data-src="#modal-form-res-call"-->
  	</form>

  	<!--Форма результата (обратный звонок)-->
	<form method="post" action="" class="form-call" id="modal-form-res-call" style="display:none;">
	    <div class="form-call-res-wrapper">
	      <p>Вам перезвонят</p>
	      <p>Наверное</p>
	    </div>

	    <input type="submit" class="accept-btn" name="call" value="Принять">
  	</form>

  	<?php
  		if(isset($_POST["call"]))
  		{
  			$name= htmlspecialchars($_POST['name1_input']);
			$phone=htmlspecialchars($_POST['phone_call_input']);
			//Первый параметр - почта получателя письма
			$res = mail('vadimpwnz228@gmail.com', 'Заказан обратный звонок!', "Имя: $name; Номер телефона: $phone.", 'From: gruzoperevozki.world@gmail.com');
  		}
	?>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="slider-part.js"></script>
 <script src="mask/dist/jquery.maskedinput.min.js"></script>

</body>
</html>