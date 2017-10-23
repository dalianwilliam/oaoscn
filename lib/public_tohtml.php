<?php
class public_tohtml{

	/*
	*$url 来源网页，想变成静态页面的网页。
	*$mburl 模板路径
	*$newurl 生成的新网页
	*$tihuan 要替换的字符
	*/
	function mytohtml($url,$mburl,$newurl,$tihuan){
		$string = file_get_contents($url,"1");
		$open = fopen($mburl,"r"); //打开模板文件
		$content = fread($open,filesize($mburl)); //读取模板文件内容
		$content = str_replace($tihuan,$string,$content);//替换
		$newtemp = fopen($newurl,"w");//生成,用写入方式打开一个不存在（新）的页面
		fwrite($newtemp,$content);//将刚刚替换的内容写入新文件中
		fclose($newtemp);
	}
}
?>