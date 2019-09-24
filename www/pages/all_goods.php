<?php
/*
*   CC BY-NC-AS UTA FabLab 2016-2018
*   FabApp V 0.91
*   Author: Khari Thomas
*/

/* note: come back and erase unneeded code */

//This will import all of the CSS and HTML code necessary to build the basic page
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/header.php');

if (!empty($_SESSION['sheet_ticket'])){
  unset($_SESSION['sheet_ticket']);
}

// session_start();
// //initialize cart if not set or is unset
// if(!isset($_SESSION['cart_array'])){
//     $_SESSION['cart_array'] = array();
//     $_SESSION['co_quantity'] = array();
//     $_SESSION['co_price'] = 0.0;
// }

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
  <title>FabApp - All Goods</title>
</head>
<body>
  <div id="page-wrapper">
    <!-- Page Title -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">FabApp All Goods</h1>
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
                <table class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr class="tablerow">
                      <th><i class="fas fa-square"></i> Sheet Material</th>
                      <th><i class="fas fa-ruler-combined"></i> Size (Inches)</th>
                      <th><i class="fas fa-money-bill-wave-alt"></i> Cost</th>
                      <th><i class="fas fa-boxes"></i> Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    // edit query to pull different results for this page

                    if ($result = $mysqli->query("
                    SELECT *
                    FROM materials M
                    WHERE M.price != 0;
                    ")) {
                      while ($row = $result->fetch_assoc()) { ?>
                        <tr class="tablerow">

                          <!-- Name -->
                          <td align="center"><?php echo($row['m_name']); ?><div class="color-box" style="background-color: #<?php echo($row['color_hex']);?>;"/></td>

                            <!-- Size -->
                            <td align="center"><?php echo($row['width']." x ".$row['height']) ?></td>

                            <!-- Cost -->
                            <td align="center"><?php echo("$".number_format((float)(($row['width']*$row['height']) * $row['price']), 2, '.', '')) ?></td>

                            <!-- Quanity -->
                            <td align="center" ondblclick='edit_materials(<?php echo($row['inv_id'].",".$row['m_id'].",".$row['width'].",".$row['height']);?>)'><?php echo($row['quantity']); ?><div class="pull-right">
                              <!--
                              <button class="btn btn-s btn-success" onclick="goToPay(<?php //echo($row['inv_ID'].",".$row['m_id'].",".$row['width'].",".$row['height']);?>)" data-toggle="tooltip" data-placement="top" title="Sell this Sheet Good">Sell</button>
                            -->
                            <span class="pull-right"><a href="sub/add_cart.php?id=<?php echo ("".$row['inv_id']."&h=".$row['height']."&w=".$row['width']."&p=".$row['price']); ?>" class="btn btn-success btn-sm"><i class="fas fa-cart-plus"></i></a></span></div></td>

                          </tr>
                        <?php }
                      } ?>
                    </tbody>
                  </table>
                  <!-- /.table-responsive -->
                </div>
              </div>
            </div>
            <!-- /.col-md-8 -->

            <!-- Shopping Cart -->

            <!-- /.col-md-4 -->
          </div>
        </div>
      </div>
      <div id='material_modal' class='modal'>
      </div>
      <div id='sell_modal' class='modal'>
      </div>
    </body>
    <?php
    //Standard call for dependencies
    include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
    ?>
    <script>
    var str;
    for(var i=1; i<= <?php echo $number_of_sheet_tables;?>; i++){
      str = "#sheetsTable_"+i
      $(str).DataTable({
        "iDisplayLength": 10,
        "order": []
      });
    }

    function Submitter(){

      if (confirm("You are about to submit this query. Click OK to continue or CANCEL to quit.")){
        return true;
      }
      return false;
    }

    // function edit_materials(inv_id, m_id, width, height){
    //   if (Number.isInteger(m_id) && Number.isInteger(inv_id)){
    //     if (window.XMLHttpRequest) {
    //       // code for IE7+, Firefox, Chrome, Opera, Safari
    //       xmlhttp = new XMLHttpRequest();
    //     } else {
    //       // code for IE6, IE5
    //       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    //     }
    //     xmlhttp.onreadystatechange = function() {
    //       if (this.readyState == 4 && this.status == 200) {
    //         document.getElementById("material_modal").innerHTML = this.responseText;
    //       }
    //     };
    //     xmlhttp.open("GET", "sub/edit_sheet.php?inv_id=" + inv_id + "&m_id=" + m_id + "&width=" + width + "&height=" + height, true);
    //     xmlhttp.send();
    //   }
    //
    //   $('#material_modal').modal('show');
    // }

    </script>
    </html>
