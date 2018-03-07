<?php
require('./lib/init.php');
$sql = 'select cat_id,num,catname from cat';
$cats = mGetAll($sql);

//计算分页代码
$sql = 'select count(*) from art';
$num = mGetOne($sql);//获取总文章数
$cnt = 2;//每页显示文章数
$curr = isset($_GET['page']) ? $_GET['page'] : 1;//当前页码数 从地址栏的page值来获取
$pagers = cPager($num,$cnt,$curr);


//判断地址栏是否有cat_id
//$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
if(isset($_GET['cat_id'])){
	$where = " and art.cat_id = $_GET[cat_id]";
} else {
	$where = '';
}



//查询所有的文章
$sql = 'select art_id,arttag,art.cat_id,user_id,nick,pubtime,title,comm,content,cat.catname
from art left join cat on art.cat_id=cat.cat_id where 1 '.$where;
//echo $sql;
$arts = mGetAll($sql);
//print_r($arts);exit;


require("./view/front/index.html");


?>