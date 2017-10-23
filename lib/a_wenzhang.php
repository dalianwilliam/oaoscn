<?php
require("a_index.php");
require("public_fenye.php");
require("public_uname.php");

class a_wenzhang extends a_index{
	function __construct(){
		parent::isquanxian(); //判断会员权限
		parent::__construct();
		$this->t=isset($_GET["t"])?$_GET["t"]:"1";
		if(isset($_GET["del"]) and $_GET["del"]!=''){
			$this->mydel($_GET["del"]);
		}
		if(isset($_GET["tja"]) and $_GET["tja"]!=''){
			$this->mytja($_GET["tja"]);
		}
		if(isset($_GET["tjb"]) and $_GET["tjb"]!=''){
			$this->mytjb($_GET["tjb"]);
		}
		if(isset($_GET["tjz"]) and $_GET["tjz"]!=''){
			$this->mytjz($_GET["tjz"]);
		}
	}

	function mylist(){
		$sjk   = "sns_articles where tj=".$this->t;
		$meiye = "10";
		$paixu = "id";
		$ziduan= "*";
		$sql=public_fenye::mylist($ziduan,$sjk,$meiye,$paixu);
		$info=mysql_fetch_array($sql);
		if($info){
			do{
				echo "<li><a href='../msg.php?i=".$info["bh"]."' class='bt' target='_blank'>".$info["newsbt"]."</a><div class='dla pdc'>";
				echo " View:".$info["hit"]." Reply:".$info["hf"] . " 会员:[";
				public_uname::myuname($info["uid"]);
				echo "] </div><div class='dlb'>".$info["newszw"]."</div>";

				echo " <span class='anb delid'><a href='wenzhang.php?del=".$info["id"]."&t=".$this->t."'>删除</a></span> ";
				echo " <span class='anb'><a href='wenzhang.php?tja=".$info["id"]."&t=".$this->t."'>推首页</a></span> ";
				echo " <span class='anb'><a href='wenzhang.php?tjb=".$info["id"]."&t=".$this->t."'>普通级</a></span> ";
				echo " <span class='anb'><a href='wenzhang.php?tjz=".$info["id"]."&t=".$this->t."'>无价值</a></span> ";
				echo "</li><hr/>";
			}while($info=mysql_fetch_array($sql));
		}
	}

	function mydel($del){
		$del=parent::jcnumeric($del);
		mysql_query("delete from sns_articles where id=$del");
		header("location:/admini/wenzhang.php?t=".$this->t);
	}
	function mytja($tja){
		$tja=parent::jcnumeric($tja);
		mysql_query("update sns_articles set tj=1 where id=$tja");
		header("location:/admini/wenzhang.php?t=".$this->t);
	}
	function mytjb($tjb){
		$tjb=parent::jcnumeric($tjb);
		mysql_query("update sns_articles set tj=2 where id=$tjb");
		header("location:/admini/wenzhang.php?t=".$this->t);
	}
	function mytjz($tjz){
		$tjz=parent::jcnumeric($tjz);
		mysql_query("update sns_articles set tj=100 where id=$tjz");
		header("location:/admini/wenzhang.php?t=".$this->t);
	}
	function myfanye($url){
		public_fenye::myfanye($url);
	}
}
?>