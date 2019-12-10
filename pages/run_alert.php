<?php
/*
*   CC BY-NC-AS UTA FabLab 2016-2019
*   FabApp V 0.91
*   Author: Boris Konffo 10.16.2019
  // Each time this script is triggered, a low inventory alert will be send out via email is the is any material
   that is lowin stock

*   
*/

ob_start();
// get the Document Root path of fabapp, because $_SERVER['DOCUMENT_ROOT'] does not work in the cron file

$docRootPath='/opt/lampp/htdocs/fablab';

include_once ($docRootPath.'/connections/db_connect8.php');
include_once ($docRootPath.'/class/Notifications.php'); // so we can call the send mail function

date_default_timezone_set("America/Belize");  // to get the centrral time texas

$date = date("m/d/Y h:i:sa");   // get the data and the hour

//< Composed the body of the email
$message1="<h2>Fablab Low Inventory Alert</h2>"."\r\n";
$message1.="Fablab low inventory for ".$date.". \r\n";
$message1.="<br>The following materials/items have reached the minimum quantity <br>
Please login to FAblapp to add the new inventories." ."\r\n";

// will contain the actual table of items
$message2="<table>
<tr> 
<th>Material_name &nbsp; </th>
<th>Quantity &nbsp; </th>
<th>Current </th>
</tr>";
          
//< Query the oos_alert table, run each alert and send the email if possible

if ($result = $mysqli->query("
                    SELECT * FROM oos_alert as AO JOIN email as E ON AO.email_id = E.id_email  AND AO.is_active=1
                    ")) {              
                    while ($row = $result->fetch_assoc()) { 
                        $subject=$row['a_name'];
                        $to= $row['email_address'];
                        $min_qty=$row['min_qty']; 
                        $cr = $row['material_tag'];                
                       //  split the category 
                        $ct= array_filter(explode("_",$cr));  
                        // c_query is the extra part of the query that we use to cover the category
                        $c_query="";
                        echo $cr[0];
                        if($cr[0]="0"){  // Zero apply to all category
                       
                        if (count($ct) > 0){
                             $c_query.=" AND (";
                        
                            foreach ($ct as $c){
                                $c_query.="M.c_id=".$c." OR ";
                            }
                            $c_query=substr($c_query, 0, -3);;
                            $c_query.=")";
                        }
                    }  
                        
                        if ($resultEach = $mysqli->query("
                        SELECT * FROM sheet_good_inventory AS SGI JOIN materials AS M ON SGI.inv_id=M.m_id
                        where quantity <= $min_qty AND M.current='Y' $c_query
                                        ")) {
                                        
                            while ($row = $resultEach->fetch_assoc()) { 
                                $message2.="<tr>";
                                $message2.="<th>".$row['m_name']."</th>";
                                $message2.="<th>".$row['quantity']."</th>";
                                $message2.="<th>".$row['current']."</th>";
                                $message2.="</tr>";
                            }
                                $message2.="</table><br>";

                            $conclusion="<p> <br>Thank you </p>";
                            $conclusion.="<p><small> <br>Please do not reply to this automated message. <small></p>";
                            $message=$message1.$message2.$conclusion;
                             
                            if(mysql_num_rows($resultEach) >= 1){
                            //$isMailSend=SendMailo($to, $subject, $message);
                          
                            $isMailSend=Notifications::SendMail($to, $subject, $message);  //uncomment before commiting
                            }  
                        }
            
                 // check if the Email was sent      
                            if ($isMailSend){
                                echo ("email sent!");
                                                
                            } else {
                               echo ("email No sent!");
                                $errorMessage =  error_get_last()['message'];
                                echo $errorMessage;
                             }    
                    }
                }   
        
                // function SendMailo($to, $subject, $message){
                //     $headers =  'From: no-reply@fablab.uta.edu' . "\r\n".
                //                 'Reply-To: no-reply@fablab.uta.edu' . "\r\n".
                //                 'X-Mailer: PHP/' . phpversion();        
                //                     require_once 'PHPMailer/SMTP.php';
                //                     require_once 'PHPMailer/Exception.php';
                //                     //require_once "PHPMailer/PHPMailerAutoload.php";
                //                     require_once 'PHPMailer/PHPMailer.php';
                //                     $mail = new PHPMailer\PHPMailer\PHPMailer();
            
                //                     $email=$to;
                //                     $body=$message;
            
                //                     //SMTP Settings
                //                     $mail->isSMTP();
                //                     $mail->Host = "smtp.gmail.com";
                //                     $mail->SMTPAuth = true;
                //                     $mail->Username = "dyphydro@gmail.com";  //< The address you are sending from
                //                     $mail->Password = 'do it 2019';
                //                     $mail->Port = 465; //587
                //                     $mail->SMTPSecure = "ssl"; // you can also use "tls" 
                //                     //$mail->FromName();
            
                //                     //Email Settings
                //                     $mail->isHTML(true);
                //                     $mail->WordWrap = 70;  // create the new line after 70 characters
                //                     $mail->setFrom($email,'FabLab Alert');
                //                     $mail->addAddress($to);   //< The address you sending to 
                //                     $mail->Subject = $subject;
                //                     $mail->Body = $body;
                //                     // body in html
                //                     // $mail->Body = "This is in <b>Blod Text</b>";
                //                     // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'
                                
                //                     //$mail->AddReplyTo('donotreply@mydomain.com', $FromName);
                //                     if ($mail->send()) {
                //                         return true;
                //                         $status = "success";
                //                         $response = "Email is sent!";
                //                     } else {
                //                         return false;
                //                         $status = "failed";
                //                         $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
                //                         echo $response;
                //                     }
            
            
                // }

                $mysqli->close();
                        
                
?>


    

         
                   
              
  




  
    
