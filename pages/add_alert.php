<?php

/*
*   CC BY-NC-AS UTA FabLab 2016-2019
*   FabApp V 0.91
*   Author: Boris Konffo 10.16.2019
*
*   NOTE: Create a new inventory  Alert, the for is prefill with the data drom the 
          data base
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

function renderForm($a_name,$min_qty,$active,$error,$mysqli)
{
  ?>
  <html>
  <head>
    <title>Create an inventory Alert</title>
       <link rel="stylesheet" href="/vendor/fabapp/fabapp.css"> 
  </head>
  <body>
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Create a new inventory alert</h1>
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

            <!--<div>
              <p><strong>ID:</strong> <?php// echo $id; ?></p>
            </div>
            -->
            <!--<input name="id" class="hidden" value=" <?php //echo $a_id ?>">  -->
            <table class="table table-bordered table-striped table-hover">
            <tr>
             <td>
            <div class="form-group col-lg-6">
              <label for="alertName">Alert Name:</label>
              <td>
              <input type="text" class="form-control" id="alertName" placeholder="Enter Alert name" name="a_name" value="<?php echo $a_name; ?>" required>
               
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
            <div class="form-group col-lg-8">
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
              <br/>
              <input action="action" onclick="parent.location='email.php'" class="btn" type="button" value="add email" />
            </td>
            </tr>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>

            <div  class="form-group col-lg-4">
            
            <tr>
          
            <td>
            
             <label for="enabled"> Enabled</label>
             <select class='form-control col-md-40' name="enabled" id="enabled" required>                      
                         <option value=1 selected> Yes </option>
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
                <select class='form-control' name='c_tag[]' multiple>
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
$a_name='';
// $id_email='';
 $active=1;
 $min_qty=2;
 $error='';
if (isset($_POST['submit']))
{ 
   
  // confirm that the 'id' value is a valid integer before getting the form data
  if (isset($_POST['a_name']) && isset($_POST['min_qty']) && isset($_POST['id_email']) && isset($_POST['enabled']) && isset($_POST['trig_time']) )
  {
    // get form data, making sure it is valid
   // $id = $_POST['id'];
    $an = mysql_real_escape_string(htmlspecialchars($_POST['a_name']));
    $min_qty = mysql_real_escape_string(htmlspecialchars($_POST['min_qty']));
    $id_email = mysql_real_escape_string(htmlspecialchars($_POST['id_email']));
    
    $is_enabled=mysql_real_escape_string(htmlspecialchars($_POST['enabled']));
    $time=mysql_real_escape_string(htmlspecialchars($_POST['trig_time']));

     // Check if any option is selected 
     $ct="";  // separator
     // build the category tag string
     if(isset($_POST['c_tag']))  
     { 
         // Retrieving each selected option 
         foreach ($_POST['c_tag'] as $c)  
             $ct.=$c."_";
     } 
    // check that required fields are filled in
    if ($min_qty == 0)
    {
      // generate error message
      $error = 'ERROR: The minimum quantity must be greater than 0 !';
      //error, display form
      renderForm($a_name,$min_qty,$active,$error,$mysqli);
    }
    else
    { 
      // save the data to the database;
      $r=$mysqli->query("
      insert into oos_alert (a_name,min_qty,email_id,trig_time,is_active,material_tag)
      Values('$an',$min_qty,$id_email, $time,$is_enabled,'$ct')
      
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
    // some field most be filed, reload the page
    renderForm($a_name,$min_qty,$active,$error,$mysqli);
  }
}
else
// if the form hasn't been submitted, display an empty form
{
   
    renderForm($a_name,$min_qty,$active,$error,$mysqli);
  
}
?>


