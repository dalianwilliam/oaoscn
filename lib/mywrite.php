<?php
require("conn.php");
require("public_rand.php");
require("public_tohtml.php");

class mywrite extends conn{

	function __construct(){
		parent::__construct();
		parent::isquanxian();
		parent::myips();
		$this->ana='提交';
		if(isset($_POST["tijiao"]) and $_POST["tijiao"]=='提交'){
			$this->myadd();
		}
		if(isset($_POST["tijiao"]) and $_POST["tijiao"]=='修改'){
			$this->mymod();
		}
		if(isset($_GET["modi"]) and $_GET["modi"]!=''){
			$this->myshow($_GET["modi"]);
			$this->ana='修改';
		}
	}
	function myshow($id){
		$sql=mysql_query("select * from sns_articles where bh='$id'");
		$this->info=mysql_fetch_array($sql);

	}
	function myshowgjz($id){
		$sql=mysql_query("select * from st_showkey where artid='$id'");
		$info=mysql_fetch_array($sql);
		if($info){
			do{
				echo "<span class='pda'><input value='".$info["keyword"]."' name='gjz[]' type='hidden'> ".$info["guanjianzi"]." <i class='icon-remove'></i></span>";
			}while($info=mysql_fetch_array($sql));
		}
	}
	
	function mymod(){
		$gjz=array();
		$gjz=$_POST["gjz"];
		$gjzcd=count($gjz);

		$shu   = parent::jctitle($_POST["shu"]);
		$biaoti   = parent::jctitle($_POST["biaoti"]);
		$zhengwen = parent::jczhengwen($_POST["zhengwen"]);
		
		$times=date("Y-m-d H:i:s");
		//$htmlurl=$shu.".shtml";
		mysql_query("update sns_articles set newsbt='$biaoti',newszw='$zhengwen',times='$times' where bh='$shu'");

		mysql_query("delete from sns_artkeyword where artid='$shu'");
		for($i=0;$i<$gjzcd;$i++){
			mysql_query("insert into sns_artkeyword(artid,keyword) values ('$shu','".$gjz[$i]."')");
		}

			/*$url=LOCAL."msg.php?i=".$shu;
			$mburl="html_moban.php";
			$newurl="../".$shu.".php";
			$tihuan="{zhengwen}";
			public_tohtml::mytohtml($url,$mburl,$newurl,$tihuan);*/

		echo "<script>alert('修改成功');window.location.href='mypage.php?u=".$_SESSION["uid"]."'</script>";
	}

	function myadd(){
		$gjz=array();
		$gjz=$_POST["gjz"];
		$gjzcd=count($gjz);

		$biaoti   = parent::jctitle($_POST["biaoti"]);
		$zhengwen = parent::jczhengwen($_POST["zhengwen"]);
		$shu = public_rand::myrand();
		$uid=$_SESSION["uid"];
		$times=date("Y-m-d H:i:s");
		//$htmlurl=$shu.".shtml";
		
		$sql=mysql_query("insert into sns_articles (bh,newsbt,newszw,uid,hit,hf,tj,times) values ('$shu','$biaoti','$zhengwen',$uid,0,0,0,'$times')");
		if($sql){
			mysql_query("delete from sns_artkeyword where artid='$shu'");
			for($i=0;$i<$gjzcd;$i++){
				mysql_query("insert into sns_artkeyword(artid,keyword) values ('$shu','".$gjz[$i]."')");
			}
			/*$url=LOCAL."msg.php?i=".$shu;
			$mburl="html_moban.php";
			$newurl="../".$shu.".php";
			$tihuan="{zhengwen}";
			public_tohtml::mytohtml($url,$mburl,$newurl,$tihuan);*/

			echo "<script>alert('添加成功');window.location.href='mywrite.php?u=".$_SESSION["uid"]."'</script>";
		}else{
			echo "<script>alert('添加失败');window.location.href='mywrite.php?u=".$_SESSION["uid"]."'</script>";
		}
	}

	function mytop(){
		require("public_top.php");
		public_top::mytop();
	}

	function mybanner(){
		$u=$_GET["u"];
		require_once("public_mybanner.php");
		public_mybanner::mybanner($u);
	}
}
?>