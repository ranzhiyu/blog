<?php
require('./lib/init.php');
$comment_id = $_GET['comment_id'];
$art_id = $_GET['art_id'];

//echo $comment_id;

//判断传过来的ip是否合法
if(!is_numeric($comment_id)) {
	error('参数不合法');
}

//判断是否有这条评论
$sql = 'select content from comment where comment_id='.$comment_id;
$rs = mGetOne($sql);
if(!$rs) {
		header('location:index.php');
}

$sql = 'delete from comment where comment_id='.$comment_id;
if(mQuery($sql)) {
	$sql = 'update art set comm=comm-1 where art_id= '.$art_id;

	var_dump(mQuery($sql));exit;
	header('location:commlist.php');
} else error('删除错误');


