<?php

 //This will import all of the CSS and HTML code necessary to build the basic page
 include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/header.php');

 // //verify authentication access
 // if (!$staff || $staff->getRoleID() < $sv['LvlOfStaff']){
 //   //Not Authorized to see this Page
 //   $_SESSION['error_msg'] = "You are unable to view this page.";
 //   header('Location: /index.php');
 //   exit();
 // }

?>
<html>
	<head>
		<meta charset="utf-8">
		<title>FabApp Inventory</title>
	</head>
	<body>
		<div id="page-wrapper">
			<h2>Inventory</h2>
			<div class="col-lg-12">
				<p>Add, Edit, or Update materials here</p>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6">
					<a href="show_inventory.php" class="btn btn-default">Glass</a>
				</div>
				<div class="col-lg-6">
					<a href="" class="btn btn-default">Wood</a>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6">
					<a href="" class="btn btn-default">Acrylic</a>
				</div>
				<div class="col-lg-6">
					<a href=" " class="btn btn-default">Vinyl</a>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6">
					<a href=" " class="btn btn-default">ABS</a>
				</div>
				<div class="col-lg-6">
					<a href="" class="btn btn-default">Sheet</a>
				</div>
			</div>
		</div>



	</body>
	<?php
  //Standard call for dependencies
  include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
  ?>
</html>
