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
			<h2> <a href = "inventory.php"><i class="fas fa-angle-left"></i></a> Sheet Goods</h2>
			<div class="col-lg-12">
				<p>Add, Edit, or Update materials here</p>
			</div>
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<div class="caption">
						<h3>Acrylic</h3>
                        <br>
                        <p>
                        
                        <?php 
                        //get the m_id for the category 
                        $result = $mysqli->query("SELECT m_id FROM materials WHERE m_name = 'Acrylic'");
                        $row = $result->fetch_assoc();
                        echo "<a href='show_inventory.php?inventory=Acrylic&id=".$row[m_id]."' class='btn btn-primary' role='button'>See items</a>";?>
                        <?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
							<a href="#" class="btn btn-default" role="button">Edit Category</a></p>		
						<? }?>
                        </div>
                        
                    </div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<div class="caption">
						<h3>Glass</h3>
                        <br>
						<p>
                        <?php
                        $result = $mysqli->query("SELECT m_id FROM materials WHERE m_name = 'Glass (Generic)'");
                        $row = $result->fetch_assoc();
                        echo "<a href='show_inventory.php?inventory=Glass&id=".$row[m_id]."' class='btn btn-primary' role='button'>See items</a>";?>
                        
                        <?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
							<a href="#" class="btn btn-default" role="button">Edit Category</a></p>		
						<? }?></div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<div class="caption">
						<h3>Wood</h3>
                        <br>
						<p>
                        <?php
                        $result = $mysqli->query("SELECT m_id FROM materials WHERE m_name = 'Wood'");
                        $row = $result->fetch_assoc();
                        echo "<a href='show_inventory.php?inventory=Wood&id=".$row[m_id]."' class='btn btn-primary' role='button'>See items</a>";?>
                        <?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
							<a href="#" class="btn btn-default" role="button">Edit Category</a></p>		
						<? }?>
                        	</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<div class="caption">
						<h3>Basswood</h3>
                        <br>
						<p>
                        <?php
                        $result = $mysqli->query("SELECT m_id FROM materials WHERE m_name = 'Basswood'");
                        $row = $result->fetch_assoc();
                        echo "<a href='show_inventory.php?inventory=Basswood&id=".$row[m_id]."' class='btn btn-primary' role='button'>See items</a>";?>
                        <?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
							<a href="#" class="btn btn-default" role="button">Edit Category</a></p>		
						<? }?>
                        </div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<div class="caption">
						<h3>Plywood</h3>
                        <br>
						<p>
                        <?php
                        $result = $mysqli->query("SELECT m_id FROM materials WHERE m_name = 'Plywood'");
                        $row = $result->fetch_assoc();
                        echo "<a href='show_inventory.php?inventory=Plywood&id=".$row[m_id]."' class='btn btn-primary' role='button'>See items</a>";?>
                        <?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
							<a href="#" class="btn btn-default" role="button">Edit Category</a></p>		
						<? }?>
                        </div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<div class="caption">
						<h3>Sheet Test</h3>
                        <br>
						<p>
                        <?php
                        $result = $mysqli->query("SELECT m_id FROM materials WHERE m_name = 'Sheet Test'");
                        $row = $result->fetch_assoc();
                        echo "<a href='show_inventory.php?inventory=Sheet Test&id=".$row[m_id]."' class='btn btn-primary' role='button'>See items</a>";?>
                        <?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
							<a href="#" class="btn btn-default" role="button">Edit Category</a></p>		
						<? }?></p>
					</div>
					</div>
				</div>
				
			</div>
			
	

    </body>

	<?php
  //Standard call for dependencies
  include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
  ?>
</html>
