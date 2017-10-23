<?php
class public_fenye{

	/*
	*分页函数（数据库，每页显示数，排序字段）
	*不带WHERE条件语句，可以让使用者自己填写条件
	*/
	function mylist($ziduan,$sjk,$meiye,$paixu){
		if(isset($_GET["page"]) and $_GET["page"]!=''){
			$this->page=$_GET["page"];
		}else{
			$this->page=1;
		}

		$info=mysql_fetch_array(mysql_query("select count(id) as shu from $sjk"));
		$zshu = $info["shu"]; //总条数
		$plshu=$meiye; //每页显示20条
		$this->zpages=ceil($zshu/$plshu); //一共可以分多少页

		if($this->page>$this->zpages){	$this->page=$this->zpages;	}
		if($this->page<1){	$this->page=1;	}

		$ks=($this->page-1)*$plshu; //开始位置 = （当前页-1）* 每页显示数
		$this->sql=mysql_query("select $ziduan from $sjk  order by $paixu desc limit $ks,$plshu");
		return $this->sql;
	}
	

	//通用翻页 带参数$url 可以不写
	function myfanye($url){
		echo "<div class='pdb'><a href='".$_SERVER['PHP_SELF']."?page=".($this->page-1).$url."'>上一页</a> ";
		echo "<a href='".$_SERVER['PHP_SELF']."?page=".($this->page+1).$url."'>下一页</a> ";
		echo "当前在第".$this->page."页 / 共有".$this->zpages."页</div> ";
		echo "<div class='pdb'>";
		for($i=-4;$i<6;$i++){
			if(($this->page+$i) < ($this->zpages+1) and ($this->page+$i)>0){
				if($i==0){ $ysb=" class='xz'"; }else{ $ysb=""; }
				echo "<a href='".$_SERVER['PHP_SELF']."?page=".($this->page+$i).$url."' ".$ysb.">".($this->page+$i)."</a> ";
			}
		}
		echo "</div>";
	}

}
?>