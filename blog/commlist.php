<?php
require('./lib/init.php');
$sql = 'select * from comment order by comment_id desc';
$arts = mGetAll($sql);
include(ROOT . '/view/admin/commlist.html');
?>