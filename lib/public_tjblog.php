<?php
class public_tjblog{

	function mytjblog(){
		$sql=mysql_query("select * from sns_huiyuan where id in (select uid from sns_tjblog order by times desc) limit 0,6");
		$info=mysql_fetch_array($sql);
		if($info){
			do{
				echo "<div class='bkzw'> ";
				echo ($info["touxiang"]!='')?"<img src='".LOCAL."touxiang/upload/".$info["touxiang"]."' width='70' height='77' align='left' class='touxiang'/>":"<img src='".LOCAL."touxiang/upload/me.png' width='70' height='77' align='left' class='touxiang'/>";
				echo "<a href='".LOCAL."my/mypage.php?u=".$info["id"]."'>".$info["zhanghao"]." / ".$info["nickname"]." <br/> ".conn::mytrim(46,$info["blogtext"])."</a></div>";
			}while($info=mysql_fetch_array($sql));
		}
	}
}
?>