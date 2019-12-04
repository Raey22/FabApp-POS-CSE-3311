<?php
/*
 *   CC BY-NC-AS UTA FabLab 2016-2018
 *   FabApp V 0.91
 *
 *	 edited by: MPZinke on 12.08.18
 *   edited by: Khari Thomas on 10.3.2019
 *	 edited by: Raey Ageze on 10.4.2019

 */

$LvlOfInventory = 9;  //TODO: find out actual level; change for all

include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/header.php');


if($_SERVER["REQUEST_METHOD"] == "POST" && $staff->getRoleID() >= $sv['LvlOfLead'] && isset($_POST['save_material'])) {
	$m_id = filter_input(INPUT_POST, 'm_id');
	$new_amount = filter_input(INPUT_POST, 'quantity');
	$mat = new Materials($m_id);
	$original_amount = Mats_Used::units_in_system($m_id);
	$difference = $new_amount - $original_amount;
	$reason = "Updated to match current inventory";

	if(Mats_Used::update_mat_quantity($m_id, $difference, $reason, $staff, 16)) {
		$_SESSION['success_msg'] = $mat->getM_name()." updated from ".$original_amount." ".$mat->getUnit()." to ".
								   $new_amount." ".$mat->getUnit();
	} else {
		$_SESSION['error_msg'] = "Unable to update ".$mat->getM_name();
	}
	header("Location:inventory.php");
}


?>
<title><?php echo $sv['site_name'];?> Inventory</title>
<div id="page-wrapper">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-header"> <?php if(isset($_GET['inventory']))
			echo $_GET['inventory']; ?> Inventory</h1>
		</div>
		<!-- /.col-md-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a class="btn " href = "inventory.php"> <i class="fas fa-warehouse fa-fw"></i> Inventory </a>
					<a class="btn "  href = <?php echo "'add_inventory.php?id=".$_GET['id']."'";?> style = "float: right;"> <i class="fas fa-plus"></i></i> Add Inventory  </a>
				</div>
				<div class="panel-body">
					<table class="table table-condensed" id="invTable">
						<thead>
							<tr>
								<!-- Prevents edit access from unauthorized users -->
								<?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
									<th class='col-md-1'>Edit</th>
								<? }?>
								<th class='col-md-1'>ID</th>
								<th class='col-md-4'>Material Name</th>
								
                <th class='col-md-2'>Product Number</th>
				<th class='col-md-1'>Height</th>
				<th class='col-md-1'>Width</th>
				<th class='col-md-1'>Weight</th>
                <th class='col-md-1'>Price</th>
                <th class='col-md-1'>Quantity</th>
							</tr>
						</thead>
						<tbody>
						<?php //Display Inventory Based on device group

						// if($result = $mysqli->query("
						// 	SELECT `materials`.`m_id` as `m_id`, `m_name`, SUM(quantity) AS `sum`, `materials`.`product_number`, `color_hex`, `unit`
						// 	FROM `materials`
						// 	LEFT JOIN `mats_used`
						// 	ON mats_used.m_id = `materials`.`m_id`
						// 	WHERE `materials`.`measurable` = 'Y'
						// 	AND `materials`.`current` = 'Y'
						// 	GROUP BY `m_name`, `color_hex`, `unit`
						// 	ORDER BY `m_name` ASC;
						// "))
            // WHERE M.measurable = 'Y'
            // AND M.current = 'Y'

			//Change this query to be dynamic
			//TODO: input sanitation
			
			$query = "SELECT *  FROM all_good_inventory as I INNER JOIN materials AS M ON I.m_id = M.m_id WHERE M.c_id = {$_GET['id']}";
			if($result = $mysqli->query($query
            ))
            {
							while ($row = $result->fetch_assoc()){ ?>
								<tr>
									<!-- Prevents edit access from unauthorized users -->
									<?php if(!(is_null($staff)) && ($staff->getRoleID() >= $sv['LvlOfLead'])) { ?>
										<td><a href="edit_product.php?id=<?php echo ("".$row['inv_id']); ?>"  class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a></td>
									<? }?>
									<td><?php echo $row['inv_id']; ?></td>
									<td><?php echo $row['m_name']; ?></td>
									<td><?php echo $row['product_number']; ?></td>
                  					<td><?php echo $row['price']; ?></td>
									<td><?php echo $row['height']; ?></td>
									<td><?php echo $row['width']; ?></td>
									<td><?php echo $row['weight']; ?></td>
									<td><?php echo $row['quantity']; ?></td>
								</tr>
							<?php }
						} else { ?>
							<tr><td colspan="3">None</td></tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-md-8 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php
//Standard call for dependencies
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
?>

<script>
	$('#invTable').DataTable({
		"iDisplayLength": 25,
		"order": []
	});

</script>
