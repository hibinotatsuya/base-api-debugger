<?php
// 商品情報を取得
require_once("config.php");

$token = (isset($_POST['token'])) ? $_POST['token'] : NULL;
if (empty($token) && isset($_COOKIE['base_access_token'])) {
	$token = $_COOKIE['base_access_token'];
}
$item_id = (isset($_POST['item_id'])) ? $_POST['item_id'] : NULL;

$headers = array(
	'Authorization: Bearer ' . $token,
);
$request_options = array(
	'http' => array(
		'method'  => 'GET',
		'header'  => implode("\r\n", $headers),
		'ignore_errors' => true,
	),
);
$context = stream_context_create($request_options);

$response_body = '';
$parsed_response = '';
if (!empty($_POST)) {
	$response_body = file_get_contents(API_HOST . '/' . API_VERSION . '/items/detail/' . $item_id, false, $context);
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
	<h2>GET /<?php echo API_VERSION; ?>/items/detail/:item_id</h2>
	<form method="POST" action="items_detail.php">
		access_token <input type="text" name="token" value="<?php echo $token; ?>" style="width:300px"><br>
		item_id <input type="text" name="item_id" value="<?php echo $item_id; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<textarea style="width:600px;height:200px;"><?php echo $response_body; ?></textarea>
	<pre><?php var_dump($parsed_response); ?></pre>
</body>
</html>
