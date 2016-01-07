<?php
// 商品情報の画像を削除
require_once("config.php");

$token = (isset($_POST['token'])) ? $_POST['token'] : NULL;
if (empty($token) && isset($_COOKIE['base_access_token'])) {
	$token = $_COOKIE['base_access_token'];
}
$item_id = (isset($_POST['item_id'])) ? $_POST['item_id'] : NULL;
$image_no = (isset($_POST['image_no'])) ? $_POST['image_no'] : NULL;

$params = array(
	'item_id' => $item_id,
	'image_no' => $image_no,
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
	$response_body = file_get_contents(API_HOST . '/' . API_VERSION . '/items/delete_image', false, $context);
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
	<h2>POST /<?php echo API_VERSION; ?>/items/delete_image</h2>
	<form method="POST" action="items_delete_image.php">
		access_token <input type="text" name="token" value="<?php echo $token; ?>" style="width:300px"><br>
		item_id <input type="text" name="item_id" value="<?php echo $item_id; ?>" style="width:300px"><br>
		image_no <input type="text" name="image_no" value="<?php echo $image_no; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<textarea style="width:600px;height:200px;"><?php echo $response_body; ?></textarea>
	<pre><?php var_dump($parsed_response); ?></pre>
</body>
</html>
