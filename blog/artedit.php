<?php
require('./lib/init.php');

$art_id = $_GET['art_id'];

//判断地址栏传来的art_id是否合法
if(!is_numeric($art_id)) {
	error('文章id不合法');
}

//是否有这篇文章
$sql1 = "select title,content,cat_id,arttag from art where art_id = $art_id";

//var_dump(mQuery($sql1));exit;


if(!mGetRow($sql1)) {
	error('文章不存在');
}		
		$sql2 = 'select * from cat';
		$cat = mGetAll($sql2);

if(empty($_POST)){
		$sql = 'select * from art where art_id ='.$art_id;
		$art = mGetRow($sql);

		//print_r($cat);exit;
	
		
		//print_r($art);exit;
		include(ROOT . '/view/admin/artedit.html');
} else {
			//检测art_id 是否为数字
			if(!is_numeric($art_id)) {
				error('参数错误');
		}
		
		//检测标题是否为空
		$art['title'] = trim($_POST['title']);
		if(empty($art['title'])){
			error('标题不能为空');
		}
		

		
		//检测内容
		$art['content'] = trim($_POST['content']);
		if(empty($art['content'])) {
			error('内容不能为空');
		}
		
		//查询是否有文章
		$sql = 'select count(*) from art where art_id=' . $art_id;
		//没有这篇文章
	if(!mGetOne($sql)){
		error(mysql_error());
	}
	$art['lastup'] = time();
	
	if(!mExec('art',$art,'update',"art_id=$art_id")) {
		error('文章修改失败');
	} else {
		succ('文章修改成功');
		//删除所有tag表的所有tag  再insert into 插入新的tag
	}
		
	
}




?>