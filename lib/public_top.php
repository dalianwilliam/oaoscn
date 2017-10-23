<?php

class public_top{

	function mytop(){
		require_once("public_touxiang.php");
		if(isset($_SESSION["uname"]) and $_SESSION["uname"]!='' ){
			echo "<div class='fr pda'><a href='".LOCAL."my/myset.php' >";
			public_touxiang::mytouxiang($_SESSION["uid"],30,34);
			echo '</a></div> <div class="fl pda">';
			echo "<a href='".LOCAL."my/myset.php' >".$_SESSION["uname"]."</a> &nbsp;&nbsp; ";
			echo "<a href='".LOCAL."my/mywrite.php'>写文章</a> &nbsp;&nbsp; ";
			echo "<a href='".LOCAL."my/mypage.php'>我的文章</a> &nbsp;&nbsp; ";
			echo "<a href='".LOCAL."quit.php'>安全退出</a> &nbsp;&nbsp; ";
			echo "</div>";
		}else{
			echo '<div class="fr pda">';
			echo "<a href='".LOCAL."login.php'>免费会员</a> ";
			echo "<a href='".LOCAL."login.php'>会员登录</a> ";
			//echo "<a href='#'>搜索</a> ";
			echo "</div>";
		}
	}
}
?>