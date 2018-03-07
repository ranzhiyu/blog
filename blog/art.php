<?php
require('./lib/init.php');



$art_id = $_GET['art_id'];

//判断地址栏参数是否合法
if(!is_numeric($art_id)) {
	header("location: index.php");
}

$sql = "select * from art where art_id=$art_id";
//如果没有这篇文章就跳转到首页
if(!mGetRow($sql)) {
	header("location: index.php");
}

//查文章
$sql = "select title,art.cat_id,art.comm,content,pubtime,catname,comm,pic from art inner join cat on art.cat_id=cat.cat_id where art_id=$art_id";
$art = mGetRow($sql);



if(empty($art)){
	header('location: index.php');
	exit;
}

if(!empty($_POST)){

	$comm['nick'] = trim($_POST['nick']);
	$comm['art_id'] = trim($_GET['art_id']);
	$comm['email'] = trim($_POST['email']);
	$comm['pubtime'] = time()+28800;
	$comm['content'] = trim($_POST['content']);
	//echo sprintf('%u' , ip2long(getIp()));exit;
	$comm['ip'] = sprintf('%u' , ip2long(getIp()));
	$rs = mExec('comment',$comm);
	
	//每增加一条评论,art表的 comm字段+1
	//$sql = 'update art set comm=comm+1 where art_id='.$art_id;
	//mQuery($sql);
	if($rs) {
		$ref = $_SERVER['HTTP_REFERER'];
		$sql = 'update art set comm=comm+1 where art_id=' . $art_id;
		mQuery($sql);
		header("location:$ref");
	}
}


//查询评论列表  

$sql = "select * from comment where art_id=$art_id";
$comms = mGetAll($sql);


//print_r($art['title']);exit;
//print_r($art);exit;
$sql = "select catname,cat_id from cat";
$arr = mGetAll($sql);


include(ROOT . '/view/front/art.html');

?>