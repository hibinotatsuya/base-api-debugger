<?php
// 商品の検索結果を取得
require_once("config.php");

$q = (isset($_POST['q'])) ? $_POST['q'] : 'Tシャツ ブラック';
$sort = (isset($_POST['sort'])) ? $_POST['sort'] : 'order_count desc,price asc';
$start = (isset($_POST['start'])) ? $_POST['start'] : 0;
$size = (isset($_POST['size'])) ? $_POST['size'] : 10;
$fields = (isset($_POST['fields'])) ? $_POST['fields'] : 'title,detail';
$shop_id = (isset($_POST['shop_id'])) ? $_POST['shop_id'] : NULL;

$params = array(
	'client_id' => CLIENT_ID_FOR_SEARCH,
	'client_secret' => CLIENT_SECRET_FOR_SEARCH,
	'q'  => $q,
	'sort' => $sort,
	'start' => $start,
	'size' => $size,
	'fields' => $fields,
	'shop_id' => $shop_id,
);
$request_options = array(
	'http' => array(
		'method'  => 'GET',
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
	$response_body = file_get_contents(API_HOST . '/' . API_VERSION . '/search?' . http_build_query($params), false, $context);
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
	<h2>GET /<?php echo API_VERSION; ?>/search</h2>
	<form method="POST" action="search.php">
		q <input type="text" name="q" value="<?php echo $q; ?>" style="width:300px"><br>
		sort <input type="text" name="sort" value="<?php echo $sort; ?>" style="width:300px"><br>
		start <input type="text" name="start" value="<?php echo $start; ?>" style="width:300px"><br>
		size <input type="text" name="size" value="<?php echo $size; ?>" style="width:300px"><br>
		fields <input type="text" name="fields" value="<?php echo $fields; ?>" style="width:300px"><br>
		shop_id <input type="text" name="shop_id" value="<?php echo $shop_id; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<textarea style="width:600px;height:200px;"><?php echo $response_body; ?></textarea>
	<pre><?php var_dump($parsed_response); ?></pre>
</body>
</html>
