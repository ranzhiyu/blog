<?php   


   $conn = mysqli_connect('localhost','root','');
	mysqli_query($conn,'use blog');
	mysqli_query($conn,'set names utf8');
	
	$sql = "select * from cat";
	$rs = mysqli_query($conn,$sql);
	//$row = mysqli_fetch_assoc($rs);print_r($row);exit;
	$cat = array();
	while( $row = mysqli_fetch_assoc($rs)) {
		$cat[] = $row;
	}
	
	/*echo '<pre>';
	foreach($arr as $k ) {
		print_r($k);
	}
	*/
require('view/admin/catlist.html');
	
	



?>