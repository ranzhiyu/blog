<?php



/**	
mysql系列操作函数

**/

/**
连接数据库   连接成功 返回资源或者布尔值

**/

function mConn() {
	static $conn = null;
	$cfg = require (ROOT . '/lib/config.php');
	if($conn == null) {
		$conn = mysqli_connect($cfg['host'],$cfg['user'],$cfg['password']);
		mysqli_query($conn,'use ' . $cfg['db']);
		mysqli_query($conn,"set names " . $cfg['charset']);
	}
	
	return $conn;
}

function mQuery($sql) {
	$rs = mysqli_query(mConn(),$sql);
	if($rs) {
		mLog($sql);
	} else {
		mLog($sql . "\n" . mysqli_error(mConn()));
	}
	
	return $rs;
}


/**
log日志功能
@param  str  $str   带记录日志功能
**/

function mLog($str) {
	$filename = ROOT . '/log/' . date('Ymd') . '.txt';
	$log = "-----------------------------------------

-----------------------------------------------------------------------------------------------\n".date('Y/m/d H:i:s') . "\n" . $str ."\n" . "-----------------------------------------

-------------------------------------------------------------------------------------------------------------------------------\n\n";
	return file_put_contents($filename , $log , FILE_APPEND);
}







/**
  查询返回二维数据
  @return mixed select 查询成功返回二位数组  失败返回false
**/

function mGetAll($sql) {
	$rs = mQuery($sql);
	if(!$rs) {
		return false;
	}
	
	$data = array();
	while($row = mysqli_fetch_assoc($rs)) {
		$data[] = $row;
	}
	return $data;
}

/**
查询 返回一维数组
@return miexd select 查询成功返回一维数组 失败返回false
**/


function mGetRow($sql) {
	$rs = mQuery($sql);
	if(!$rs) {
		return false;
	}
	
	return mysqli_fetch_assoc($rs);
}


/**
查询返回一个结果
select count(*) from cat where cat_id = 1;
**/





function mGetOne($sql) {
	$rs = mQuery($sql);
	if(!$rs) {
		return false;
	}
	
	return mysqli_fetch_row($rs)[0];
}




//$sql = 'select count(*) from art where cat_id = 34';

//print_r(mGetOne($sql));



/**
insert into cat () values () 
自动拼接insert 语句和 update 语句 并且调用mQuery去执行sql

@param   str   $table   表名
@param   arr   $data	一维数组
@param   str   $act     动作  默认为  insert
@param   str   $where   防止update 更改时少加where条件;
@return  bool  insert 或者update 成功或者失败;
**/

function mExec($table,$data,$act='insert',$where = 0) {
	if($act == 'insert') {
		$sql = "insert into $table (";
		$sql .= implode(',',array_keys($data)) . ") values ('";
		$sql .= implode("','",array_values($data)) . "')";
		return mQuery($sql);
	} else if($act == 'update') {
		$sql = "update $table set ";
		foreach($data as $k=>$v) {
			$sql .= $k . "='" . $v ."',";
		}
		$sql = rtrim($sql , ',') . ' where ' . $where;
		return mQuery($sql);
	}
}



/**
取得上一步操作的主键ID
**/

function getLastId() {
	return mysqli_insert_id(mConn());
}

function getIp() {
	
	
	static $realip = null;
	if($realip !== null) {
		return $realip;
	} 
	
	if(getenv('HTTP_X_FORWARDED_FOR')) {
		$realip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif (getenv('HTTP_CLIENT_IP')) {
		$realip = getenv('HTTP_CLIENT_IP');
	} else {
		$realip = getenv('REMOTE_ADDR');
	}
	
	return $realip;
}


//var_dump(mysqli_query(mConn(),'select * from cat'));
//var_dump(mQuery('select *from cat'));


?>