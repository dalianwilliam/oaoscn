<?php
require("conn.php");
class a_login extends conn{
	function __construct(){
		parent::__construct();
		if(isset($_POST["denglu"]) and $_POST["denglu"]=="登陆"){	
			$this->mydenglu();
		}
	}

	function mydenglu(){
		$yha=parent::jctitle($_POST["yha"]);
		$yhb=parent::jctitle($_POST["yhb"]);

		if($yha!='' and $yhb!=''){
			
			$sql=mysql_query("select * from a_zhanghu where uname='$yha' and mima='$yhb'");
			$info=mysql_fetch_array($sql);
			if($info){
				$_SESSION["zhanghu"]=$info["uname"];
				
				header("location:/admini/index.php");
			}else{
				echo "<script>alert('没有该用户');window.locaton.href='login.php'</script>";
			}
		}
	}
}
?>