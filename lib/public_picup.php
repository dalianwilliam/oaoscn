<?php
class public_picup{

	/*
	*上传文件函数
	*$pictype上传文件的类型,$picurlsize上传文件的尺寸,$picurltmp上传文件的临时文件,$falseurl上传失败后的跳转页面
	*/
	function ispicurl($pictype,$picurlsize,$picurltmp,$falseurl){
		$suiji=date("yzHis")."_".mt_rand(10,99);
		if($pictype=="image/jpeg"){
			$this->picname=$suiji.".jpg";
		}
		if($pictype=="image/gif"){
			$this->picname=$suiji.".gif";
		}
		if($pictype=="image/png"){
			$this->picname=$suiji.".png";
		}
		
		//判断图片文件量
		if($picurlsize){
			$psize=ceil($picurlsize/1024);

			if($psize>1024*1024*2){
				exit("<script>alert('上传文件不能超过一个G呀！');window.location.href='".$falseurl."'</script>");
			}
		}

		//创建文件夹
		$wjj=date("Ym")."/";
		$purl="../pics/".$wjj;
		if(!is_file($purl)){
			mkdir($purl);
		}
		
		$sql=move_uploaded_file($picurltmp,$purl.$this->picname);
		$this->picurl=$wjj.$this->picname;
		if($sql){
			return $this->picurl;
		}else{
			exit("<script>alert('".$this->picurl."文件上传失败，如果你希望这个文件能上传请联系管理员呀');window.location.href='".$falseurl."'</script>");
		}
		
	}


}
?>