﻿<!doctype html>
<html lang="ru">
<head>
    <link rel="stylesheet" type="text/css" href="/style/style.css">
	<link type="text/css" rel="stylesheet" href="/style/easy-responsive-tabs.css" />
    <meta charset="UTF-8" />
    <title><?php echo $title; ?></title>
	
	<link rel="icon" href="/img/favicon2.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/img/favicon2.ico" type="image/x-icon">
	
	<script src="/view/jquery-2.1.3.min.js" type="text/javascript"></script>
	<script src="/view/chosen.jquery.js" type="text/javascript"></script>
	<script src="/view/easyResponsiveTabs.js" type="text/javascript"></script>
	<link href="/view/chosen.css" rel="stylesheet">
	
	<script src="//vk.com/js/api/openapi.js" type="text/javascript" charset="windows-1251"></script>
	
	<link rel="icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	
	
</head>

<body>

<script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
<script type="text/javascript">
  VK.init({
    apiId: 4868693,
    onlyWidgets: true
  });
</script>




<header>
	<!--<div class=line> </div>-->
    <div class="panel">
	<div class="wrap">
	<div class="main-logo"><img src="/img/alpha150kh70.png" alt="logo"></img></div>
	<?php 
			$login = $_SESSION["login"];
			$result = call("SELECT * FROM `user` WHERE `email`='$login'");
			if((isset($_SESSION["login"]) && isset($_SESSION["keys"])) && ($_SESSION["login"] == $result[0]["email"] && $_SESSION["keys"] == $result[0]["keys"])) {
				echo "<a id='login_pop' href='/profile/".$_SESSION["login"]."'>".$_SESSION["login"]."</a> <a id='login_pop' href='/layout/exit' > выйти </a>";
			} else { echo '
			<a href="#login_form" id="login_pop">Войти</a>
			<a href="#join_form" id="join_pop">Зарегистрироваться</a>
			';} ?>
        
    </div>
	</div>
<div class="logo">
<img src="/img/siteimg/logo3.jpg" alt="logo">
</div>
		<div id=menu> 
         <ul id="nav" align=center>
                <li><a href="/">Главная</a></li>
                <!--li><a class="hsubs" href="#">Меню 3</a>
                    <ul class="subs">
                        <li><a href="#">Подменю 3-1</a></li>
                        <li><a href="#">Подменю 3-2</a></li>
                        <li><a href="#">Подменю 3-3</a></li>
                        <li><a href="#">Подменю 3-4</a></li>
                        <li><a href="#">Подменю 3-5</a></li>
                    </ul>
                </li-->
                <li><a href="/tournaments">Турниры</a></li>
                <li><a href="/help">Help</a></li>
				<li><a href="/news">News</a></li>
                <div id="lavalamp"></div>
            </ul>
		</div>
</header>

<div id=content>
	<div class=visibility>
		<?php echo $content;
		//echo print_r(call("SELECT * FROM `links`"));
		?>
	</div>
</div>
<footer class="foot">
	<div class="wrap">
		<span>WTW Digital</span>
	</div>
</footer>
</body>


<!-- popup form #1 -->
<a href="#x" class="overlay" id="login_form"></a>
<div class="popup">
	<form method="post" action="/authentication" id="authform" name="authform">
    <div class="field auth">
        <label for="login">Логин</label>
        <input type="email" id="login" name="email"/>
    </div>
    <div class="field auth">
        <label for="password">Пароль</label>
        <input type="password" name="pass" id="password"/>
    </div>
    <input name="sub" type="submit"  value="Sing in">

    <a class="close" href="#close"></a>
	</form>
</div>

<!-- popup form #2 -->
<form method="post" action="/authentication">
<a href="#x" class="overlay" id="join_form"></a>
<div class="popup">
    <div class="field auth">
        <label for="email">Логин (Email)</label>
        <input type="email" id="email" name="email" autofocus="autofocus" placeholder="e-mail@email.com" required />
    </div>
    <div class="field auth">
        <label for="pass">Пароль</label>
        <input type="password" name="pass" id="pass" placeholder="password" required />
    </div>
    <div class="field auth">
        <label for="pass">Повторите</label>
        <input type="password" name="pass2" id="pass" placeholder="password" required />
    </div>
    <div class="field auth">
        <label for="firstname">Имя</label>
        <input type="text" id="firstname" name="name" placeholder="name" required />
    </div>
    <div class="field auth">
        <label for="lastname">Игра</label>
		
    <div class="second-column-block-element">

		<select name="game[]" data-placeholder="Line" class="chosen-select" multiple style="width:300px;" tabindex="1" required>
					<?php 
					$result = call("SELECT * FROM `game`");
					foreach($result as $value) { 
					echo "<option value='".$value['game']."' ".$value['status'].">".$value['game']."</option>";
					}
					?>
		</select>
	</div>	
	
    </div>
    <input name="sub" type="submit" value="Sing up">&nbsp;&nbsp;&nbsp;или&nbsp;&nbsp;&nbsp;<a href="#login_form" id="login_pop">Войти</a>

    <a class="close" href="#close"></a>
</div>
</form>

<script type="text/javascript">
    var config = {
      '.chosen-select'           : {max_selected_options: 6},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
	  $(".chosen-select").chosen({width: '350px'});
    }
  </script>
  
<script type="text/javascript">
		$("#demoTab").easyResponsiveTabs({
			type: 'accordion', //Типы: default, vertical, accordion      
			width: 'auto', //auto или любое значение ширины
			fit: true,   // 100% пространства занимает в контейнере
			activate: function() {} // Функция обратного вызова, используется, когда происходит переключение вкладок
			});
</script>

</html>