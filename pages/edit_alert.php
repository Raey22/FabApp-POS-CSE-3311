<?php

/*
*   CC BY-NC-AS UTA FabLab 2016-2019
*   FabApp V 0.91
*   Author: Boris Konffo
**  NOTE: Edit existing inventory alert
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

function renderForm($a_id,$a_name,$min_qty,$id_email,$active,$error,$mysqli)
{
  ?>
  <html>
  <head>
    <title>Edit Inventory Alert</title>
       <link rel="stylesheet" href="/vendor/fabapp/fabapp.css"> 
  </head>
  <body>
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Edit Inventory Alert</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <?php
          if($error != '') {
            echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
          }
          ?>

          <form action="" method="post">
            <input name="id" class="hidden" value="<?php echo $a_id ?>">
            <table class="table table-bordered table-striped table-hover">
            <tr>
             <td>
            <div class="form-group col-lg-4">
              <label for="alertName">Alert Name:</label>
              <td>
              <input type="text" class="form-control" id="alertName" placeholder="Enter Alert name" name="a_name"  value="<?php echo $a_name; ?>" required>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
              </td>
            </td>
            </tr>
            </div>
            
            <div class="panel-body">
              
              <tr>
                <td>
                <label for="min_qty">Alert me:  &nbsp;</label>
             
                   <p><strong></strong> <?php echo("When quantity on hand is less than"); ?></p>
                </td>
                <td>
                <input type="text"  class="form-control col-md-4" size="3" id="min_qty" placeholder="Enter minimum qty" name="min_qty" value="<?php echo $min_qty; ?>" required>
                </td>
            </tr>
            
            </div>
            <tr>
            <td>
            <div class="form-group col-lg-4">
              <?php 
                  $result = $mysqli -> query("SELECT * FROM email") or die(mysql_error());
              ?>
             <label for="email">Recipient Email:</label> <br/>
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> 
            </td>
            <td>
              <select class='form-control col-md-4' id="id_e" name="id_email" tabindex="1" required>
              <option disabled hidden selected value="">Select Email</option>
              <?php if($result){
                      while($rowe = $result->fetch_assoc()){  ?>
                         <option value="<?php echo $rowe['id_email']; ?>"> <?php echo $rowe['email_address']; ?></option>
                     <?php }   ?>
              <?php }  ?>
              </select>
            </td>
            </tr>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>

            <div  class="form-group col-lg-4">
            
            <tr>
          
            <td>
            
             <label for="enabled"> Enabled</label>
             <select class='form-control col-md-40' name="enabled" id="enabled">                      
                         <option value=1 seleceted> Yes </option>
                         <option value=0> No </option>
              </select>
             </td>
             
             <td>
             <label for="time" > Time </label>
             <select class='form-control col-md-2' name="trig_time" id="trig_time">                      
                          <option value=8 selected> 8 AM </option>
                         <option  value=1> 1 PM </option>
              </select>
              </td>
              </tr>
             </div>
            
             <div class="form-group col-lg-3">
            <?php $rs = $mysqli -> query("SELECT * FROM categories") or die(mysql_error());  ?>
           
            
            <tr>
            <td>
              
            <label for="SelectmaterialsCategories"> Select Categories  &nbsp; </label>
                <small id="categoryhelp" class="form-text text-muted">  <u>Note:</u> press ctrl to select multiple categories</small> <br/> 
                <select class='form-control' name='c_tag[]' required multiple>
                <option value=0>  All Categories  </option>   <!-- 0 to select all categories-->
                <?php if($rs){
                      while($row = $rs->fetch_assoc()){  ?>
                        
                         <option value="<?php echo $row['c_id']; ?>"> <?php echo $row['c_name']; ?></option>
                     <?php }   ?>
              <?php }  ?>
              </select>
              </td>
              </tr> 

              <tr>         
             

             
              <td>

         
              <button type="submit" name="submit" class="btn btn-primary" >Submit</button>
              </td>

              <td>
              <input action="action" onclick="window.history.go(-1); return false;" class="btn" type="button" value="Cancel" />
              </td>
              </tr> 

              </table>
              
              <br>
              
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
    $id = mysql_real_escape_string(htmlspecialchars($_POST['id']));
    $an = mysql_real_escape_string(htmlspecialchars($_POST['a_name']));
    $min_qty = mysql_real_escape_string(htmlspecialchars($_POST['min_qty']));
    $id_email = mysql_real_escape_string(htmlspecialchars($_POST['id_email']));
    
    $is_enabled=mysql_real_escape_string(htmlspecialchars($_POST['enabled']));
    $time=mysql_real_escape_string(htmlspecialchars($_POST['trig_time']));
     // Check if any option is selected 
     $ct="";  // separator
     if(isset($_POST['c_tag']))  
     { 
         // Retrieving each selected option 
         foreach ($_POST['c_tag'] as $c)  
             $ct.=$c."_";
     } 
     echo $ct;
    
    // check that required fields are filled in
    if ($min_qty == 0)
    {
      // generate error message
      $error = 'ERROR: Please fill in all required fields!';
      //error, display form
      renderForm($a_id,$a_name,$min_qty,$id_email,$active,$error,$mysqli);
    }
    else
    {
     
      // save the data to the database;
      $r=$mysqli->query("
      UPDATE oos_alert SET a_name='$an', 
      min_qty=$min_qty, email_id=$id_email, trig_time=$time, is_active=$is_enabled, material_tag='$ct'
      WHERE a_id=$id
      ")
      or die(mysql_error());

      //check for errors here ^
      if(!$r) echo "database updated";

      // once saved, redirect back to the view page
      header("Location: alert.php");
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
    $result = $mysqli -> query(" SELECT * FROM oos_alert as AO JOIN email as E ON AO.email_id = E.id_email WHERE a_id=$id") or die(mysql_error());
    //$result = $mysqli->query("SELECT * FROM all_good_inventory AI JOIN materials M ON AI.m_id = M.m_id WHERE inv_id=$id") or die(mysql_error());
    $row = $result->fetch_assoc();

    // check that the 'id' matches up with a row in the databse
    if($row)
    {
      // get data from db
      $a_id = $row['a_id'];
      $a_name = $row['a_name'];
      $min_qty = $row['min_qty'];
      $id_email = $row['id_email'];
      $active = $row['is_active'];

      // show form
      renderForm($a_id,$a_name,$min_qty,$id_email,$active,'',$mysqli);

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





