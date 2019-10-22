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
function renderForm($id, $c_name, $c_parent, $mysqli, $error)
{
  ?>
  <html>
  <head>
    <title>Edit Category</title>
  </head>
  <body>
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Edit Category</h1>
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
              <label for="categoryName">Category Name:</label>
              <input type="text" class="form-control" id="c_name" placeholder="Enter name" name="c_name" value="<?php echo $c_name; ?>">
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
           
            <div class="col-lg-12">
            <label for="parentName">Parent Category:</label>
            <select class="form-control" name="pcat_id" id="pcat_id">
            <?php
            //check if the parent name is set
            if(isset($c_parent))
            {

              echo "<option disabled selected value='".$c_parent."'> $c_parent </option>";
              
            }
            else
            {
              echo "<option disabled selected value=NULL>None</option>";
            }
            ?>
            
            
            <?php
            //list all the available categories 
             $q = "SELECT * FROM categories WHERE c_name <> '$c_parent' AND c_name <> '$c_name'";
              if($res = $mysqli->query($q))
              {
                while($row = $res->fetch_assoc()){
                  echo "<option value=".$row['c_id'].">".$row['c_name']."</option>";
                }
                //If a category is None then that mean it is a parent category
                echo "<option value=NULL>None</option>";
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
    header('Location: /pages/inventory.php');
      //exit();
    // get form data, making sure it is valid
    $id = $_POST['id'];
    $c_name = mysql_real_escape_string(htmlspecialchars($_POST['c_name']));
    $pcat_id = $_POST['pcat_id'];
       // save the data to the database;
       $mysqli->query("
       UPDATE categories
      SET c_name='$c_name'
      WHERE c_id=$id
       ")
       or die(mysql_error());
       $mysqli->query("
       UPDATE categories
      SET c_parent=$pcat_id 
      WHERE c_id=$id
       ")
       or die(mysql_error());
       
      //check for errors here ^
   
    
   
      //check for errors here ^

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


  
  // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
  if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
  {
    // query db
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM categories WHERE c_id=$id") or die(mysql_error());
    $row = $result->fetch_assoc();

    // check that the 'id' matches up with a row in the databse
   
    if($row)
    {
      // get data from db
      $c_name = $row['c_name'];
      if(isset($row['c_parent']))
      {
        $result = $mysqli->query("SELECT * FROM categories WHERE c_id=".$row['c_parent']) or die(mysql_error());
        $row = $result->fetch_assoc();
        $c_parent = $row['c_name'];
      }
      else
      {
        $c_parent = "None";
      }


      // show form
      renderForm($id, $c_name, $c_parent ,$mysqli, '');

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
