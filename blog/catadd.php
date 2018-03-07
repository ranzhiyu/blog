<?php
//require('./test.php');
require('./lib/init.php');
if(empty($_POST)) {
	include(ROOT . '/view/admin/catadd.html');
} else {
	//print_r($_POST );exit;
	
	
	$cat['catname'] = trim($_POST['catname']);
	//print_r($catname);
	//var_dump(empty($catname['catname']));exit;
	//栏目是否为空
	if(empty($cat['catname'])) {
		//include('view/admin/catadd.html');
		error('请别为空');exit;
	}
	
	$sql = "select count(*) from cat where catname = '$cat[catname]'";
	$rs = mQuery($sql);
	//var_dump($rs);exit();
	//print_r(mysqli_fetch_row($rs));exit();
	$row = mysqli_fetch_row($rs)[0];
	if($row) {
		echo '栏目已经存在 请重新输入';
		exit;
	} else {
	//insert into cat (catname) values ('$cat[catname]')";
	
	
	//var_dump(mExec('cat',array('asdf asdf ')));exit;
	
	if(mExec('cat',$cat)) {
		succ('栏目插入成功');
	} else {
		error('栏目插入失败');
		}
	}
	
	

	
  }



?>