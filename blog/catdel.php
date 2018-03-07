<?php

//var_dump($_GET);
$cat_id = $_GET['cat_id'];
//echo $cat_id;exit;

   $conn = mysqli_connect('localhost','root','');
	mysqli_query($conn,'use blog');
	mysqli_query($conn,'set names utf8');
	
	if(!is_numeric($cat_id)) {
		echo '栏目不合法  退出';exit;
	}
	
	$sql = "select * from cat where cat_id = $cat_id";
	$rs = mysqli_query($conn,$sql);
	if(mysqli_fetch_row($rs)[0] == 0) {
		echo '栏目不存在  退出';exit;
	}
	
	//检测栏目下是否有文章   
	$sql = "select count(*) from art where cat_id = $cat_id";
	$rs = mysqli_query($conn,$sql);
	if(mysqli_fetch_row($rs)[0] != 0) {
		echo '栏目下有文章 不能删除  退出';exit;
	}

	$sql = "delete from cat where cat_id = $cat_id";
	mysqli_query($conn,$sql);
	echo '删除成功';
	


?>