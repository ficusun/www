<?php
if($_POST['sub']=='Sing in'){

		$login = che($_POST['email']);		
		$password = che($_POST['pass']);
		$security='zagadka';
		$password= md5("$password$security");
		$result = call("SELECT * FROM `user` WHERE `email`='$login'");
		
		if ($password == $result[0]['pass']){
			
			$d = date('Y m d H i s');
			$keys = "$password$d";
			$keys = md5("$keys");
			$_SESSION["keys"]=$keys;
			$_SESSION["login"]=$login;
			$_SESSION['nicgame']=$result[0]['nicgame'];
			$_SESSION['id']=$result[0]['id'];
			$_SESSION["ip"]=$ip;
			
			$res = put("UPDATE `user` SET `keys`='$keys' WHERE `email`='$login'");
			
			if ($res){$messegError['codeError'] = 7; $messegError['relode'] = true; }// смс приветствия 
			
			//echo '<script>window.location.href = "/" </script>'; // перенаправление
		} else {$messegError['codeError'] = 8; $messegError['relode'] = false;}
}


/*
if($_POST['sub']=='Sing in'){

	if(!isset($_COOKIE["timesError"]) and !isset($_COOKIE["CheckIp"])){
		if($_COOKIE["timesError"] == null and $_COOKIE["CheckIp"] == null){
			echo $ip;
			$resultcount = 0;
			setcookie("CheckIp", $ip, time()+300 , '/');
		}
	}
	
	if(isset($_COOKIE["timesError"]) and $_COOKIE["timesError"] <= 5){
		
		if($_COOKIE["CheckIp"]==$ip){
			
			$login = $_POST['email'];
			
			$password = $_POST['pass'];

			$login = che($login);
			
			$password = che($password);
		
			$security='zagadka';
			
			$password= md5("$password$security");
		
			$result = call("SELECT * FROM `user` WHERE `email`='$login'");
		
			if ($password == $result[0]['pass']){	
			
				$d = date('Y m d H i s');
				
				$keys = "$password$d";
				
				$keys = md5("$keys");
				
				$_SESSION["keys"]=$keys;
				
				$_SESSION["login"]=$login;
				
				$_SESSION["ip"]=$ip;
				
				$res = put("UPDATE `user` SET `keys`='$keys' WHERE `email`='$login'");
				
				if ($res){ echo '<script>alert("Добро пожаловать");</script>';}// смс приветствия
				
				unset($resultcount);
				
				setcookie ("timesError", "", time()-300 , '/');
				
				setcookie ("CheckIp", "", time()-300 , '/');
				
				echo '<script>window.location.href = "/" </script>'; // перенаправление
				
				} else {
					
					$resultcount++;
					
					setcookie ("timesError", $resultcount, time()+300, '/');
					
					$count=6-$resultcount;
					
					$result['passErrorSingIn'] = "Неверный пароль, у Вас осталось $count";
					
				}
				
			} else {
				
				if($_COOKIE["CheckIp"] != $ip and $_COOKIE["timesError"]>0) {
					
					$count = $_COOKIE['CheckIp'];
					
					$result['passErrorSingIn'] = "Извините, наша система обнаружила что ваш IP был изменен, при том что вы использовали $count попыток, по этому наша система безопасности временно блокирует вам возможность авторизоваться на 30 минут. Безопастность прежде всего. С Ув.Администрация!";
					
					if($_COOKIE["timesError"] == 9){
						
					} else {
						setcookie ("timesError", "", time()-300 , '/');
						setcookie ("timesError", 9, time()+1500, '/');
					}
				}
				
			}
			
		} elseif(isset($_COOKIE["timesError"]) and $_COOKIE["timesError"] >= 5) {
			
			if($_COOKIE["CheckIp"]==$ip){
				
			$result['passErrorSingIn'] = 'Извините, Вы превысили количество попыток, пожалуйста подождите 5 минут';
			
			} else {
				
				if($_COOKIE["CheckIp"] != $ip and $_COOKIE["timesError"] > 0) {
					
					$count = $_COOKIE['CheckIp'];
					
					$result['passErrorSingIn'] = "Извините, наша система обнаружила что ваш IP был изменен, при том что вы использовали $count попыток, по этому наша система безопасности временно блокирует вам возможность авторизоваться на 30 минут. Безопастность прежде всего. С Ув.Администрация!";
					
					if($_COOKIE["timesError"] == 9){
						
					} else {
						setcookie ("timesError", "", time()-300 , '/');
						setcookie ("timesError", 9, time()+1500, '/');
					}
				} 
			}
			
		} else {
			
		$login = $_POST['email'];
		
		$password = $_POST['pass'];

		$login = che($login);
		
		$password = che($password);
		
		$security='zagadka';
		
		$password= md5("$password$security");
		
		$result = call("SELECT * FROM `user` WHERE `email`='$login'");
		
		if ($password == $result[0]['pass']){
			
			$d = date('Y m d H i s');
			
			$keys = "$password$d";
			
			$keys = md5("$keys");
			
			$_SESSION["keys"]=$keys;
			
			$_SESSION["login"]=$login;
			
			$_SESSION["ip"]=$ip;
			
			$res = put("UPDATE `user` SET `keys`='$keys' WHERE `email`='$login'");
			
			if ($res){$result['passErrorSingIn'] = '<script>alert("Добро пожаловать");</script>'; }// смс приветствия 
			
			unset($resultcount);
			
			setcookie ("timesError", "", time()-300 , '/');
			
			setcookie ("CheckIp", "", time()-300 , '/');
			
			echo '<script>window.location.href = "/" </script>'; // перенаправление
			
		} else {
			
			$resultcount++;
			
			setcookie ("timesError", $resultcount, time()+300, '/');
			
			$count=6-$resultcount;
			
			$result['passErrorSingIn'] = "Неверный пароль, У вас осталось $count";
		}
	}
}
*/
	
	if($_POST['sub']=='Sing up'){
		
		$password = che($_POST['pass']);
		
		$password2 = che($_POST['pass2']);
		
		$email = che($_POST['email']);
		
		$name = che($_POST['name']);
		
		$game = $_POST['game'];
		
		$regd = date('Y-m-d');
		$key = rand();
		$key = md5("$key");
		$game=json_encode($game);
		


		
		if ($password == $password2) { 
		
				$result = call("SELECT * FROM `user` WHERE `email`='$email'");
				
				if ($result[0] == false){
					
						$security='zagadka';						
						$password= md5("$password$security");						
						$res = put("INSERT INTO `user` (`email`, `pass`, `name`, `game`, `dreg`, `key`, `status`) values ('$email', '$password', '$name', '$game', '$regd', '$key', '0')");
						if ($res){
						$to  = "$email"; 
						$subject = "Активация аккаунта"; 
						$message = "код активации - $key"; 
						$from = 'admin@prze.ru';
						$er=mail($to, $subject, $message, 'From:'.$from);
						if($er){
							$messegError['codeError'] = 18; $messegError['relode'] = false;
						} else {$messegError['codeError'] = 19; $messegError['relode'] = false;}
						
						$messegError['codeError'] = 9; $messegError['relode'] = true;
						
						} else {$messegError['codeError'] = 10; $messegError['relode'] = false;}
				} else {$messegError['codeError'] = 11; $messegError['relode'] = false;}
		} else {$messegError['codeError'] = 12; $messegError['relode'] = false;}
	}

$result2=$messegError;
	
$title = "Главная страница";
$content = index('index',$result,$result2);
?>