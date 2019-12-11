<?php
/*
*   CC BY-NC-AS UTA FabLab 2016-2018
*   FabApp V 0.91
*   Author: Khari Thomas
*   Edited by: Glenda Robertson
*
*   Price calculations updated based on units by Glenda Robertson 11-5-19
*/

//This will import all of the CSS and HTML code necessary to build the basic page
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/header.php');

//Submit results
$resultStr = "";
$number_of_sheet_tables = 0;
if (!$staff || $staff->getRoleID() < $sv['LvlOfStaff']){
  //Not Authorized to see this Page
  $_SESSION['error_msg'] = "You are unable to view this page.";
  header('Location: /index.php');
  exit();
}

?>
<html>
<head>
  <title>Register</title>
</head>
<body>
  <div id="page-wrapper">
    <!-- Page Title -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Register</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">

      <!-- All Goods Inventory Table -->
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
          <i class="fas fa-warehouse"></i> All Goods Inventory
          </div>

          <!-- /.panel-heading -->
          <div class="panel-body">
            <div style="height:450px;overflow:auto;">
              <div class="table-responsive">
                <table id="goodsTable"  class="table table-striped table-bordered table-sm table-hover" cellspacing="0"  >
                  <thead>
                    <tr >
                      <th class = "th-sm" style="text-align:center;"><i class="fas fa-square" ></i> Material</th>
                      <th class = "th-sm" style="text-align:center;"><i class="fas fa-ruler-combined"></i> Size (Inches)</th>
                      <th class = "th-sm" style="text-align:center;"><i class="fas fa-weight"></i> Weight (grams)</th>
                      <th class = "th-sm" style="text-align:center;"><i class="fas fa-money-bill-wave-alt"></i> Cost</th>
                      <th class = "th-sm" style="text-align:center;"><i class="fas fa-boxes"></i> Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    // Note: edit this query to pull different results for this page
                    if ($result = $mysqli->query("
                    SELECT *
                    FROM all_good_inventory AI JOIN materials M ON AI.m_id = M.m_id
                    WHERE AI.quantity !=0  AND M.current='Y'
                    ")) {
                      while ($row = $result->fetch_assoc()) { ?>
                        <!-- Name -->
                        <td align="center"><?php echo($row['m_name']); ?><div class="color-box" style="background-color: #<?php echo($row['color_hex']);?>;"/>
                        </td>

                        <!-- Cost -->
                        <?php if($row['unit'] == "gram(s)") { ?>
                        <!-- Size -->
                        <td align="center"><?php echo(" - ") ?></td>

                        <!-- Weight -->
                        <td align="center"><?php echo($row['weight']) ?></td>
                          <td align="center"><?php echo("$".number_format((float)(($row['weight']) * $row['price']), 2, '.', '')) ?></td>
                        <?php }

                         else if($row['unit'] == "sq_inch(es)") { ?>
                          <!-- Size -->
                          <td align="center"><?php echo($row['width']." x ".$row['height']) ?></td>

                              <!-- Weight -->
                              <td align="center"><?php echo(" - ")  ?></td>
                          <td align="center"><?php echo("$".number_format((float)(($row['width']*$row['height']) * $row['price']), 2, '.', '')) ?></td>
                        <?php } else { ?>
                        <!-- Size -->
                        <td align="center"><?php echo($row['width']." x ".$row['height']) ?></td>
                        <!-- Weight -->
                        <td align="center"><?php echo($row['weight']) ?></td>

                          <td align="center"><?php echo("$".number_format((float)($row['price']), 2, '.', '')) ?></td>
                        <?php } ?>

                        <!-- Quanity -->
                        <td align="center"><?php echo($row['quantity']); ?>
                          <!-- Add to Cart -->
                          <div class="pull-right">
                            <span class="pull-right"><a href="sub/add_cart.php?id=<?php echo ("".$row['inv_id']."&h=".$row['height']."&w=".$row['width']."&p=".$row['price']."&m=".$row['weight']."&u=".$row['unit']); ?>" class="btn btn-success btn-sm"><i class="fas fa-cart-plus"></i></a></span>
                          </div>
                        </td>

                      </tr>
                    <?php }
                  } ?>
                </tbody>
              </table>
              <!-- /.table-responsive -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id='material_modal' class='modal'>
  </div>
  <div id='sell_modal' class='modal'>
  </div>
</form>
<div id="orderDetails"></div>
<div id="orderItems"></div>
</div>
</div>

</body>

<?php
//Standard call for dependencies
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
?>
<script>

var str;
for(var i=1; i<= <?php echo $number_of_sheet_tables;?>; i++){
  str = "#goodsTable"+i
  $(str).DataTable({
    "iDisplayLength": 10,
    "product": []
  });
}

$('#productModal').modal({
  keyboard: true,
  backdrop: "static",
  show: false,

}).on('show.bs.modal', function() {
  var getIdFromRow = $(this).data('orderid');
  //make your ajax call populate items or what ever you need
  $(this).find('#orderDetails').html($(
    '<b> Product Id selected: ' + getIdFromRow + '</b>'

  ))
});

$(".table-striped").find('tr[data-target]').on('click', function() {
  //or do your operations here instead of on show of modal to populate values to modal.
  $('#productModal').data('orderid', $(this).data('id'));
});


// Searches our 'All Goods' inventory table
function searchTable() {
  /*
  note:
  Remove toUpperCase() if you want to perform a case-sensitive search
  Change tr[i].getElementsByTagName('td')[0] to [n] to search a different column in table
  */

  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchBar");
  filter = input.value.toUpperCase();
  table = document.getElementById("goodsTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
$('#goodsTable').DataTable({
		"iDisplayLength": 25,
		"order": []
	});
</script>
</html>
