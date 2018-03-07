<?php


/*
成功的提示信息
*/
function succ($res) {
	$result = 'succ';
	require(ROOT . '/view/admin/info.html');
	exit;
}

/*
失败的返回信息
*/
function error($res) {
	$result = 'fail';
	require(ROOT . '/view/admin/info.html');
	exit;
}

/*
计算分页代码/假设五个页码数
@param  int $num  总文章数
@param  int $cnt  每页显示文章数
@param  int $curr 当前显示页码数
@rerun arr $pages  返回一个页码数=>地址栏值得关联数组
*/


function cPager($num , $cnt , $curr) {
	//计算最大页码数  $max
	$max = ceil($num/$cnt);
	
	//计算最左边的页码数
	$left = max($curr - 2,1);
	
	$right = $left + 4;
	$right = min($max,$right);
	$left = $right - 4;
	$left = max($left,1);
	
	//将获取的五个页码数  放进数组里
	for($i=$left; $i<= $right; $i++) {
		$_GET['page'] = $i;
		$pages[$i] = http_build_query($_GET);
	}
	
	return $pages;
}


/*
按日期创建储存目录
*/
function createDir() {
	$path = '/upload/'.date('Y/m');
	
	$abs = ROOT . $path;
	if(is_dir($abs) || mkdir($abs , 0777 , true)) {
		return $path;
	} else {
		return false;
	}
}

/****
	生成随机字符串
	@param int $length  产生几位随机字符
****/

function randStr($length=6) {
	$str = str_shuffle('ABCDECGHSLDFKASLDKFJIALSKJDFLKAJDSLFKasdfasdfasdf');
	$str = substr($str, 0 , $length);
	return $str;
}

function getExt($name) {
	return strrchr($name , '.');
}

























?>