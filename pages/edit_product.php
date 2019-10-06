<?php

/*
*   CC BY-NC-AS UTA FabLab 2016-2018
*   FabApp V 0.91
*   Author: Khari Thomas
*
*   NOTE: This page needs to be updated to use prepared statements@@
*   possibly add a sub modal between show_inventory.php and this page to check whether a page exists
*    e.g. id?=99
*
*
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

function renderForm($id, $m_name, $price, $qty, $height, $width, $weight, $current, $measurable, $error)
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
          <h1 class="page-header">Edit Material</h1>
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
            <div>
              <p><strong>ID:</strong> <?php echo $id; ?></p>
            </div>
            <div class="form-group col-lg-12">
              <label for="materialName">Material Name:</label>
              <input type="text" class="form-control" id="materialName" placeholder="Enter name" name="name" value="<?php echo $m_name; ?>">
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-lg-4">
              <label for="materialPrice">Price:</label>
              <input type="text" class="form-control" id="materialPrice" placeholder="Enter price" name="price" value="<?php echo $price; ?>" readonly>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-lg-4">
              <label for="materialCost">Material Cost:</label>
              <input type="text" class="form-control" id="materialCost" placeholder="Enter cost" name="cost" value="">
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-lg-12">
              <label for="materialQty">Quantity:</label>
              <input type="text" class="form-control" id="materialQty" placeholder="Enter quantity" name="quantity" value="<?php echo $qty; ?>">
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>

            <div class="form-group col-lg-4">
              <label for="m_height">Height:</label>
              <input type="text" class="form-control" id="m_height" placeholder="Enter height" name="height" value="<?php echo $height; ?>">
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-lg-4">
              <label for="m_width">Width:</label>
              <input type="text" class="form-control" id="m_width" placeholder="Enter width" name="width" value="<?php echo $width ?>">
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-lg-4">
              <label for="m_weight">Weight:</label>
              <input type="text" class="form-control" id="m_weight" placeholder="Enter weight" name="weight" value="<?php echo $weight ?>">
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>


            <!-- <div class="form-group col-lg-4">
              <span><b>Current:</b></span>
              <?php echo
              "<td> <select class='form-control col-md-4' onchange='changeCurrent($mat_id, this)' style='width:100%;'>".
                "<option value='Y'>Y</option>";
              // display whether currently used material
              if($current === 'N') echo "<option selected='selected' value='N'>N</option>";
              else echo "<option value='N'>N</option>";
              echo "</select> </td> </td> </tr>"; ?> -->

              <!-- <input type="text" class="form-control" id="currentInput" placeholder="Enter Quantity" name="current" value="<?php echo $current; ?>"> -->
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            <!-- </div> -->
            <div class="form-group col-lg-4">
              <label for="measurableInput">Measurable:</label>
              <input type="text" class="form-control" id="measurableInput" placeholder="Enter Quantity" name="measurable" value="<?php echo $measurable; ?>">
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label for="reasonInput">Reason for Update</label>
                <textarea class="form-control" id="reasonInput" rows="2" required></textarea>
              </div>
              <input action="action" onclick="window.history.go(-1); return false;" class="btn" type="button" value="Cancel" />
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
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
    $m_name = mysql_real_escape_string(htmlspecialchars($_POST['m_name']));
    $price = mysql_real_escape_string(htmlspecialchars($_POST['price']));
    $qty = mysql_real_escape_string(htmlspecialchars($_POST['quantity']));
    $height = mysql_real_escape_string(htmlspecialchars($_POST['height']));
    $width = mysql_real_escape_string(htmlspecialchars($_POST['width']));
    $weight = mysql_real_escape_string(htmlspecialchars($_POST['weight']));

    // check that required fields are filled in
    if ($qty == '')
    {
      // generate error message
      $error = 'ERROR: Please fill in all required fields!';
      //error, display form
      renderForm($id, $m_name, $price, $qty, $height, $width, $weight, $current, $measurable, $error);
    }
    else
    {
      // save the data to the database;
      $mysqli->query("
      UPDATE all_good_inventory
      SET quantity=$qty, weight=$weight, height=$height, width=$width
      WHERE inv_id=$id
      ")
      or die(mysql_error());
      //check for errors here ^

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
      $price = $row['price'];
      $current = $row['current'];
      $measurable = $row['measurable'];
      $height = $row['height'];
      $width = $row['width'];
      $weight = $row['weight'];

      $mat_id = $row['m_id'];


      // show form
      renderForm($id, $m_name, $price, $qty, $height, $width, $weight, $current, $measurable, '');

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

<div id="page-wrapper">
  <span><b>Current:</b></span>
	<div class="col-md-12">
    <table class="table table-condensed col-md-12">

      <!-- display all materials -->
      <tbody>
        <?php if($result = $mysqli->query("SELECT `m_id`, `m_name`, `current`
                           FROM `materials`
                           WHERE `m_id` = $mat_id
                           ORDER BY `m_name`
        ")) {
          while($row = $result->fetch_assoc()) {
            echo
            "<td> <select class='form-control col-md-4' onchange='changeCurrent($mat_id, this)' style='width:100%;'>".
              "<option value='Y'>Y</option>";
            // display whether currently used material
            if($current === 'N') echo "<option selected='selected' value='N'>N</option>";
            else echo "<option value='N'>N</option>";
            echo "</select> </td> </td> </tr>";
          }
        }
        else {
          echo "Unable to get table";
        } ?>
        </tbody>
    </table>
	</div>
<!-- Display changes of inventory based on item selected; maybe new page? -->
</div>
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
