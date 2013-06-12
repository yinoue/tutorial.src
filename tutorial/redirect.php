<?php
require_once('config.php');

$url = 'https://secure.mixi-platform.com/2/token';

$headers = array(
	'Content-type: application/x-www-form-urlencoded',
);

$params = array(
	'grant_type'    => 'authorization_code',
	'client_id'     => CONSUMER_KEY,
	'client_secret' => CONSUMER_SECRET,
	'code'          => $_GET['code'],
	'redirect_uri'  => REDIRECT_URI,
);
$params = http_build_query($params);

$ch = curl_init();                               // init
curl_setopt($ch, CURLOPT_URL, $url);             // URLをセット
curl_setopt($ch, CURLOPT_POST, true);            // POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);   // params
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  // header
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 証明書を無視
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // curl_exec()の結果を文字列で返す
$c = curl_exec($ch);                             // 実行
$c = json_decode($c, true);
curl_close($ch);                                 // close

$_SESSION['access_token']  = $c['access_token'];
$_SESSION['refresh_token'] = $c['refresh_token'];

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>はじめてのmixiアプリ</title>
  </head>
  <body>
    <div>
      リダイレクトURI
    </div>
    <hr />
    <div>
      ユーザ認可とAuthorization Codeの取得
    </div>
    <div>
      code: <?=$_GET['code'] ?>
    </div>
    <div>
      state: <?=$_GET['state'] ?>
    </div>
    <div>
      error: <?= (isset($_GET['error'])) ? $_GET['error'] : '' ?>
    </div>
    <hr />
    <div>
      アクセストークンの取得
    </div>
    <div>
      <pre><?=print_r($c, true) ?></pre>
    </div>
    <div>
      <a href="start.php">top</a>
    </div>
  </body>
</html>
