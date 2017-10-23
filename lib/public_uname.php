<?php
class public_uname{

	function myuname($uid){
		$sql=mysql_query("select zhanghao,nickname from sns_huiyuan where id=$uid");
		$info=mysql_fetch_array($sql);
		if($info["nickname"]!=''){
			echo $info["nickname"];
		}else{
			echo $info["zhanghao"];
		}
	}
}
?>