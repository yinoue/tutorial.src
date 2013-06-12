<?php
require_once('config.php');
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
      ユーザ認可
    </div>
    <script>
      mixi.init({
          appId:    "<?=CONSUMER_KEY ?>",
          relayUrl: "<?=RELAY_URL ?>"
      });
      mixi.auth({
          scope: "mixi_apps2 r_profile",
          state: "sessionId"
      });
    </script>
  </body>
</html>
