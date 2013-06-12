<?php
require_once('config.php');

$userId  = '@me';
$groupId = (empty($_GET['groupId'])) ? '@self' : $_GET['groupId'];
$url = "https://api.mixi-platform.com/2/people/{$userId}/{$groupId}";

$headers = array(
	"Authorization: Bearer {$_SESSION['access_token']}",
);
$ch = curl_init();                               // init
curl_setopt($ch, CURLOPT_URL, $url);             // URLをセット
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  // header
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 証明書を無視
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // curl_exec()の結果を文字列で返す
$c = curl_exec($ch);                             // 実行
$c = json_decode($c, true);
curl_close($ch);                                 // close

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>はじめてのmixiアプリ</title>
    <script type="text/javascript" charset="UTF-8" src="http://static.mixi.jp/js/application/connect.js"></script>
  </head>
  <body>
    <div>
      <?= ($groupId == '@friends') ? '友人' : '自分' ?>の情報を取得
    </div>
    <div>
      <pre><?=print_r($c, true) ?></pre>
    </div>
    <div>
      <a href="start.php">top</a>
    </div>
  </body>
</html>
