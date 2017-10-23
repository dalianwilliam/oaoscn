<?php
require_once("conn.php");
require_once("public_date.php");
class indexloadmore extends conn {

	function __construct(){
		parent::__construct();
		if(isset($_GET["page"]) and $_GET["page"]!=''){
			$this->myloadmore();
		}
	}

	function myloadmore(){
		require_once("public_fenye.php");
		require_once("public_touxiang.php");
		$sjk   = "sns_articles where tj='1'";
		$meiye = "8";
		$paixu = "times";
		$ziduan="uid,bh,newsbt,times";
		$sql=public_fenye::mylist($ziduan,$sjk,$meiye,$paixu);
		if($this->zpages>$_GET["page"]){
			$info=mysql_fetch_array($sql);
			if($info){
				do{
					echo "<li>";
					public_touxiang::mytouxiang($info["uid"],26,30);
					echo "<span class='dla'>";
					public_uname::myuname($info["uid"]);
					echo "</span><br/><a href='msg.php?i=".$info["bh"]."'>".$info["newsbt"]."</a><div>";
					echo public_date::mystrdate($info["times"]); 
					echo "</div></li>";
				}while($info=mysql_fetch_array($sql));
			}		
		}else if($this->zpages==$_GET["page"]){
			$info=mysql_fetch_array($sql);
			if($info){
				do{
					echo "<li>";
					public_touxiang::mytouxiang($info["uid"],26,30);
					echo "<span class='dla'>";
					public_uname::myuname($info["uid"]);
					echo "</span><br/><a href='msg.php?i=".$info["bh"]."'>".$info["newsbt"]."</a><div>";
					echo public_date::mystrdate($info["times"]); 
					echo "</div></li>";
				}while($info=mysql_fetch_array($sql));
			}
			echo "没有信息了";
		}
	}
}
?>