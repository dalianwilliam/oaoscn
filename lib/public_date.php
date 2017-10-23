<?php
class public_date{
	
	// 返回 Jul 26 2017
	function mystrdate($times){
		return date("M d Y",strtotime($times));
	}

	// 返回 n分n秒前
	function mystrtime($times){
		$start_ts = strtotime($times);
		$end_ts = strtotime(date("Y-m-d H:i:s"));
		$diff = $end_ts - $start_ts;

		$xiaoshi = intval($diff/3600);
		$fen=intval(($diff % 3600)/60);
		$miao= (($diff % 3600)%60);
		if($xiaoshi==0){
			echo ($fen==0)?'':" ".$fen."分";
			echo ($miao==0)?'':$miao."秒前";
		}
	}
}

?>