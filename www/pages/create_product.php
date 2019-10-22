<?php

/*
*   CC BY-NC-AS UTA FabLab 2016-2019
*   FabApp V 0.91
*   Author: Khari Thomas
*
*   NOTE: This page needs to be updated to use prepared statements@@
*   possibly add a sub modal between show_inventory.php and this page to check whether a page exists
*    e.g. id?=99
Change access level to admin only
*/

//This will import all of the CSS and HTML code necessary to build the basic page
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/header.php');

//verify authentication access
if (!$staff || $staff->getRoleID() < $sv['LvlOfStaff']){
  //Not Authorized to see this Page
  $_SESSION['error_msg'] = "You are unable to view this page.";
  header('Location: /index.php');
  exit();
}

// fire off modal & timer
if($_SESSION['type'] == 'success'){
  echo "<script type='text/javascript'> window.onload = function(){success()}</script>";
}
?>

<html>
<head>
  <title>Add New Product</title>
</head>
<body>
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Add New Product</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <form action="" method="post">
          <!-- <input type="hidden" name="id" value="<?php echo $id; ?>"/> -->
          <!-- <input type="hidden" name="mat_id" value="<?php echo $mat_id; ?>"/> -->
          <div class="form-group">
            <p><strong>ID:</strong>1</p>
          </div>

          <!-- Display "name" field for material  -->
          <div class="form-group col-lg-12">
            <label for="nameInput">Material Name:</label>
            <input type="text" class="form-control" id="nameInput" placeholder="Enter name" name="name" value="lorem">
          </div>
      </div>

      <div class="form-row">
        <!-- Display "quantity" field for material -->
        <div class="form-group col-lg-6">
          <label for="quantityInput">Quantity:</label>
          <input type="text" class="form-control" id="quantityInput" placeholder="Enter quantity" name="quantity" value="2">
        </div>

        <!-- Display "weight" field for material  -->
        <div class="form-group col-lg-6">
          <label for="weightInput">Weight:</label>
          <input type="text" class="form-control" id="weightInput" placeholder="Enter weight" name="weight" value="3">
        </div>
      </div>

      <div class="form-row">
        <!-- Display "height" field for material -->
        <div class="form-group col-lg-6">
          <label for="heightInput">Height:</label>
          <input type="text" class="form-control" id="heightInput" placeholder="Enter height" name="height" value="9">
        </div>

        <!-- Display "width" field for material -->
        <div class="form-group col-lg-6">
          <label for="widthInput">Width:</label>
          <input type="text" class="form-control" id="widthInput" placeholder="Enter width" name="width" value="9">
        </div>
      </div>

      <div class="form-row">
        <!-- Display "measurable" field for material  -->
        <!-- <div class="form-group col-lg-4">
        <label for="measurableInput">Measurable:</label>
        <select class="form-control" id="measurableInput">
        <option value="Y"<?php $measurable == 'Y' ? 'selected="selected"' : ''; ?>>Y</option>
        <option value="N"<?php $measurable == 'N' ? 'selected="selected"' : ''; ?>>N</option>
      </select>
    </div> -->

    <!-- Display "current" field for material -->
    <!-- <div class="form-group col-lg-4">
    <label for="currentInput">Current:</label>
    <select class="form-control" id="currentInput">
    <option value="Y"<?php $current == 'Y' ? 'selected="selected"' : ''; ?>>Y</option>
    <option value="N"<?php $current == 'N' ? 'selected="selected"' : ''; ?>>N</option>
  </select>
</div> -->
</div>

<!-- Display form buttons: submit and cancel -->
<input action="action" onclick="window.history.go(-1); return false;" class="btn" type="button" value="Cancel" />
<button type="submit" name="submit" class="btn btn-primary">Submit</button>

</form>
</div>
</div>
</div>
</body>
<?php
//Standard call for dependencies
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
?>

</html>

<?php
// fire off modal & timer
if($_SESSION['type'] == 'success'){
  echo "<script type='text/javascript'> window.onload = function(){success()}</script>";
}
?>

<div id="modal" class="modal">
</div>

<?php
//Standard call for dependencies
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
?>

<script>

// AJAX call to change_current.php to change status; fills modal w/ success msg
function changeCurrent(id, element) {
  var val = element.value;
  console.log(id, val);
  // AJAX call
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("modal").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "sub/change_current.php?id=" +id+ "|" + val, true);
  xmlhttp.send();
  $("#modal").show();
}

// close modal buttons were not working
function dismiss_modal() {
  $("#modal").hide();
}

</script>
