<?php
require("conn.php");
require("public_search.php");
class msg extends conn{

	function __construct(){
		parent::__construct();
		parent::myips();
		$this->i=parent::jctitle($_GET["i"]);
		if(isset($_GET["i"]) and $_GET["i"]!=''){
			$this->myshow($_GET["i"]);
		}
		if(isset($_GET["mydel"]) and $_GET["mydel"]!=''){
			$this->mydelhf($_GET["mydel"]);
		}
	}

	function mydelhf($del){
		mysql_query("delete from sns_pinglun where id=$del");
		header("location:/msg.php?i=".$this->i."#pinglun");
	}
	function mypllist(){
		$sql=mysql_query("select * from sns_pinglun where yuan_id='$this->i' order by times desc limit 0,50");
		$info=mysql_fetch_array($sql);
		if($info){
			do{
				echo "<div class='fla'>";
				$this->mytouxianga($info["uid"],31,35);
				echo "</div>";
            	echo "<div class='flb'><div class='bt'>";
            	$this->myuname($info["uid"]);
            	echo "</div>";
            	echo "<div class='hfzw'>".$info["pinglun"]."</div>";
            	echo "<div class='dla'>".$info["times"];
            	if($_SESSION["uid"]==$info["uid"]){
            		echo "<a href='my/huifu.php?i=$this->i&mymod=".$info["id"]."' class='anc'>修改</a> <a href='msg.php?i=$this->i&mydel=".$info["id"]."' class='anc'>删除</a>";
            	}else{
            		echo "<a href='".LOCAL."my/huifu.php?i=".$this->i."&hf=".$info["id"]."' class='anc'>评论</a>";
            	}
            	echo "</div>";
            	$this-> mypllistb($info["id"]);
            	echo "</div>";
            	echo "<div class='ld'></div>";
			}while($info=mysql_fetch_array($sql));
		}
	}
		function mypllistb($xid){
			$sqlb=mysql_query("select * from sns_pinglun where yuan_id='$xid' order by times desc limit 0,50");
			$infob=mysql_fetch_array($sqlb);
			if($infob){
				do{
					echo "<div class='pda '>";
					$this->mytouxianga($infob["uid"],23,25);
					$this->myuname($infob["uid"]);
					echo "<div class='hfzw'>".$infob["pinglun"]."</div>";
					if($_SESSION["uid"]==$infob["uid"]){
            			echo "<a href='msg.php?i=$this->i&mydel=".$infob["id"]."' class='anc'>删除</a>";
            		}
            		echo "</div>";
				}while($infob=mysql_fetch_array($sqlb));
			}
		}
		function myuname($uid){
			public_uname::myuname($uid);
		}
	function liuyan_anniu(){
		if(isset($_SESSION["uname"]) or $_SESSION["uname"]!=''){
			echo "<a href='".LOCAL."my/huifu.php?i=".$this->i."' class='ana'>对作者说几句</a>";
		}else{
			echo "<a href='".LOCAL."login.php?i=".$this->i."' class='ana'>登录后留言</a>";
		}
	}
	function mytouxianga($uid,$w,$h){
		require_once("public_touxiang.php");
		public_touxiang::mytouxiang($uid,$w,$h);
	}
	function myzuozhe($uid){
		$sql=mysql_query("select * from sns_huiyuan where id=$uid");
		$info=mysql_fetch_array($sql);
		if($info){
			echo $info["nickname"]." / ".$info["zhanghao"]."<br/>".$info["blogtext"];
		}
	}
	function mytop(){
		require("public_top.php");
		public_top::mytop();
	}

	function myshow($i){
		$i=parent::jctitle($i);
		if(strlen($i)>20){
			header("location:/index.php");
		}
		$sql=mysql_query("select * from sns_articles where bh='$i'");
		$this->info=mysql_fetch_array($sql);
		if(empty($this->info)){
			header("location:/index.php");
		}
		mysql_query("update sns_articles set hit=hit+1 where bh='$i'");
	}

	function mynextnews($id){
		$sql=mysql_query("select bh,newsbt from sns_articles where id < $id and tj!=100 order by id desc limit 0,6");
		$info=mysql_fetch_array($sql);
		if($info){
			echo '<div class="lbb xiana">';
			echo "<li class='bta'>LEARNING</li>";
			do{
				echo "<a href='".LOCAL."msg.php?i=".$info["bh"]."'><li>".$info["newsbt"]."</li></a>";
			}while($info=mysql_fetch_array($sql));
			echo "</div>";
		}
	}

	function mytopkey(){
		public_search::mytopkey();
	}

	function mycate($bh){
		$sql=mysql_query("select guanjianzi,id from sns_keys where id in (select keyword from sns_artkeyword where artid='$bh')");
		$info=mysql_fetch_array($sql);
		if($info){
			echo "所属关键字&nbsp;&nbsp;";
			do{
				echo "<a href='".LOCAL."category.php?ci=".$info["id"]."'>".$info["guanjianzi"]."</a> &nbsp;&nbsp;";
			}while($info=mysql_fetch_array($sql));
		}
	}

	function mytjblog(){
		include("public_tjblog.php");
		public_tjblog::mytjblog();
	}
}
?>