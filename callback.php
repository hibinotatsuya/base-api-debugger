<?php
// コールバックに戻ってきてからアクセストークンを取得
require_once("config.php");

$code = '';
if (isset($_GET['code'])) {
	$code = $_GET['code'];
}

$params = array(
	'client_id'     => CLIENT_ID,
	'client_secret' => CLIENT_SECRET,
	'redirect_uri'  => REDIRECT_URI,
	'grant_type'    => 'authorization_code',
	'code'          => $code,
);
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

$response_body = file_get_contents(API_HOST . '/' . API_VERSION . '/oauth/token', false, $context);
$parsed_response = json_decode($response_body, true);
?>
<html>
<head>
	<meta charset="utf-8">
	<title>BASE API Debugger</title>
</head>
<body>
	<h1><a href="index.php">BASE API Debugger</a></h1>
	<h2>POST /<?php echo API_VERSION; ?>/oauth/token</h2>
	<textarea style="width:600px;height:200px;"><?php echo $response_body; ?></textarea>
	<pre><?php var_dump($parsed_response); ?></pre>
</body>
</html>
