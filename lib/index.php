<?php
require("conn.php");
require("public_date.php");
require("public_uname.php");
class index extends conn{
	function __construct(){
		parent::__construct();
		parent::myips();
	}

	function mytop(){
		require("public_top.php");
		public_top::mytop();
	}

	function mytjlist(){
		require_once("public_fenye.php");
		require_once("public_touxiang.php");
		$sjk   = "sns_articles where tj='1'";
		$meiye = "8";
		$paixu = "times";
		$ziduan="uid,bh,newsbt,times";
		$sql=public_fenye::mylist($ziduan,$sjk,$meiye,$paixu);
		$info=mysql_fetch_array($sql);
		if($info){
			do{
				echo "<li>";
				public_touxiang::mytouxiang($info["uid"],26,30);
				echo "<span class='dla pda'>";
				public_uname::myuname($info["uid"]);
				echo "</span><br/><a href='msg.php?i=".$info["bh"]."'>".$info["newsbt"]."</a><div>";
				echo public_date::mystrdate($info["times"]); 
				echo "</div></li>";
			}while($info=mysql_fetch_array($sql));
		}
	}

	function mytopkey(){
		require("public_search.php");
		public_search::mytopkey();
	}

	function mytjblog(){
		include("public_tjblog.php");
		public_tjblog::mytjblog();
	}
}
?>