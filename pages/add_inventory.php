<?php

/*
*   CC BY-NC-AS UTA FabLab 2016-2018
*   FabApp V 0.91
*   Author: Raey Ageze
*

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
//function for the from to edit the inventory passed 
function renderForm( $mysqli, $error)
{
  ?>
  <html>
  <head>
    <title>Add Inventory</title>
  </head>
  <body>
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Add Inventory</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <?php
          if($error != '') {
            echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
          }
              $result = $mysqli->query("SELECT MAX(inv_id) FROM all_good_inventory");
              $id = $result->fetch_assoc();
              $id = $id['MAX(inv_id)']+ 1;
          ?>
        
          <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <div>
              <p><strong>ID:</strong> <?php echo $id; ?></p>
            </div>
            <div class="form-group col-lg-12">
              <label for="materialName">Material Name:</label>
              <!-- Select a material within the category the button was clicked -->
              <select class="form-control dm_select" id="m_id" placeholder="Enter name" name="m_id" required>
										<option selected='selected' value="NONE">Select Material</option>
									 <?php
												$result = $mysqli->query("			
												SELECT *
												FROM materials 
												WHERE c_id = {$_GET['id']}
												ORDER BY m_name;");
												while($row = $result->fetch_assoc()){
													echo "<option value=".$row[m_id].">$row[m_name] </option>";
												}
										?>
										
									</select>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            
            <div class="form-group col-lg-4">
              <label for="width">Width:</label>
              <div class="input-group" >
              <input type="number" class="form-control"name="width" id="width" max="500" min="1" value="0" step="0.1" placeholder="Enter Width" />
													<span class="input-group-addon unit">inch(es)</span>
								</div>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-lg-4">
              <label for="height">Height:</label>
              <div class="input-group" >
              <input type="number" class="form-control"name="height" id="height" max="500" min="1" value="0" step="0.1" placeholder="Enter Height" />
													<span class="input-group-addon unit">inch(es)</span>
								</div>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-lg-4">
              <label for="weight">Weight:</label>
              <div class="input-group" >
              <input type="number" class="form-control"name="weight" id="weight" max="500" min="1" value="0" step="0.1" placeholder="Enter Weight" />
													<span class="input-group-addon unit">gram(s)</span>
								</div>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            
            <div class="form-group col-lg-12">
              <label for="quantity">Quantity:</label>
              <div class="input-group" >
              <input type="number" class="form-control"name="quantity" id="quantity" max="250" min="1" value="1" step="1" placeholder="Enter Quantity" />
								</div>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            

            <div class="col-lg-12">
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


if(isset($_POST['submit']))
{
  if (is_numeric($_POST['id']))
  {
   
      header("Location: inventory.php");
      $m_id = mysql_real_escape_string(htmlspecialchars($_POST['m_id']));
      $width = mysql_real_escape_string(htmlspecialchars($_POST['width']));
      $height = mysql_real_escape_string(htmlspecialchars($_POST['height']));
      $weight = mysql_real_escape_string(htmlspecialchars($_POST['weight']));
      $quantity = mysql_real_escape_string(htmlspecialchars($_POST['quantity']));

      $result = $mysqli->query("SELECT MAX(inv_id) FROM all_good_inventory");
              $id = $result->fetch_assoc();
              $id = $id['MAX(inv_id)']+ 1;
      
      $query = "INSERT INTO `all_good_inventory`
      (`inv_id`,`m_id`, `m_parent`, `width`, `height`, `weight`, `quantity`) VALUES ($id,$m_id,NULL,$width,$height,$weight,$quantity)";
      $mysqli->query($query) or die(mysql_error());


      
      //$resultStr = Materials::create_new_inventory($m_id, $width, $height, $weight, $quantity);
      // once saved, redirect back to the view page
      
      
    
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


// show form
renderForm($mysqli, '');

   
}
?>
