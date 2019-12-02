<?php
/*
*   CC BY-NC-AS UTA FabLab 2016-2018
*   FabApp V 0.91
*   Author: Glenda Robertson

*   Delete item from cart and recalculate price based on units
*/
	session_start();

	//remove the id from our cart array
	$key = array_search($_GET['id'], $_SESSION['cart_array']);
		if($_GET['u'] == "gram(s)")
		{
			$_SESSION['co_price'] = number_format((float)($_SESSION['co_price'] - (($_GET['m'] * $_GET['p'])* $_SESSION['co_quantity'][$key])), 2, '.', '');
		}
		else if($_GET['u'] == "sq_inch(es)")
		{
			$_SESSION['co_price'] = number_format((float)($_SESSION['co_price'] - ((($_GET['w']*$_GET['h']) * $_GET['p'])* $_SESSION['co_quantity'][$key])), 2, '.', '');
		}
		else
		{
			$_SESSION['co_price'] = number_format((float)($_SESSION['co_price'] - ($_GET['p']* $_SESSION['co_quantity'][$key])), 2, '.', '');
		}
	unset($_SESSION['cart_array'][$key]);
    unset($_SESSION['co_quantity'][$key]);

	//rearrange array after unset
	$_SESSION['cart_array'] = array_values($_SESSION['cart_array']);
    $_SESSION['co_quantity'] = array_values($_SESSION['co_quantity']);


	$_SESSION['success_msg'] = "Product deleted from cart";
	header('Location: /pages/cart.php');
?>
