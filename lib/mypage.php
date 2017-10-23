<?php
require("conn.php");
require("public_fenye.php");
require("public_date.php");
require("public_search.php");

class mypage extends conn{

	function __construct(){
		parent::__construct();
		parent::myips();
	}
	function mytop(){
		require("public_top.php");
		public_top::mytop();
	}
	
	function mylist(){

		$uid=(isset($_SESSION["uid"]) and $_SESSION["uid"]!='' and empty($_GET["u"]))?$_SESSION["uid"]:trim($_GET["u"]);
		$uid=parent::jcnumeric($uid);
		if(empty($uid) and $uid==''){
			header("location:/index.php");
		}
		$sjk   = "sns_articles where uid=$uid";
		$meiye = "10";
		$paixu = "times";
		$ziduan="*";
		$sql=public_fenye::mylist($ziduan,$sjk,$meiye,$paixu);
		$info=mysql_fetch_array($sql);
		if($info){
			do{
				$url=isset($info["htmlurl"]) ? LOCAL.$info["htmlurl"] :"../msg.php?i=".$info["bh"];
				echo "<li><a href='".$url."' class='bt'>".$info["newsbt"]."</a><div class='dla pdc'>";
				echo public_date::mystrdate($info["times"]);
				echo public_date::mystrtime($info["times"]);
				echo " View:".$info["hit"]." Reply:".$info["hf"];
				
				echo "</div><div class='dlb'>".parent::mytrim(200,$info["newszw"])."</div>";
				if($_SESSION["uid"]==$info["uid"]){
					echo " <span class='anb'><a href='mywrite.php?modi=".$info["bh"]."'>修改</a></span> ";
					echo " <span class='anb delid'><a href='###'><input type='hidden' id='did' value='".$info["bh"]."'>删除</a></span> ";
				}
				echo "</li>";
			}while($info=mysql_fetch_array($sql));
		}else{
			echo "没有数据";
		}
	}

	function myfanye($url){
		public_fenye::myfanye($url);
	}

	function mytopkey(){
		public_search::mytopkey();
	}

	function mytouxiang(){
		$u=(isset($_SESSION["uid"]) and $_SESSION["uid"]!='' and empty($_GET["u"]))?$_SESSION["uid"]:trim($_GET["u"]);
		$u=parent::jcnumeric($u);
		$sql=mysql_query("select id,touxiang,nickname,zhanghao from sns_huiyuan where id=$u");
		$info=mysql_fetch_array($sql);
		if($info){
			echo "<div class='mytouxiang'>";
        	echo "<div class='fl'>";
        	
        	echo ($info["touxiang"]!='')?"<img src='".LOCAL."touxiang/upload/".$info["touxiang"]."' width='72' height='78' align='left' class='touxiang pda'/>":"<img src='".LOCAL."touxiang/upload/me.png' width='72' height='78' align='left' class='touxiang pda'/>";
        	echo "</div><div class='fl blogdh'>";
      		echo "<div><a href='".LOCAL."my/mypage.php?u=".$info["id"]."'>我的主页</a></div> ";
        	echo "<div><a href='#'>我的文章</a></div>";
        	echo "<div><a href='#'>朋友圈</a></div>";
        	echo "<br class='ld'/>";
       	 	echo "<div class='dla'>".$info["zhanghao"]." / ".$info["nickname"]."</div></div><br class='ld'/></div>";
		}
	}

	function mybanner(){
		$u=(isset($_SESSION["uid"]) and $_SESSION["uid"]!='' and empty($_GET["u"]))?$_SESSION["uid"]:trim($_GET["u"]);
		$u=parent::jcnumeric($u);
		require_once("public_mybanner.php");
		public_mybanner::mybanner($u);
	}
}
?>