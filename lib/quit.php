<?php
class quit{

	function __construct(){
		$this->myquit();
	}

	function myquit(){
		unset($_SESSION["uname"]);
		unset($_SESSION["uid"]);
		session_decode();
		header("location:/index.php");
	}
}
?>