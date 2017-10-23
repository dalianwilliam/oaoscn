<?php
require("conn.php");
class login extends conn{

	function __construct(){
		if(isset($_SESSION["uname"]) and $_SESSION["uname"]!=''){
			header("location:/index.php");
		}
		parent::__construct();
		
		if(isset($_POST["chuangjian"]) and $_POST["chuangjian"]=='创建一个账号'){
			$this->mycreateaccount();
		}
		if(isset($_POST["denglu"]) and $_POST["denglu"]=='登录'){
			$this->mylogin();
		}
		
	}
	
	function mytop(){
		require("public_top.php");
		public_top::mytop();
	}
	function mylogin(){
		$uname=parent::jctitle($_POST["uname"]);
		$mima=parent::jctitle($_POST["mima"]);
		$gps=parent::jctitle($_POST["gps"]);
		
		if($uname=='' or $mima=='' ){
			echo "<script>alert('用户名和密码必须填写');window.location.href='login.php'</script>";
			exit();
		}
		$mima=md5($mima);
		
		$jt=date("Y-m-d");
		$info=mysql_fetch_array(mysql_query("select id from sns_huiyuan where zhanghao='$uname' and mima='$mima'"));
		if($info){
			$_SESSION["uid"]=$info["id"];
			$id=$info["id"];
			$_SESSION["uname"]=$uname;
			$times=date("Y-m-d H:i:s");
			if($gps!=''){
				mysql_query("insert into sns_huiyuangps (uid,mygps,times) values ($id,'$gps','$times')");
			}
			echo "<script>alert('登录成功');window.location.href='index.php'</script>";
		}else{
			echo "<script>alert('登录失败');window.location.href='login.php'</script>";
		}
	}
	function mycreateaccount(){
		$uname=parent::jctitle($_POST["uname"]);
		$mima=parent::jctitle($_POST["mima"]);
		$mimas=parent::jctitle($_POST["mimas"]);
		$quequan=parent::jctitle($_POST["quequan"]);
		
		$zz="/^[a-z\d]+(\.[a-z\d]+)*@([\da-z](-[\da-z])?)+(\.{1,2}[a-z]+)+$/";
		preg_match($zz,$uname,$rs);
		if(!isset($rs[0]) and $rs[0]==''){
			exit("<script>alert('电子邮件填写错误');window.location.href='login.php'</script>");
		}

		if($uname=='' or $mima!=$mimas or $quequan=='' or $quequan!=$_SESSION["qqmm"]){
			exit("<script>alert('用户名和密码必须认真填写');window.location.href='login.php'</script>");
		}

		$mima=md5($mima);
		
		$info=mysql_fetch_array(mysql_query("select id from sns_huiyuan where zhanghao='$uname'"));
		if($info){
			echo "<script>alert('用户名已经存在，请更换一个');window.location.href='login.php'</script>";
		}else{
			$times=date("Y-m-d H:i:s");
			
			mysql_query("insert into sns_huiyuan (zhanghao,mima,times) values ('$uname','$mima','$times')");
			$_SESSION["uname"]=$uname;
			$in=mysql_fetch_array(mysql_query("select id from sns_huiyuan where times='$times'"));
			$_SESSION["uid"]=$in["id"];
			unset($_SESSION["qqmm"]);
			echo "<script>alert('注册成功');window.location.href='index.php'</script>";
		}

	}

}
?>