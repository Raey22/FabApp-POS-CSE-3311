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
			<!-->  <!-->
			<div class="row" style="padding-top: 3px;">
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<div class="caption">
						<h3>Sheet Goods</h3>
						<p>Our sheet goods ...</p>
						<p><a href="sheet_goods_category.php" class="btn btn-primary" role="button">See items</a> 
						<?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
						<a href="#" class="btn btn-default" role="button">Edit Category</a></p>
						<? }?>	</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<div class="caption">
						<h3>ABS</h3>
						<p>Our ABS...</p>
						<?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
							<a href="#" class="btn btn-default" role="button">Edit Category</a></p>		
						<? }?>
								
						<p>
						<?php
                        $result = $mysqli->query("SELECT m_id FROM materials WHERE m_name = 'ABS (Generic)'");
                        $row = $result->fetch_assoc();
                        echo "<a href='show_inventory.php?inventory=ABS&id=".$row[m_id]."' class='btn btn-primary' role='button'>See items</a>";?>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<div class="caption">
						<h3>Vinyl</h3>
						<p>Our Vinyl...</p>
						<p>
						<?php
                        $result = $mysqli->query("SELECT m_id FROM materials WHERE m_name = 'Vinyl (Generic)'");
                        $row = $result->fetch_assoc();
                        echo "<a href='show_inventory.php?inventory=Vinyl&id=".$row[m_id]."' class='btn btn-primary' role='button'>See items</a>";?>
						<?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
						<a href="#" class="btn btn-default" role="button">Edit Category</a></p>
						<? }?></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<div class="caption">
						<h3>Screen Ink</h3>
						<p>Our Screen Ink...</p>
						<p><a href="show_inventory.php?inventory=Screen+Ink" class="btn btn-primary" role="button">See items</a> 
						<?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
						<a href="#" class="btn btn-default" role="button">Edit Category</a></p>
						<? }?></div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<div class="caption">
						<h3>Ninja Flex</h3>
						<p>Our Ninja Flex...</p>
						<p><a href="show_inventory.php?inventory=Ninja+Flex" class="btn btn-primary" role="button">See items</a> 
						<?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
						<a href="#" class="btn btn-default" role="button">Edit Category</a></p>
						<? }?>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<div class="caption">
						<h3>Other</h3>
						<p>Other items...</p>
						<p><a href="show_inventory.php?inventory=Other" class="btn btn-primary" role="button">See items</a> 
						<?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?><a href="#" class="btn btn-default" role="button">Edit Category</a></p>
						<? }?>
					</div>
					</div>
				</div>
				
			</div>
			<div >
			
				<?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
					<a href="#" class="btn btn-default" role="button"><i class="fas fa-plus"></i> Add Category</a>
				<? }?>
				
						
				
			</div>
				
			</div>
			
			


	</body>
	<?php
  //Standard call for dependencies
  include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
  ?>
</html>
