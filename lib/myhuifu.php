<?php
require("conn.php");
require("public_uname.php");
class myhuifu extends conn{
	function __construct(){
		parent::__construct();
		parent::isquanxian(); //判断权限
		$this->i=parent::jctitle($_GET["i"]);
		$this->ana='回复';
		$this->mynewsbiaoti();

		if(isset($_POST["tijiao"]) and $_POST["tijiao"]=='回复'){
			$this->myhuifu();
		}
		if(isset($_GET["mymod"]) and $_GET["mymod"]!=''){
			$this->myshow($_GET["mymod"]);
			$this->ana='修改';
		}
		if(isset($_POST["tijiao"]) and $_POST["tijiao"]=='修改'){
			$this->mymod();
		}
		if(isset($_GET["hf"]) and $_GET["hf"]!=''){
			$this->ana='评论';
			$this->mytitles="评论";
		}
		if(isset($_POST["tijiao"]) and $_POST["tijiao"]=='评论'){
			$this->mypinglunadd();
		}
	}
	function mypinglunadd(){
		$zhengwen=parent::jczhengwen($_POST["zhengwen"]);
		$uid=$_SESSION["uid"]; //我的UID
		$times=date("Y-m-d H:i:s");
		$hfid=$_POST["hfid"];

		mysql_query("insert into sns_pinglun (yuan_id,pinglun,uid,times) values ('$hfid','$zhengwen',$uid,'$times')");
		header("location:/msg.php?i=".$this->i."#pinglun");
	}
	function mymod(){
		$zhengwen=parent::jczhengwen($_POST["zhengwen"]);
		$uid=$_SESSION["uid"]; //我的UID
		$times=date("Y-m-d H:i:s");
		$id=$_POST["plid"];
		mysql_query("update sns_pinglun set pinglun='$zhengwen' where id = $id");
		header("location:/msg.php?i=".$this->i."#pinglun");
	}
	function myshow($id){
		$id=parent::jcnumeric($id);
		$sql=mysql_query("select * from sns_pinglun where id = $id");
		$this->infoa=mysql_fetch_array($sql);
	}
	function myhuifu(){
		$zhengwen=parent::jczhengwen($_POST["zhengwen"]);
		$uid=$_SESSION["uid"];
		$times=date("Y-m-d H:i:s");
		mysql_query("insert into sns_pinglun (yuan_id,pinglun,uid,times) values ('$this->i','$zhengwen','$uid','$times')");
		header("location:/msg.php?i=".$this->i."#pinglun");
	}
	function mytop(){
		require("public_top.php");
		public_top::mytop();
	}

	function mynewsbiaoti(){
		$sql=mysql_query("select newsbt,uid from sns_articles where bh='$this->i'");
		$info=mysql_fetch_array($sql);
		$this->newsbt=$info["newsbt"];
	}

	function myuname($uid){
		public_uname::myuname($uid);
	}


}