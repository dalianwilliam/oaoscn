<?php
require("conn.php");
class myset extends conn{
	function __construct(){
		parent::__construct();
		parent::isquanxian();
	}

	function mytouxiang($uid,$w,$h){
		require_once("public_touxiang.php");
		public_touxiang::mytouxiang($uid,$w,$h);
	}

	function mytop(){
		require("public_top.php");
		public_top::mytop();
	}
}
?>