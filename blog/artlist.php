<?php
require('./lib/init.php');

$sql = "select art_id,title,pubtime,comm,catname from art left join cat on art.cat_id=cat.cat_id";
$arts = mGetAll($sql);
//print_r($arts);





include(ROOT . '/view/admin/artlist.html');

?>