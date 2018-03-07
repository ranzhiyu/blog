<?php
require('./lib/init.php');

$sql = "select * from cat";
$cats = mGetAll($sql);
//print_r($cats); exit;


if(empty($_POST)) {
	require(ROOT . '/view/admin/artadd.html');
} else {
	
	
	//检测标题是否为空
	$art['title'] = trim($_POST['title']);
	if($art['title'] == '') {
		error('标题不能为空');
	}
	
	//检测栏目是否合法
	$art['cat_id'] = $_POST['cat_id'];
	if(!is_numeric($art['cat_id'])) {
		error('栏目不合法');
	}
	
	//检测内容是否合法
	$art['content'] = trim($_POST['content']);
	if($art['content'] == '') {
		error('内容为空');
	}
	
	
	//插入内容到art表
	//插入发布时间
	//print_r(Exec('art',$art));exit;
	
	
	$art['pubtime'] = time();
	
	$art['arttag'] = $_POST['tag'];
	
	/*
		文件上传
	*/

	echo '<pre>';


	if(!empty($_FILES) && $_FILES['pic']['error'] == 0) {
		$fileName = createDir() . '/' . randStr() . getExt($_FILES['pic']['name']);
		if(move_uploaded_file($_FILES['pic']['tmp_name'], ROOT . $fileName)) {
			$art['pic'] = $fileName;
		}
	}

	

	if(!empty($_FILES['pic']['name'] == '') && $_FILES['pic']['error'] == 0){
		
	}
	
	
	
	
	
	
	if(!mExec('art',$art)) {
		error('插入内容失败');
	} else {
		$art['tag'] = $_POST['tag'];
		if($art['tag'] == '') {
			succ('文章添加成功');
		} else {
			//获取上册insert产生的id
			$art_id = getLastId();
			//插入到tag表中
			$sql = "insert into tag (art_id,tag) values ";
			$tag = explode(',',$art['tag']);
			foreach($tag as $k=>$v) {
				$sql .= '(' . $art_id . ",'" . $v ."'),";
			}
			$sql = rtrim($sql , ',');
			//echo $sql;
			if(mQuery($sql)) {
				//给cat的文章数 num+1
				$sql = 'update cat set num=num+1 where cat_id=' . $art['cat_id'];
				mQuery($sql);
				succ('文章添加成功');
			} else {
				$sql = 'delete from art where art_id=' . $art_id;
				mQuery($sql);
				error('文章添加失败');
			}
			
			
			
		}
	}
}

?>