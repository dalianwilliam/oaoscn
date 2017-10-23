<?php
require("conn.php");
require_once("public_fenye.php");
class category extends conn{

	function __construct(){
		parent::__construct();
		$this->id=parent::jctitle($_GET["ci"]);
	}

	function mytop(){
		require("public_top.php");
		public_top::mytop();
	}

	function mytopkey(){
		public_search::mytopkey();
	}

	function mynextnews($id){
		$sql=mysql_query("select bh,newsbt from sns_articles where id < $id order by id desc limit 0,4");
		$info=mysql_fetch_array($sql);
		if($info){
			echo '<div class="pda lbb xiana">';
			echo "<li class='bta'>LEARNING</li>";
			do{
				echo "<a href='".LOCAL."msg.php?i=".$info["bh"]."'><li>".$info["newsbt"]."</li></a>";
			}while($info=mysql_fetch_array($sql));
			echo "</div>";
		}
	}

	function mycatename(){
		$sql=mysql_query("select guanjianzi from sns_keys where id=$this->id");
		$info=mysql_fetch_array($sql);
		if($info){
			echo "关键字 ".$info["guanjianzi"];
		}
	}

	function mycatelist(){
		require_once("public_touxiang.php");
		//$sjk   = "sns_articles where bh in (select artid from sns_artkeyword where keyword=$this->id)";
		$sjk = "st_category where keyword=$this->id";
		$meiye = "10";
		$paixu = "times";
		$ziduan="uid,bh,newsbt,times";
		$sql=public_fenye::mylist($ziduan,$sjk,$meiye,$paixu);
		$info=mysql_fetch_array($sql);
		if($info){
			do{
				echo "<div class='pdb'>";
             	echo "<div class='dla'>";
             	public_touxiang::mytouxiang($info["uid"],26,30);
             	public_uname::myuname($info["uid"]);
                echo "</div><div class='bta'><a href='msg.php?i=".$info["bh"]."'>".$info["newsbt"]."</a></div>";
                echo "<div class='dla'>".$info["times"]."</div></div>";
             	
			}while($info=mysql_fetch_array($sql));
		}
	}

	function myfanye($url){
		public_fenye::myfanye($url);
	}

	function mytjblog(){
		include("public_tjblog.php");
		public_tjblog::mytjblog();
	}
	
}
?>