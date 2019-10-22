<?php
/*
*   CC BY-NC-AS UTA FabLab 2016-2018
*   FabApp V 0.91
*   Author: Raey Ageze
*
*
*/
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
			<h2> <a href = "inventory.php"><i class="fas fa-angle-left"></i></a><?echo $_GET['category'];?> </h2>
			<div class="col-lg-12">
				<p>Add, Edit, or Update materials here</p>
			</div>
			<?php
				$query = "SELECT * FROM `categories` WHERE c_parent =". $_GET['id'];
				if($result = $mysqli->query($query))
				{?>
				<div class="row" style="padding-top: 3px;">
					<?php
					
					//fetch every category from the category page and display it as a thumbnail
					while ($row = $result->fetch_assoc()){ ?>
									
									
				
						<div class="col-sm-6 col-md-4" >
						
							<div class="thumbnail" style="background-color:#afbfd6;" onMouseOver="this.style.background='#dbdcdd'" onmouseout="this.style.background='#afbfd6'">
							<div class="caption" style="color:white;">
								<h3><?php echo $row['c_name'];?></h3>
								
								<?php
								$q = "SELECT * FROM `categories` WHERE c_parent = ". $row['c_id'];
								$res = $mysqli->query($q);
								if($res->num_rows > 0)
								{
									
									echo "<a href='sub_category.php?category=$row[c_name]&id=".$row[c_id]."' class='btn btn-primary' role='button'>See items</a>";
								
								
								}
					
								else
								{
						
									echo "<a href='show_inventory.php?inventory=$row[c_name]&id=".$row[c_id]."' class='btn btn-primary' role='button'>See items</a>";?>
								
								<?php
								}
					
											 if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
											<?php echo "<a href='edit_category.php?id=".$row[c_id]."' class='btn btn-default' role='button'>Edit Category</a>";?></p>
											<? }
											else
											?>
												</p>

												
											</div>
										</div>
											
									</div>
								<?php }
							}	
							else { ?>
								</div>
								None
								
							<?php } 
							?>
			
				
			</div>
			<div >
			
		
					
				
			</div>
				
			</div>
			
			


    </body>

	<?php
  //Standard call for dependencies
  include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
  ?>
</html>
