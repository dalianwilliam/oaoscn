<?php
class public_rand{

	function myrand(){
		
		$shu=dechex(date("yz"));
		$shu.=dechex(date("His"));
		$shu.=dechex(mt_rand(10,255));
		$shu.=mt_rand(10,99);
		return $shu;
	}
}
?>