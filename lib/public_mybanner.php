<?php
class public_mybanner{

	function mybanner($u){

		$sql=mysql_query("select blogbanner from sns_huiyuan where id=$u");
		$info=mysql_fetch_array($sql);
		$bgpics=($info["blogbanner"]!='')?$info["blogbanner"]:"banner1.jpg";
		echo "<div style='background-image:url(images/".$bgpics.");' class='mybanner'>";
        echo '<div class="wai"></div></div>';
    	
	}

}
?>