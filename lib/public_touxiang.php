<?php
class public_touxiang{
	function mytouxiang($uid,$w,$h){
		
		$sql=mysql_query("select touxiang from sns_huiyuan where id=$uid");
		$info=mysql_fetch_array($sql);
		if(isset($info["touxiang"]) and $info["touxiang"]!=''){
			echo "<img class='touxiang' src='".LOCAL."touxiang/upload/".$info["touxiang"]."' width='".$w."' height='".$h."'>";
		}else{
			echo "<img class='touxiang' src='".LOCAL."touxiang/upload/me.png' width='".$w."' height='".$h."'>";
		}
	}
}
?>