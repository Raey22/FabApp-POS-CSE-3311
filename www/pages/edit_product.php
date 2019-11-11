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

function renderForm($id, $mat_id, $m_name, $qty, $height, $width, $weight, $error)
{
  ?>
  <html>
  <head>
    <title>Edit Product</title>
  </head>
  <body>
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Edit Product</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <?php
          if($error != '') {
            echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
          }
          ?>

          <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="hidden" name="mat_id" value="<?php echo $mat_id; ?>"/>
            <div class="form-group">
              <p><strong>ID:</strong> <?php echo $id; ?></p>
            </div>

            <!-- Display "name" field for material  -->
            <div class="form-group col-lg-12">
              <label for="nameInput">Material Name:</label>
              <input type="text" class="form-control" id="nameInput" placeholder="Enter name" name="name" value="<?php echo $m_name; ?>">
            </div>

            <div class="form-row">
              <!-- Display "price" field for material -->
              <!-- <div class="form-group col-lg-4">
                <label for="priceInput">Price:</label>
                <input type="text" class="form-control" id="priceInput" placeholder="Enter price" name="price" value="<?php echo $price; ?>">
              </div> -->

              <!-- Display "cost" field for material -->
              <!-- <div class="form-group col-lg-4">
                <label for="costInput">Material Cost:</label>
                <input type="text" class="form-control" id="costInput" placeholder="Enter cost" name="cost" value="">
              </div> -->
            </div>

            <div class="form-row">
              <!-- Display "quantity" field for material -->
              <div class="form-group col-lg-6">
                <label for="quantityInput">Quantity:</label>
                <input type="text" class="form-control" id="quantityInput" placeholder="Enter quantity" name="quantity" value="<?php echo $qty; ?>">
              </div>

              <!-- Display "weight" field for material  -->
              <div class="form-group col-lg-6">
                <label for="weightInput">Weight:</label>
                <input type="text" class="form-control" id="weightInput" placeholder="Enter weight" name="weight" value="<?php echo $weight ?>">
              </div>
            </div>

            <div class="form-row">
              <!-- Display "height" field for material -->
              <div class="form-group col-lg-6">
                <label for="heightInput">Height:</label>
                <input type="text" class="form-control" id="heightInput" placeholder="Enter height" name="height" value="<?php echo $height; ?>">
              </div>

              <!-- Display "width" field for material -->
              <div class="form-group col-lg-6">
                <label for="widthInput">Width:</label>
                <input type="text" class="form-control" id="widthInput" placeholder="Enter width" name="width" value="<?php echo $width ?>">
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

}

if (isset($_POST['submit']))
{
  // confirm that the 'id' value is a valid integer before getting the form data
  if (is_numeric($_POST['id']))
  {
    // get form data, making sure it is valid
    $id = $_POST['id'];
    $mat_id = mysql_real_escape_string(htmlspecialchars($_POST['mat_id']));

    $m_name = mysql_real_escape_string(htmlspecialchars($_POST['m_name']));
    // $price = mysql_real_escape_string(htmlspecialchars($_POST['price']));
    $qty = mysql_real_escape_string(htmlspecialchars($_POST['quantity']));
    $height = mysql_real_escape_string(htmlspecialchars($_POST['height']));
    $width = mysql_real_escape_string(htmlspecialchars($_POST['width']));
    $weight = mysql_real_escape_string(htmlspecialchars($_POST['weight']));

    // check that required fields are filled in
    if ($qty == '' || $width == '' || $height == '' || $weight == '')
    {
      // generate error message
      $error = 'ERROR: Please fill in all required fields!';
      //error, display form
      renderForm($id, $mat_id, $m_name, $qty, $height, $width, $weight, $error);
    }
    else
    {
      // save the data to the database;
      $mysqli->query("
      UPDATE all_good_inventory AS AI
      SET AI.quantity=$qty, AI.weight=$weight, AI.height=$height, AI.width=$width
      WHERE AI.inv_id=$id
      ")
      or die(mysql_error());
      //check for errors here ^

      // status_id is set to 6 since materials can only be updated on this page
      if(!is_int(Mats_Used::insert_material_used(null, $mat_id, 6, $staff, -1 * floatval($qty)))){
        // mats_used table couldn't be updated
        echo 'Error! Material could not be updated!';
      }

      // once saved, redirect back to the view page
      header("Location: show_inventory.php");
    }
  }
  else
  {
    // if the 'id' isn't valid, display an error
    echo 'Error!';
  }
}
else
// if the form hasn't been submitted, get the data from the db and display the form
{

  // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
  if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
  {
    // query db
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM all_good_inventory AI JOIN materials M ON AI.m_id = M.m_id WHERE inv_id=$id") or die(mysql_error());
    $row = $result->fetch_assoc();

    // check that the 'id' matches up with a row in the databse
    if($row)
    {
      // get data from db
      $qty = $row['quantity'];
      $m_name = $row['m_name'];
      // $price = $row['price'];
      // $current = $row['current'];
      // $measurable = $row['measurable'];
      $height = $row['height'];
      $width = $row['width'];
      $weight = $row['weight'];
      $mat_id = $row['m_id'];

      // show form
      renderForm($id, $mat_id, $m_name, $qty, $height, $width, $weight, '');

    }
    else
    // if no match, display result
    {
      echo "No results!";
    }

  }
  else
  // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
  {
    echo 'Error!';
  }
}
?>

<?php

// fire off modal & timer
if($_SESSION['type'] == 'success'){
	echo "<script type='text/javascript'> window.onload = function(){success()}</script>";
}

?>

<div id="modal" class="modal">
</div>


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
