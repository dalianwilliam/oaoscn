<?php
require("conn.php");
class mysetmima extends conn{
	function __construct(){
		parent::__construct();
		parent::isquanxian();
		if(isset($_POST["tijiao"]) and $_POST["tijiao"]=='修改'){
			$this->mymodmima($_POST["ymima"],$_POST["xmima"],$_POST["xmimas"]);
		}
	}

	function mymodmima($ymima,$xmima,$xmimas){
		if(empty($ymima) or empty($xmima) or empty($xmima) or $xmima!=$xmimas){
			echo "<script>alert('请认真填写所有字段');window.location.href='mysetmima.php'</script>";
			//header("location:/my/mysetmima.php");
			//exit();
		}else{
			$uid=$_SESSION["uid"];
			$ymima=md5($ymima);
			$info=mysql_fetch_array(mysql_query("select id from sns_huiyuan where id=$uid and mima='$ymima'"));
			if(!$info){
				echo "<script>alert('原密码错误');window.location.href='mysetmima.php'</script>";
			}else{
				$xmima=md5($xmima);
				$sql=mysql_query("update sns_huiyuan set mima='$xmima' where id=".$uid);
				if($sql){
					echo "<script>alert('修改成功');window.location.href='mysetmima.php'</script>";
				}else{
					echo "<script>alert('修改失败');window.location.href='mysetmima.php'</script>";
				}
			}
		}
	}

	function mytop(){
		require("public_top.php");
		public_top::mytop();
	}
}
?>