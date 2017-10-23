<?php
require("a_index.php");
class ips extends conn{

	function __construct(){
		parent::__construct();
		//parent::isquanxian();//暂时不加权限
		$this->mytodayliuliang();
	}
	function mytodayliuliang(){
		$y=date("Y");
		$m=date("m");
		$d=date("d");
		//$h=date("H");
		for($h=0;$h<24;$h++){
			$sql=mysql_query("select count(ips) as pvs from sns_ips  where year(times) = '$y' and month(times)='$m' and day(times)='$d' and hour(times)='$h'");
			$info=mysql_fetch_array($sql);
			$this->pvs.=$info["pvs"].",";
		}
		$this->pvs=substr($this->pvs,0,strlen($this->pvs)-1);
		for($h=0;$h<24;$h++){
			$sql=mysql_query("select count(distinct(ips)) as ips from sns_ips  where year(times) = '$y' and month(times)='$m' and day(times)='$d' and hour(times)='$h'");
			$info=mysql_fetch_array($sql);
			$this->ips.=$info["ips"].",";
		}
		$this->ips=substr($this->ips,0,strlen($this->ips)-1);	
	}

	function mylist(){
		$sql=mysql_query("select * from sns_ips order by times desc limit 0,200");
		$info=mysql_fetch_array($sql);
		if($info){
			do{
				echo "<tr><td>".$info["id"]."</td>";
    			echo "<td><a href='http://www.ip138.com/ips138.asp?ip=".$info["ips"]."&action=2'  target='_blank'>".$info["ips"]."</a></td>";
    			echo "<td>".$info["url"]."</td>";
    			echo "<td>".$info["uid"]."</td>";
    			echo "<td>".$info["times"]."</td></tr>";
  
			}while($info=mysql_fetch_array($sql));
		}
	}
}
?>