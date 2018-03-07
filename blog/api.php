<?php
    function send_mail() {
      $url = 'http://api.sendcloud.net/apiv2/mail/send';
      $API_USER = 'ranzhiyu_test_cSfdAa';
      $API_KEY = '8TkIt40Xc8LyfzBD';

      //您需要登录SendCloud创建API_USER，使用API_USER和API_KEY才可以进行邮件的发送。
      $param = array(
          'apiUser' => $API_USER,
          'apiKey' => '8TkIt40Xc8LyfzBD',
          'from' => '1039670100@qq.com',
          'fromName' => '1039670100@qq.com',
          'to' => '478656097@qq.com',
          'subject' => '来自SendCloud的第一封邮件！',
          'html' => '你太棒了！你已成功的从SendCloud发送了一封测试邮件，接下来快登录前台去完善账户信息吧！',
          'respEmailId' => 'true');

    $data = http_build_query($param);

    $options = array(
          'http' => array(
          'method'  => 'POST',
          'header'  => 'Content-Type: application/x-www-form-urlencoded',
          'content' => $data
    ));

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return $result;
  }
echo send_mail();