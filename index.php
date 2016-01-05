<?php
require_once('config.php');

$scope = (isset($_POST['scope'])) ? $_POST['scope'] : 'read_users read_users_mail read_items read_orders read_savings write_items write_orders';
$state = (isset($_POST['state'])) ? $_POST['state'] : 'テストです';

$redirect_uri = urlencode(REDIRECT_URI);

$oauth_url = API_HOST . '/' . API_VERSION . '/oauth/authorize?response_type=code&client_id=' . CLIENT_ID . '&redirect_uri=' . $redirect_uri . '&scope=' . urlencode($scope) . '&state=' . urlencode($state);
?>
<html>
<head>
	<meta charset="utf-8">
	<title>BASE API Debugger</title>
</head>
<body>
	<h1><a href="index.php">BASE API Debugger</a></h1>
	<h2>GET /<?php echo API_VERSION; ?>/oauth/authorize</h2>
	<p><a href="<?php echo $oauth_url; ?>"><?php echo $oauth_url; ?></a></p>
	<form method="POST" action="index.php">
		scope <input type="text" name="scope" value="<?php echo $scope; ?>" style="width:300px"><br>
		state <input type="text" name="state" value="<?php echo $state; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<br>
	<div><a href="oauth_token.php">POST /1/oauth/token</a></div>
	<br>
	<div><a href="users_me.php">GET /1/users/me</a></div>
	<br>
	<div><a href="items.php">GET /1/items</a></div>
	<div><a href="items_detail.php">GET /1/items/detail/:item_id</a></div>
	<div><a href="items_add.php">POST /1/items/add</a></div>
	<div><a href="items_edit.php">POST /1/items/edit</a></div>
	<div><a href="items_delete.php">POST /1/items/delete</a></div>
	<div><a href="items_add_image.php">POST /1/items/add_image</a></div>
	<div><a href="items_delete_image.php">POST /1/items/delete_image</a></div>
	<div><a href="items_edit_stock.php">POST /1/items/edit_stock</a></div>
	<div><a href="items_delete_variation.php">POST /1/items/delete_variation</a></div>
	<br>
	<div><a href="categories.php">GET /1/categories</a></div>
	<div><a href="categories_add.php">POST /1/categories/add</a></div>
	<div><a href="categories_edit.php">POST /1/categories/edit</a></div>
	<div><a href="categories_delete.php">POST /1/categories/delete</a></div>
	<br>
	<div><a href="item_categories_detail.php">GET /1/item_categories/detail/:item_id </a></div>
	<div><a href="item_categories_add.php">POST /1/item_categories/add</a></div>
	<div><a href="item_categories_delete.php">POST /1/item_categories/delete</a></div>
	<br>
	<div><a href="orders.php">GET /1/orders</a></div>
	<div><a href="orders_detail.php">GET /1/orders/detail/:unique_key</a></div>
	<div><a href="orders_edit_status.php">POST /1/orders/edit_status</a></div>
	<br>
	<div><a href="savings.php">GET /1/savings</a></div>
	<br>
	<div><a href="delivery_companies.php">GET /1/delivery_companies</a></div>
	<br>
	<div><a href="search.php">GET /1/search</a></div>
	<div><a href="search_refresh.php">GET /1/search/refresh</a></div>
</body>
</html>
