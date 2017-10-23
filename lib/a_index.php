<?php
require("conn.php");
class a_index extends conn{
	function __construct(){
		parent::__construct();
		if(isset($_GET["aq"]) and $_GET["aq"]=='tc'){
			$this->tuichu();
		}
	}

	//判断管理员权限
	function isquanxian(){
		if(empty($_SESSION["zhanghu"]) or $_SESSION["zhanghu"]==''){
			exit("<script>window.location.href='../index.php'</script>");
		}
	}
	//管理员退出
	function tuichu(){
		unset($_SESSION["zhanghu"]); //将变量清空
		session_destroy(); // 将所有SESSION清空
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		echo "<script>alert('您已经安全退出了');window.location.href='../index.php'</script>";
	}
}
?>