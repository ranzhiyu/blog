<?php

//print_r($_GET['cat_id']);
/*$cat_id = $_GET['cat_id'];
echo $cat_id;exit;
*/
    $conn = mysqli_connect('localhost','root','');
	mysqli_query($conn,'use blog');
	mysqli_query($conn,'set names utf8');
	
	$cat_id = $_GET['cat_id'];
	
	if(!is_numeric($cat_id)) {
		echo '栏目不合法  退出';exit;
	}
	$sql = "select * from cat where cat_id = $cat_id";
	$rs = mysqli_query($conn,$sql);
	if(mysqli_fetch_row($rs)[0] == 0) {
		echo '栏目不存在  退出';exit;
	}

if(empty($_POST)) {
	$sql = "select catname from cat where cat_id = $cat_id";
	$rs = mysqli_query($conn,$sql);
	//var_dump($rs);
	$cat = mysqli_fetch_row($rs)[0];
	require('view/admin/catedit.html');
} else {
	$sql = "update cat set catname = '$_POST[catname]' where cat_id = $cat_id";
	if(!mysqli_query($conn,$sql)) {
		echo '栏目修改失败';exit;
	} else {
		echo '栏目修改成功过';
	}
}


?>