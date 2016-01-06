<?php
// 商品のカテゴリー情報を登録
require_once("config.php");

$token = (isset($_POST['token'])) ? $_POST['token'] : NULL;
if (empty($token) && isset($_COOKIE['base_access_token'])) {
	$token = $_COOKIE['base_access_token'];
}
$item_category_id = (isset($_POST['item_category_id'])) ? $_POST['item_category_id'] : NULL;

$params = array(
	'item_category_id' => $item_category_id,
);
$headers = array(
	'Authorization: Bearer ' . $token,
	'Content-Type: application/x-www-form-urlencoded',
);
$request_options = array(
	'http' => array(
		'method'  => 'POST',
		'header'  => implode("\r\n", $headers),
		'content' => http_build_query($params),
		'ignore_errors' => true,
	),
);
$context = stream_context_create($request_options);

$response_body = '';
$parsed_response = '';
if (!empty($_POST)) {
	$response_body = file_get_contents(API_HOST . '/' . API_VERSION . '/item_categories/delete', false, $context);
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
	<h2>POST /<?php echo API_VERSION; ?>/item_categories/delete</h2>
	<form method="POST" action="item_categories_delete.php">
		access_token <input type="text" name="token" value="<?php echo $token; ?>" style="width:300px"><br>
		item_category_id <input type="text" name="item_category_id" value="<?php echo $item_category_id; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<textarea style="width:600px;height:200px;"><?php echo $response_body; ?></textarea>
	<pre><?php var_dump($parsed_response); ?></pre>
</body>
</html>
