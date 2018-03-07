<?php
require('./lib/init.php');
//print_r($_GET['art_id']);
$art_id = $_GET['art_id'];
$sql = "delete from art where art_id = $art_id";

//判断地址栏传来的art_id是否合法
if(!is_numeric($art_id)) {
	error('文章id不合法');
}

//是否有这篇文章
$sql1 = "select * from art where art_id = $art_id";

//var_dump(mQuery($sql1));exit;
if(!mGetRow($sql1)) {
	error('文章不存在');
}

//var_dump(mQuery($sql));
if(mQuery($sql)){
	//succ('删除成功');
	header('location:artlist.php');
} else{
	error('删除失败');
}
?>