<?php
require("conn.php");
require("public_fenye.php");
require("public_search.php");

class search extends conn{
	function __construct(){
		parent::__construct();
	}

	function mysearch($se){
		
		$stext=parent::jctitle($se);

		$sql=mysql_query("select bh,newsbt,times from sns_articles where newsbt like '%".$stext."%' limit 0,10");
		$info=mysql_fetch_array($sql);
		if($info){
			do{
					$bt=str_ireplace($stext,"<span class='ssys'>".$stext."</span>",$info["newsbt"]);
					echo "<li><a href='msg.php?i=".$info["bh"]."' class='bt'>".$bt."</a>";
					echo "<div class='dlb'>".$info["times"]."</div></li>";
					
			}while($info=mysql_fetch_array($sql));
		}else{
			//echo "<div class='pda'>关键字<span class='ssys'>'".$se."'</span>没有找到</div>";
		}
	}
	function mytop(){
		require("public_top.php");
		public_top::mytop();
	}
	function myfanye($url){
		public_fenye::myfanye($url);
	}
	function mytopkey(){
		public_search::mytopkey();
	}

}
?>