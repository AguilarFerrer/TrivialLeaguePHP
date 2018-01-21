<?php
//This function is used to redirect the user to another page.
function redirect ($page = 'index.php') {
	//Generates the url.
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	$url .= '/' . $page;
	//Directs the user into the introduced url.
	header("Location: $url");
	exit();
}
?>
