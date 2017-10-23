<?php
require("conn.php");
class phplearning extends conn{
	function __construct(){
		parent::__construct();
		if(isset($_GET["xi"]) and $_GET["xi"]!=''){
			$this->xi=parent::jcnumeric($_GET["xi"]);
		}
		if(isset($_GET["i"]) and $_GET["i"]!=''){
			$this->xi=parent::jcnumeric($_GET["xi"]);
			$this->i=parent::jcnumeric($_GET["i"]);
		}
	}

	function mytop(){
		require("public_top.php");
		public_top::mytop();
	}

	function mytjblog(){
		include("public_tjblog.php");
		public_tjblog::mytjblog();
	}

	function myhanshulist(){
		$sql=mysql_query("select * from sns_phpfunctionname order by id");
		$info=mysql_fetch_array($sql);
		if($info){
			do{
				echo "<div class='pdb'><a href='phplearning.php?xi=".$info["id"]."'>".$info["PhpFunctionName"]."</a></div>";
			}while($info=mysql_fetch_array($sql));
		}
	}

	function myshow($xi){
		$sql=mysql_query("select PhpFunctionName from sns_phpfunctionname where id = $xi");
		$info=mysql_fetch_array($sql);
		if($info){
			echo "<div class='pda btb'>".$info["PhpFunctionName"]."</div>";
		}
		
		$sql=mysql_query("select id,funenandcn from sns_phpfunction where funid = $xi");
		$info=mysql_fetch_array($sql);
		if($info){
			echo "<ol>";
			do{
				echo "<li><a href='phplearning_msg.php?i=".$info["id"]."&xi=".$xi."'>".$info["funenandcn"]."</a></li>";
			}while($info=mysql_fetch_array($sql));
			echo "</ol>";
		}else{
			$sql=mysql_query("select desi from sns_codedesi where types='php'");
			$info=mysql_fetch_array($sql);
			if($info){
				echo "<div class='pda'>".$info["desi"]."</div>";
			}
		}
	}


	function mycallmsg($xi,$i){
		$sql=mysql_query("select PhpFunctionName from sns_phpfunctionname where id = $xi");
		$info=mysql_fetch_array($sql);
		if($info){
			echo "<div class='pda bta'>".$info["PhpFunctionName"]."</div>";
		}
		$sql=mysql_query("select * from sns_phpfunction where id = $i");
		$info=mysql_fetch_array($sql);
		if($info){
			echo "<div class='btb pdb'>".$info["funname"]."</div>";
			echo "<div class='pdb dla'>".$info["funversion"]."</div>";
			echo "<div class='pdb'>".$info["funenandcn"]."</div>";
			echo ($info["phparticle"]!='') ? "<div class='pda xiana bgy mta'><div class='btb'>实例</div>".$info["phparticle"]."</div>":"";
			echo ($info["phparticle_en"]!='') ? "<div class='pda xiana bgy mta'><div class='btb'>英文</div>".$info["phparticle_en"]."</div>":"";
			//echo ($info["phparticle_jap"]!='') ? "<div class='pda xiana bgy'><div class='btb'>日文</div>".$info["phparticle_jap"]."</div>":"";
		}
	}
}
?>