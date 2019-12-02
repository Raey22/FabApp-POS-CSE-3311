<?php
/*
*   CC BY-NC-AS UTA FabLab 2016-2018
*   FabApp V 0.91
*   Author: Boris Konffo 10.16.2019
*   list out all out of stock alert and settings
*/

//This will import all of the CSS and HTML code necessary to build the basic page
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/header.php');

//Submit results
$resultStr = "";
$number_of_sheet_tables = 0;
if (!$staff || $staff->getRoleID() < $sv['minRoleTrainer']){
  //Not Authorized to see this Page
  $_SESSION['error_msg'] = "You are unable to view this page.";
  header('Location: /index.php');
  exit();
}

?>
<html>
<head>
  <title>Out of Stock Alerts</title>
  <link rel="stylesheet" href="vendor/styles.css">
</head>
<body>
  <div id="page-wrapper">
    <!-- Page Title -->
    <div class="col">
      <div class="col-lg-12">
        <h2 class="page-header">Out of Stock(OOS) Inventory Alerts</h2>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">

      <!-- All out of stock table Table -->
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fas fa-exclamation-triangle">All OOS Alerts</i> 
          </div>

          <!-- Search Bar -->
          <div class="col-md-5">
            <input type="text" class="form-control" id="searchBar" onkeyup="searchTable()" placeholder="Enter alert name to search...">
          </div>
          <br>

          <!-- /.panel-heading -->
          <div class="panel-body">
            <div style="height:400px;overflow:auto;">
              <div class="table-responsive">
                <table id="alertTable" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr class="tablerow">
					            <th><i class="fas fa-pencil-alt"></i> Edit</th>
                      <th><i class="fas fa-exclamation-triangle"></i> Alert Name</th>
                      <th><i ></i>Minimum quantity</th>
					            <th><i class="far fa-clock"></i> Time<small>(24h format)<small></th>
                      <!--<th><i class="fas fa-envelope-square"></i> Recipient Email</th> -->
                      <th><i class="fas fa-toggle-on"></i> Enabled alert</th>
					  
					 <!-- <th><i></i>  <button class="btn btn-primary">Triggered Alert</button> </th>  -->

                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    // Note: edit this query to pull different results for this page
                    if ($result = $mysqli->query("
                    SELECT * FROM oos_alert as AO JOIN email as E ON AO.email_id = E.id_email
                    ")) {
                      while ($row = $result->fetch_assoc()) { ?>
                        <!-- Edit column -->
                      <td align="center"> 
                      <div class="pull-right">
                            <span class="pull-left"><a href="edit_alert.php?id=<?php echo($row['a_id']."&an="
                            .$row['a_name']."&m=".$row['min_qty']."&e=".$row['email_address']."&f=".$row['trig_time']."&i=".$row['is_active']);
                             ?>" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a></span>
                      </div>
                        </td>
                        <!-- Name alert -->
                        <td align="center"><?php echo($row['a_name']); ?>
                        </td>

                        <!-- low qty on hand -->
                        <td align="center"><?php echo($row['min_qty']) ;?></td>

                        <!-- Alert frequency -->
                        <td align="center"><?php echo($row['trig_time']); ?></td>

                        <!-- Enabled  -->
                       
						              <td align="center"><?php echo (''.$row['is_active'] ?'Y' : 'N'); ?>
                          <!--  -->
                         
                        </td>

                      </tr>
                      
                    <?php }
                  } ?>
                </tbody>
               
              </table>
              <!-- /.table-responsive -->
              <div>
                      <tr>
                      
                      <input action="action" onclick="parent.location='add_alert.php'" class="btn" type="button" value="Add Inventory Alert" />
                      
                      </tr>
                </div>
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

// Searches our Alert
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
  table = document.getElementById("alertTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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

</script>
</html>
