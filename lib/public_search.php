<?php
class public_search{
	function mytopkey(){
		$sql=mysql_query("select guanjianzi,id from sns_keys where id in (select keyword from sns_artkeyword group by keyword order by id desc) limit 0,20");
		$info=mysql_fetch_array($sql);
		if($info){
			do{
				echo "<div class='gjz'><a href='".LOCAL."category.php?ci=".$info["id"]."'>".$info["guanjianzi"]."</a></div>";
			}while($info=mysql_fetch_array($sql));
		}
	}
}
?>