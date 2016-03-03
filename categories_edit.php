<?php
// カテゴリー情報を更新
require_once("config.php");

$token = (isset($_POST['token'])) ? $_POST['token'] : NULL;
if (empty($token) && isset($_COOKIE['base_access_token'])) {
	$token = $_COOKIE['base_access_token'];
}
$category_id = (isset($_POST['category_id'])) ? $_POST['category_id'] : NULL;
$name = (isset($_POST['name'])) ? $_POST['name'] : NULL;
$list_order = (isset($_POST['list_order'])) ? $_POST['list_order'] : NULL;

$params = array(
	'category_id' => $category_id,
	'name' => $name,
	'list_order' => $list_order,
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
	'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
	),
);
$context = stream_context_create($request_options);

$response_body = '';
$parsed_response = '';
if (!empty($_POST)) {
	$response_body = file_get_contents(API_HOST . '/' . API_VERSION . '/categories/edit', false, $context);
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
	<h2>POST /<?php echo API_VERSION; ?>/categories/edit</h2>
	<form method="POST" action="categories_edit.php">
		access_token <input type="text" name="token" value="<?php echo $token; ?>" style="width:300px"><br>
		category_id <input type="text" name="category_id" value="<?php echo $category_id; ?>" style="width:300px"><br>
		name <input type="text" name="name" value="<?php echo $name; ?>" style="width:300px"><br>
		list_order <input type="text" name="list_order" value="<?php echo $list_order; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<textarea style="width:600px;height:200px;"><?php echo $response_body; ?></textarea>
	<pre><?php var_dump($parsed_response); ?></pre>
</body>
</html>
