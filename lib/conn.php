<?php
require_once("config.php");
class conn{
	
	function __construct(){
		date_default_timezone_set("Asia/Chongqing");
		@header('Content-type: text/html;charset=UTF-8');
		$conn=mysql_connect(DATA_URL,DATA_UNAME,DATA_PWS);
		mysql_select_db(DATA_DB,$conn);
		mysql_query("set names utf8");

	}
	
	//判断会员权限
	function isquanxian(){
		if(!isset($_SESSION["uname"]) or $_SESSION["uname"]==''){
			exit("<script>alert('您还不是会员');window.location.href='../login.php'</script>");
		}
	}
	//会员退出
	function tuichu(){
		unset($_SESSION["uname"]); //将变量清空
		session_destroy(); // 将所有SESSION清空
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		echo "<script>alert('您已经安全退出了');window.location.href='../index.php'</script>";
	}
	
	/*
	*标题检测英文中文通用
	*/
	function jctitle($id){
		$id=trim(strip_tags($id));
		    //去除HTML PHP等标记 变成文本格式
		$id=addslashes($id);
		    //在'前加“\” 防止英文 录入失败
		return $id;
	}
	//正文检测
	function jczhengwen($id){
	    $id=trim(strip_tags($id,"<br> <p> <b> <img> <i> <li> <pre>"));
	    //$id=htmlspecialchars($id); // 将一些预定义的符号转化成HTML 防止正文出现黑客代码 
	    $id=addslashes($id);
	     //在'前加“\” 防止英文 录入失败 //出现单引号无法加入的情况使用此函数。
	    //$id=trim(str_replace('<?php','&lt;?php ',$id));
	    return $id;
	} 
	/*
	*标题检测数字
	*/
	function jcnumeric($id){
		$id=trim($id);
		if(!is_numeric($id)){
			header("location:/index.php");
			exit();
		}
		return $id;
	}

	/*
	*正文字符串过滤
	*/
	function mytrim($i,$str){
		$str=strip_tags($str);
		$str=str_replace(" ","",$str);
		$str=str_replace("&nbsp;","",$str);
		$str=mb_substr($str,0,$i,'utf-8');//截取字符串
		$str=str_replace('&lt;','',$str);
		$str=str_replace('&gt;','',$str);
		$str=preg_replace("/\s/", '', $str);//保证所以信息能在一行显示
		return $str."...";
	}
	/*
	*获得IP地址
	*/
	function myips(){
		$ips=$_SERVER['REMOTE_ADDR']; //当前用户的IP地址
		$url=$_SERVER['HTTP_REFERER'];
		$url=$_SERVER['PHP_SELF'].$_GET["i"];//当前页
		$times=date("Y-m-d H:i:s");
		$uid = isset($_SESSION["uid"])?$_SESSION["uid"]:"0";
		mysql_query("insert into sns_ips (ips,url,uid,times) values ('$ips','$url','$uid','$times')");
	}
	
}
?>

