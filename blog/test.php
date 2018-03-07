<?php
function getIp() {
	static $realip = NULL;
	if ($realip !== NULL) {
		return $realip;
	} if (getenv('HTTP_X_FORWARDED_FOR')) {
		$realip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif (getenv('HTTP_CLIENT_IP')) {
		$realip = getenv('HTTP_CLIENT_IP');
	} else {
		$realip = getenv('REMOTE_ADDR');
	} return $realip;
}

echo $a = ip2long(getIp());
echo '=============';
echo sprintf('%u',$a);
?>