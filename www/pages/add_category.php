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
    <title>Add Category</title>
  </head>
  <body>
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Add Category</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <?php
          if($error != '') {
            echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
          }
              $result = $mysqli->query("SELECT MAX(c_id) FROM categories");
              $id = $result->fetch_assoc();
              $id = $id['MAX(c_id)']+ 1;
          ?>
        
          <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <div>
              <p><strong>ID:</strong> <?php echo $id; ?></p>
            </div>
  
            <div class="form-group col-lg-12">
              <label for="categoryName">Category Name:</label>
              <input type="text" class="form-control" id="c_Name" placeholder="Enter name" name="c_name" required>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
           
            <div class="col-lg-12">
            <label for="parentName">Parent Category:</label>
            <select class="form-control" name="pcat_id" id="pcat_id">
           
            
            <?php
            //list all the available categories 
             $q = "SELECT * FROM categories WHERE 1";
              if($res = $mysqli->query($q))
              {
                //If a category is None then that mean it is a parent category
                echo "<option selected value=NULL>None</option>";
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
  if ($_POST['c_name'] !== '' )
  {
    // Redirect back to the view page
    header('Location: /pages/inventory.php');
    
    // get form data, making sure it is valid
    $c_name = mysql_real_escape_string(htmlspecialchars($_POST['c_name']));
    $pcat_id = $_POST['pcat_id'];
    
      // save the data to the database;
      $query = "INSERT INTO categories (c_name, c_parent) VALUES ('$c_name',$pcat_id)";
      $mysqli->query($query) or die(mysql_error());
      //check for errors here ^ 
     
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
