<?php

/*
*   CC BY-NC-AS UTA FabLab 2016-2019
*   FabApp V 0.91
*   Author: Boris Konffo 10.16.2019
*
*   NOTE: Create a new inventory  Alert
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

function renderForm($email,$error,$mysqli)
{
  ?>
  <html>
  <head>
    <title>Create new Email</title>
       <link rel="stylesheet" href="/vendor/fabapp/fabapp.css"> 
  </head>
  <body>
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-8">
          <h1 class="page-header">Add new Email</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <?php
          if($error != '') {
            echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
          }
          ?>

          <form action="" method="post">

            <table class="table table-bordered table-striped table-hover">
            <tr>
             <td>
            <div class="form-group col-lg-8">
              <label for="email">Email Address:</label>
              <td>
              <input type="text" class="form-control" id="eaddress" placeholder="Enter email address" name="eaddress" value="<?php echo $email; ?>" required>
               
              </td>
            </td>
            </tr>
            </div>

              <tr>         
              <td>
              <input action="action" onclick="window.history.go(-1); return false;" class="btn" type="button" value="Cancel" />
              </td>
              <td>
              <button type="submit" name="submit" class="btn btn-primary" >Submit</button>
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

$email='';
 $error='';
if (isset($_POST['submit']))
{  
  // confirm that the 'id' value is a valid integer before getting the form data
  if (isset($_POST['eaddress']))
  {
    // get form data, making sure it is valid
    $email = mysql_real_escape_string(htmlspecialchars($_POST['eaddress']));  
     // save the data to the database;
     // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = "Invalid email format";
      renderForm($email,$error,$mysqli);
    }
    else{
     $result=$mysqli->query("
     insert into email (email_address)
     Values('$email')
     ")
     or die(mysql_error());
     //check for errors here 
     //if(!$result) echo "database updated"; 
     header("Location: add_alert.php"); 

    }
  }
  else
  {
    // some field most be filed, reload the page
    renderForm($email,$error,$mysqli);
    //echo 'Error!';
  }
}
else
// if the form hasn't been submitted, display an empty form
{
   renderForm($email,$error,$mysqli); 
  // header("Location: add_alert.php"); 
}
?>


