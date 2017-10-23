<?php
require("conn.php");
class post extends conn{
	function __construct(){
		parent::__construct();
		/*发布文章时选择关键字*/
		if(isset($_GET["kw"]) and $_GET["kw"]!=''){
			$this->mykw($_GET["kw"]);
		}
		/*删除文章*/
		if(isset($_GET["newsdel"]) and $_GET["newsdel"]!=''){
			$this->mynewsdel($_GET["newsdel"]);
		}
		/*注册时候验证邮箱*/
		if(isset($_GET["jcuname"]) and $_GET["jcuname"]!=''){
			$this->myjcuname($_GET["jcuname"]);
		}
	}
	function myjcuname($uname){
		//echo $uname;
		$uname=parent::jctitle($uname);
		$sql=mysql_query("select id from sns_huiyuan where zhanghao='$uname'");
		$info=mysql_fetch_array($sql);
		if($info){
			echo "邮箱已经存在，请更换一个";
		}
	}
	function mynewsdel($delid){
		$uid=$_SESSION["uid"];
		mysql_query("delete from sns_articles where bh='$delid' and uid=$uid");
		unlink("../".$delid.".shtml");

	}
	function mykw($kw){
		$kw=parent::jctitle($kw);
		$sql=mysql_query("select id,guanjianzi from sns_keys where guanjianzi like '%".$kw."%' limit 0,10");
		$info=mysql_fetch_array($sql);
		echo '<i class="icon-remove pda fr"></i>';
		if($info){
			do{
				echo "<div class='pdf'><input type='hidden' class='gjzid' value='".$info["id"]."'>".$info["guanjianzi"]."</div>";
			}while($info=mysql_fetch_array($sql));
		}
	}

}
?>