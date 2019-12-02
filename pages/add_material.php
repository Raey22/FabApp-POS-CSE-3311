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
//function for the from to edit the category passed are the category name and the parent category names
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
          <h1 class="page-header">Add Material</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <?php
          if($error != '') {
            echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
          }
              $result = $mysqli->query("SELECT MAX(m_id) FROM materials");
              $id = $result->fetch_assoc();
              $id = $id['MAX(m_id)']+ 1;
          ?>
        
          <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <div>
              <p><strong>ID:</strong> <?php echo $id; ?></p>
            </div>
            <div class="form-group col-lg-12">
              <label for="materialName">Material Name:</label>
              <input type="text" class="form-control" id="materialName" placeholder="Enter name" name="m_name" required >
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-lg-4">
              <label for="materialPrice">Price:</label>
              <input type="text" class="form-control" id="materialPrice" placeholder="Enter price" name="price" >
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-lg-4">
              <label for="colorHex">Color Hex:</label>
              <input type="text" class="form-control" id="colorHex" placeholder="Enter color ib hex" name="colorHex" >
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-lg-12">
              <label for="materialProdNo">Product Number:</label>
              <input type="text" class="form-control" id="materialProdNo" placeholder="Enter product number" name="productNum" >
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-lg-12">
              <label for="materialUnit">Unit:</label>
              <select class="form-control" name="unit" id="unit">
                <option value="gram(s)">gram(s)</option> 
                <option value="sq_inch(es)">sq_inch(es)</option>
                <option value="inch(es)">inch(es)</option>
              </select>
          
            </div>
            

             <div class="form-group col-lg-4">
              <label for="currentInput">Current:</label>
              <select class="form-control" name="current" id="current">
                <option value="Y">Yes</option> 
                <option value="N">No</option>
              </select>
            </div>
            <div class="form-group col-lg-4">
              <label for="measurableInput">Measurable:</label>
              <select class="form-control" name="measurable" id="measurable">
                <option value="Y">Yes</option> 
                <option value="N">No</option>
              </select>
            </div>
           
            <div class="col-lg-12">
            <label for="parentName" required >Parent Category:</label>
            <select class="form-control" name="pcat_id" id="pcat_id">
           
            <?php
            //list all the available categories other than one
            $q = "SELECT * FROM categories";
            // $q2 = "SELECT c_name FROM categories WHERE c_id = {$_GET['id']}";
            
            if($res = $mysqli->query($q)) //&& $r = $mysqli->query($q2))
            {
                echo "<option selected> Select Category</option>";
              //select the parent category as the category the add item button was clicked from 
              while($row = $res->fetch_assoc()){

                  echo "<option value=".$row['c_id'].">".$row['c_name']."</option>";
              }
             
            }
          else{  
                  ?>
                   
                    <option value=NULL>None</option>
                    <?}?>
            
			   </select>
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
    // once saved, redirect back to the view page
    header("Location: inventory.php?");
    // get form data, making sure it is valid
    $m_name = mysql_real_escape_string(htmlspecialchars($_POST['m_name']));
    $price = mysql_real_escape_string(htmlspecialchars($_POST['price']));
    $productNum = mysql_real_escape_string(htmlspecialchars($_POST['productNum']));
    $unit = mysql_real_escape_string(htmlspecialchars($_POST['unit']));
    $current = mysql_real_escape_string(htmlspecialchars($_POST['current']));
    $colorHex = mysql_real_escape_string(htmlspecialchars($_POST['colorHex'])); 
    $measurable = mysql_real_escape_string(htmlspecialchars($_POST['measurable']));
    $parentCat =  mysql_real_escape_string(htmlspecialchars($_POST['pcat_id']));
    $reasonInput =  mysql_real_escape_string(htmlspecialchars($_POST['reasonInput']));
   
    
      $query = "INSERT INTO materials (m_name, m_parent,price,product_number,unit,color_hex,measurable,current,c_id,update_reason)
       VALUES ('$m_name',NULL,$price,'$productNum','$unit','$colorHex','$measurable','$current',$parentCat,$reasonInput)";
      $mysqli->query($query) or die(mysql_error());
      
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
