<?php
session_start();
//core file
include('config.php');
include('/core/authentication.php');

$ip=$_SERVER['REMOTE_ADDR'];
/*
ini_set('display_errors','On');
error_reporting(E_ALL|E_STRICT);
*/
function messegErrors($messegError){
	$errors = call("SELECT * FROM `error`");
		foreach($errors as $value){ 
			if($value['numberError'] == $messegError['codeError'] and $messegError['relode']==true){
				//echo $value['textError'];
				echo "<script>document.location.href = document.location.href;</script>";
			} elseif($value['numberError'] == $messegError['codeError'] and $messegError['relode']==false) {
				echo "code:".$value['numberError']." ".$value['textError'];
		}
	}
}

function che($result){
	$result = stripslashes($result);
	$result = mysql_real_escape_string($result);
	$result = htmlspecialchars($result);
	$result = trim($result);
	return $result;
}

function call($query) { //SELECT * FROM `ad` WHERE `id`='$id'
	$return;
	$result=mysql_query($query) or $return = FALSE;
	if(mysql_num_rows($result)==0) {
		$return = FALSE;
	}
	else while($row = mysql_fetch_array($result)) $return[] = $row;
	return $return;
}

function checkCounts($query) { //SELECT * FROM `ad` WHERE `id`='$id'
	$result=mysql_query($query) or $return = FALSE;
	$result=mysql_num_rows($result);
	$return=$result;
	return $return;
}

function put($query) { //INSERT INTO `name` (`name`) values ('$name')
	$return = TRUE;
	mysql_query($query) or $return = FALSE;
	return $return;
}

function error() {
	ob_end_clean();
	include('error.php');
	exit;
}

function index($name,$result='',$result2='',$result3='',$messegError='') {
	$path = 'view/'.$name.'.php';
	ob_start();
	if(!include($path)) error();
	return ob_get_clean();
}

function clear($value) {
	$value = trim($value); 
	$value = mysql_real_escape_string($value);
	$value = htmlspecialchars($value);
	return $value;
}

//routing
$priQuery = explode("/",clear($_GET["alpha"]));
$query = $priQuery;

if($query[0] != '') {
	$controller = $query[0];
	unset($query[0]);
	$action = array_values($query);
} else $controller = 'general';

//loading
$controllPath = 'core/'.$controller.'.php';
if(file_exists($controllPath)){
	include($controllPath);
} else {
	echo 'все плохо';
	//error();
}

include('view/layout.php');
