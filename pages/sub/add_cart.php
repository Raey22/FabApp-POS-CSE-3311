<?php
/*
*   CC BY-NC-AS UTA FabLab 2016-2018
*   FabApp V 0.91
*   Author: Glenda Robertson
*
*   Add item to cart and calculate price based on units
*/
session_start();
//initialize cart if not set or is unset
if(!isset($_SESSION['cart_array'])){
	echo 'Cart still was not set, go ahead and run that code';
	$_SESSION['cart_array'] = array();
	$_SESSION['co_quantity'] = array();
	$_SESSION['co_price'] = 0.0;
}

//check if product is already in the cart
if(!in_array($_GET['id'], $_SESSION['cart_array'])){
	array_push($_SESSION['cart_array'], $_GET['id']);
	array_push($_SESSION['co_quantity'], 1);

	//calculations for price based on units
	if($_GET['u'] == "gram(s)")
	{
		$_SESSION['co_price'] = number_format((float)((($_GET['m']) * $_GET['p'])* $_SESSION['co_quantity'][sizeof($_SESSION['co_quantity'])-1]+$_SESSION['co_price']), 2, '.', '');
	}
	else if($_GET['u'] == "sq_inch(es)")
	{
		$_SESSION['co_price'] = number_format((float)((($_GET['w']*$_GET['h']) * $_GET['p'])* $_SESSION['co_quantity'][sizeof($_SESSION['co_quantity'])-1]+$_SESSION['co_price']), 2, '.', '');
	}
	else
	{
		$_SESSION['co_price'] = number_format((float)(($_GET['p'])* $_SESSION['co_quantity'][sizeof($_SESSION['co_quantity'])-1]+$_SESSION['co_price']), 2, '.', '');
	}

	$_SESSION['success_msg'] = 'Product added to cart';
}
else{
	$_SESSION['error_msg'] = 'Product already in cart';
}

header('Location: /pages/all_goods.php');
?>
