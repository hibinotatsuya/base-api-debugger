<?php
// アクセストークンを取得
require_once("config.php");

$code = (isset($_POST['code'])) ? $_POST['code'] : NULL;
$grant_type = (isset($_POST['grant_type'])) ? $_POST['grant_type'] : 'authorization_code';
$refresh_token = (isset($_POST['refresh_token'])) ? $_POST['refresh_token'] : NULL;

$params = array(
	'client_id'     => CLIENT_ID,
	'client_secret' => CLIENT_SECRET,
	'redirect_uri'  => REDIRECT_URI,
	'grant_type'    => $grant_type,
	'code'          => $code,
	'refresh_token' => $refresh_token,
);
var_dump($params);
$headers = array(
	'Content-Type: application/x-www-form-urlencoded',
);
$request_options = array(
	'http' => array(
		'method'  => 'POST',
		'content' => http_build_query($params),
		'header'  => implode("\r\n", $headers),
		'ignore_errors' => true,
	),
);
$context = stream_context_create($request_options);

$response_body = '';
$parsed_response = '';
if (!empty($_POST)) {
	$response_body = file_get_contents(API_HOST . '/' . API_VERSION . '/oauth/token', false, $context);
	$parsed_response = json_decode($response_body, true);
}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>BASE API Debugger</title>
</head>
<body>
	<h1><a href="index.php">BASE API Debugger</a></h1>
	<h2>POST /<?php echo API_VERSION; ?>/oauth/token</h2>
	<form method="POST" action="oauth_token.php">
		code <input type="text" name="code" value="<?php echo $code; ?>" style="width:300px"><br>
		grant_type <input type="text" name="grant_type" value="<?php echo $grant_type; ?>" style="width:300px"><br>
		refresh_token <input type="text" name="refresh_token" value="<?php echo $refresh_token; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<textarea style="width:600px;height:200px;"><?php echo $response_body; ?></textarea>
	<pre><?php var_dump($parsed_response); ?></pre>
</body>
</html>
