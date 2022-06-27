<?php
//https://gokisoft.com/share-code-huong-dan-login-multi-platform-login-multi-devices-multi-browsers-session--cookie-trong-lap-trinh-phpmysql.html#dbhelper-php
//$sql = "insert into Role(name) values ('Admin')";
//$sql = "insert into Role(name) values ('$name')"; => $name = 'Admin => sql injection => join => framework (Laravel) => fix
//$name = 'Admin => \'Admin
//fix sql injection => $sql = "ghi cau lenh sql vao"
function fixSqlInject($sql) {
	$sql = str_replace('\\', '\\\\', $sql);
	$sql = str_replace('\'', '\\\'', $sql);
	return $sql;
}

function getGet($key) {
	$value = '';
	if(isset($_GET[$key])) {
		$value = $_GET[$key];
		$value = fixSqlInject($value);
	}
	return trim($value);
}

function getPost($key) {
	$value = '';
	if(isset($_POST[$key])) {
		$value = $_POST[$key];
		$value = fixSqlInject($value);
	}
	return trim($value);
}

function getRequest($key) {
	$value = '';
	if(isset($_REQUEST[$key])) {
		$value = $_REQUEST[$key];
		$value = fixSqlInject($value);
	}
	return trim($value);
}

function getCookie($key) {
	$value = '';
	if(isset($_COOKIE[$key])) {
		$value = $_COOKIE[$key];
		$value = fixSqlInject($value);
	}
	return trim($value);
}

function getSecurityMD5($pwd) {
	return md5(md5($pwd).PRIVATE_KEY);
}
   
function getUserTokens(){
	if(isset($_SESSION['user'])){
		// Người này đang đăng nhập thành công
		return $_SESSION['user'];
	}
	$token = getCookie('token');
	$sql = " select * from tokens where token = '$token'";
	$item = executeResult($sql, true);
	if($item != null){
		$userId = $item['user_id'];
		$sql = "select * from user where id = '$userId' and deleted = 0";
		$item = executeResult($sql, true);
		if($item != null){
			$_SESSION['user'] = $item;
			return $item;
		}
	}
	return null;
}