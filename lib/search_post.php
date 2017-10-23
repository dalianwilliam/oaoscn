<?php
require("conn.php");


class search_post extends conn{
	function __construct(){
		parent::__construct();
		if(isset($_GET["ssbd"]) and $_GET["ssbd"]!=''){
			$this->mysearch_gjz($_GET["ssbd"]);
		}
		if(isset($_GET["classa"]) and $_GET["classa"]!=''){
			$this->mysearch_gjzb($_GET["classa"]);
		}
		if(isset($_GET["classb"]) and $_GET["classb"]!=''){
			$this->mysearch_gjzc($_GET["classb"]);
		}
		if(isset($_GET["classc"]) and $_GET["classc"]!=''){
			$this->mysearch_gjzd($_GET["classc"]);
		}
	}

	function mysearch_gjz($gjz){
		$gjz=parent::jctitle($gjz);
		$sql=mysql_query("select guanjianzi,id from sns_keys");
		$info=mysql_fetch_array($sql);
		if($info){
			do{
				preg_match("/".$gjz."/",$info["guanjianzi"],$re);
				preg_match("/".$info["guanjianzi"]."/",$gjz,$reb);
				if(in_array($gjz, $re) or in_array($info["guanjianzi"], $reb)){
					echo "<span class='anb'><a href='category.php?ci=".$info["id"]."'>".$info["guanjianzi"]."</a></span> ";
				}
			}while($info=mysql_fetch_array($sql));
		}
	}

	function mysearch_gjzb($gjz){
		$stext=parent::jctitle($gjz);
		$sql=mysql_query("select bh,newsbt,times from sns_articles where newsbt like '%".$stext."%' limit 2,4");
		$info=mysql_fetch_array($sql);
		if($info){
			do{
					$bt=str_ireplace($stext,"<span class='ssys'>".$stext."</span>",$info["newsbt"]);
					echo "<li><a href='msg.php?i=".$info["bh"]."' class='bt'>".$bt."</a>";
					echo "<div class='dlb'>".$info["times"]."</div></li>";
					
			}while($info=mysql_fetch_array($sql));
		}
	}
	function mysearch_gjzc($gjz){
		$stext=parent::jctitle($gjz);
		$sql=mysql_query("select bh,newsbt,times from sns_articles where newsbt like '%".$stext."%' limit 6,4");
		$info=mysql_fetch_array($sql);
		if($info){
			do{
					$bt=str_ireplace($stext,"<span class='ssys'>".$stext."</span>",$info["newsbt"]);
					echo "<li><a href='msg.php?i=".$info["bh"]."' class='bt'>".$bt."</a>";
					echo "<div class='dlb'>".$info["times"]."</div></li>";
					
			}while($info=mysql_fetch_array($sql));
		}
	}
	function mysearch_gjzd($gjz){
		$stext=parent::jctitle($gjz);
		$sql=mysql_query("select bh,newsbt,times from sns_articles where newsbt like '%".$stext."%' limit 10,4");
		$info=mysql_fetch_array($sql);
		if($info){
			do{
					$bt=str_ireplace($stext,"<span class='ssys'>".$stext."</span>",$info["newsbt"]);
					echo "<li><a href='msg.php?i=".$info["bh"]."' class='bt'>".$bt."</a>";
					echo "<div class='dlb'>".$info["times"]."</div></li>";
					
			}while($info=mysql_fetch_array($sql));
		}
	}
}
?>