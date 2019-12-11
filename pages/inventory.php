<?php

/*
*   CC BY-NC-AS UTA FabLab 2016-2018
*   FabApp V 0.91
*   Author: Khari Thomas & Raey Ageze
*
*/

 //This will import all of the CSS and HTML code necessary to build the basic page
 include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/header.php');

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

			<?php
			
				//Select all parent categories
				$query = "SELECT * FROM `categories` WHERE c_parent IS NULL";
				if($result = $mysqli->query($query))
				{?>
				<div class="row" style="padding-top: 3px;">
					<?php
					
					//fetch every category from the category table and display it as a thumbnail
					while ($row = $result->fetch_assoc()){ ?>
					<?php
						//check if any of the parnet catgories have subcategories 
								$q = "SELECT * FROM `categories` WHERE c_parent = ". $row['c_id'];
								$res = $mysqli->query($q);
								//if there are subcategories see items should redirect to the sub_category page
								?>
				
						<div class="col-sm-6 col-md-4" >
		
						
						<div class="thumbnail" style="background-color:#afbfd6;"" onMouseOver="this.style.background='#dbdcdd'" onmouseout="this.style.background='#afbfd6'" onclick="window.location.href=<?php 
								if($res->num_rows > 0)
								{
									echo "'sub_category.php?category=$row[c_name]&id=".$row[c_id]."'";
								
								}
								//if there are no subcategories every inventory should be listed
								else
								{
									echo "'show_inventory.php?inventory=$row[c_name]&id=".$row[c_id]."'";
					
								
								}
								?>">
							
							 
							<div class="caption" style="color:white;">
								<h3><?php echo $row['c_name'];?></h3>
								
								<?php
								
								if($res->num_rows > 0)
								{
									echo "<a href='sub_category.php?category=$row[c_name]&id=".$row[c_id]."' class='btn btn-primary' role='button' style='margin:2px;'>See items</a>";
								
								}
								//if there are no subcategories every inventory should be listed
								else
								{
									echo "<a href='show_inventory.php?inventory=$row[c_name]&id=".$row[c_id]."' class='btn btn-primary' role='button' style='margin:2px;'> See items </a>";?>
								
								<?php
								}
					
											 if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { 
											echo "<a href='edit_category.php?id=".$row[c_id]."' class='btn btn-default' role='button' style='margin:2px;'> Edit Category</a>";?></p>
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

				<?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
					<a href="add_category.php" class="btn btn-default" role="button"><i class="fas fa-plus"></i>  Add Category</a>
				<? }?>
					
				
			</div>

			</div>


	</body>
	<?php
  //Standard call for dependencies
  include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
  ?>
</html>
