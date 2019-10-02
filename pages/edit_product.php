<?php

/*
*   CC BY-NC-AS UTA FabLab 2016-2018
*   FabApp V 0.91
*   Author: Khari Thomas
*
*   NOTE: This page needs to be updated to use prepared statements@@
*   possibly add a sub modal between all_goods.php and this page to check whether a page exists
*    e.g. id?=99
*
*   Add a success modal after succesful update so that the user knows whats going on
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

function renderForm($id, $qty, $error)
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

          <!-- <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <div>
              <p><strong>ID:</strong> <?php echo $id; ?></p>
              <strong>Quanity: *</strong> <input type="text" name="quantity" value="<?php echo $qty; ?>"/><br/>
              <p>* Required</p>
              <input type="submit" name="submit" value="Submit">
            </div>
          </form> -->

          <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <div>
              <p><strong>ID:</strong> <?php echo $id; ?></p>
            </div>
            <div class="form-group">
              <label for="exampleInputqty">Quantity:</label>
              <input type="text" class="form-control" id="exampleInputqty" placeholder="Enter Quantity" name="quantity" value="<?php echo $qty; ?>">
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
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
    $qty = mysql_real_escape_string(htmlspecialchars($_POST['quantity']));

    // check that qty, fields are both filled in
    if ($qty == '')
    {
      // generate error message
      $error = 'ERROR: Please fill in all required fields!';
      //error, display form
      renderForm($id, $qty, $error);
    }
    else
    {
      // save the data to the database;
      $mysqli->query("UPDATE all_good_inventory SET quantity=$qty WHERE inv_id=$id") or die(mysql_error());
      //check for errors here ^

      // once saved, redirect back to the view page
      header("Location: all_goods.php");
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
    $result = $mysqli->query("SELECT * FROM all_good_inventory WHERE inv_id=$id") or die(mysql_error());
    $row = $result->fetch_assoc();

    // check that the 'id' matches up with a row in the databse
    if($row)
    {
      // get data from db
      $qty = $row['quantity'];

      // show form
      renderForm($id, $qty, '');

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
