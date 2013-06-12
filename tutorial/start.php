<?php
require_once('OAuth.php');
require_once('config.php');

define('PUBLIC_KEY_PC_TOP', '-----BEGIN CERTIFICATE-----
MIIDfDCCAmSgAwIBAgIJAI2n8UOEH7KvMA0GCSqGSIb3DQEBBQUAMDIxCzAJBgNV
BAYTAkpQMREwDwYDVQQKEwhtaXhpIEluYzEQMA4GA1UEAxMHbWl4aS5qcDAeFw0x
MjAxMjAwMzI4MDVaFw0xNDAxMTkwMzI4MDVaMDIxCzAJBgNVBAYTAkpQMREwDwYD
VQQKEwhtaXhpIEluYzEQMA4GA1UEAxMHbWl4aS5qcDCCASIwDQYJKoZIhvcNAQEB
BQADggEPADCCAQoCggEBAMZLyyXIS+3ReOuBrh5Vztt0aJwDPSgKw/Pi29B/3ODQ
3oN+tOYGVGIN1l+V40h3QmII94OpnjoB6CbnoVdE+WIDkPx6MMzPfiWF8pbbkBad
7WBe0T51l+EOFvRlZ0ZfHmldHGZl7GkDmXLu6jk4vcQyHFB/VS5hWpqDNw4i9vSO
7mHspbS2cudoagJvxqwoT+ciqy1S+Nuk2Eqll7C7wL+mnTrjtC25y4zYKfWS6MpM
rt3UlDuK75+dtknYKTNtLMVsshi/A4KMHQip0V6N4EKG+zIRExFoyPvHjTpQjJNk
q7JF7sshPV9MIPYRwy9WJt88P80aznFR6kgp63/C0r0CAwEAAaOBlDCBkTAdBgNV
HQ4EFgQUoiRidW+vFnj49TfzYLSKsDqI5QMwYgYDVR0jBFswWYAUoiRidW+vFnj4
9TfzYLSKsDqI5QOhNqQ0MDIxCzAJBgNVBAYTAkpQMREwDwYDVQQKEwhtaXhpIElu
YzEQMA4GA1UEAxMHbWl4aS5qcIIJAI2n8UOEH7KvMAwGA1UdEwQFMAMBAf8wDQYJ
KoZIhvcNAQEFBQADggEBAJRIEbo8i44KWms5Svj0NmvweumgMbANC1k5Yf93w6wk
Zbw+fJM+uxcxu6Z+k631+AGlahqxM/y4wXfsKfykwW6L3k4BWy/4w4owdj+5VOC7
32G8BkhdVEP3u5cq+ySp0K1EU2AaQ6lgqaQ4T1cHZjhBrBSGiUYbwKqboqbrz7ne
lvycCgLbvSCa4tewEkRIwhWbc+t9FNoJTdkJIN2mdqqq5yxQMIRyKM1025fEwhw8
pX6fDv4N+LlyA2qbk+YovEQGll0fkqughEHw+K5FSdQjJ/GFnuRslOi/qCvVBc3F
VPdLqcLz5IY3iYNonlca4VQzKp3TUjSluZIXvx7Hnhc=
-----END CERTIFICATE-----');

class MixiSignatureMethod extends OAuthSignatureMethod_RSA_SHA1{

	protected function fetch_public_cert(&$request){
		return PUBLIC_KEY_PC_TOP;
	}

	protected function fetch_private_cert(&$request){
		return;
	}
}

if(isset($_POST["oauth_signature"])){

	// Build a request object from the current request
	$request = OAuthRequest::from_request();

	// Initialize the new signature method
	$signatureMethod = new MixiSignatureMethod();

	// Check the request signature
	$signature = $_POST["oauth_signature"];
	$signatureValid = $signatureMethod->check_signature($request, null, null, $signature);

	if($signatureValid) $msg = 'OK';
	else                $msg = 'NG';

}else $msg = '未検証';

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>はじめてのmixiアプリ</title>
  </head>
  <body>
    <div>
      はじめてのmixiアプリ
    </div>
    <div>
      署名検証:<?=$msg ?>
    </div>
    <ul>
      <li><a href="user-auth.php">ユーザ認可</a></li>
      <li><a href="graph-people-get.php">自分の情報を取得</a></li>
      <li><a href="graph-people-get.php?groupId=@friends">友人の情報を取得</a></li>
    </ul>
    <div>
      <a href="start.php">top</a>
    </div>
  </body>
</html>
