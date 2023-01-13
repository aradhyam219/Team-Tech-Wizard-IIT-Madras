<?php
 session_start();
 $errors = array();
$showAlert=false;
$showError=false;
$password_verified=false;

 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
     header("location:net_banking_login.php");
     exit;
 }
 else{
    
 include "dbconnect.php";
 $login_username=$_SESSION['login_username'];
 $select_display= "select * from card_account_details where login_username='$login_username'" ;
 $sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($sql1)){

 $login_username=$row1[1];
 $full_name=$row1[2];
 $sender_email_id=$row1[3];
 $account_number=$row1[4]; 
 $ifsc_code=$row1[10];
 $current_balance=$row1[13];
 }

$select_transaction= "select * from transactions where login_username='$login_username'" ;
 $sql_time = mysqli_query($conn,$select_transaction);
 while($row2 = mysqli_fetch_array($sql_time)){
    $transaction_time=$row2[13];
 }
 
 }


?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$tid_id=$_POST['tid_id'];
   $transfer_amount=$_POST['transfer_amount'];
   $receiver_account_number=$_POST['account_number'];
   $receiver_ifsc_code=$_POST['ifsc_code'];
   $receiver_account_holder_name=$_POST['full_name'];
   
   $transaction_pin_entered=$_POST['transaction_pin'];
   $country=$_POST['country'];
   
   date_default_timezone_set('Asia/Kolkata');
   $timestamp = date("Y-m-d H:i:s");
   $current_date = date("Y-m-d");
   $transaction_limit_count= "select count(*) from transactions where login_username='$login_username' and transaction_time='$current_date'";
   $sql_transaction_limit = mysqli_query($conn,$transaction_limit_count);
   $number_of_transactions = mysqli_fetch_array($sql_transaction_limit)[0];
   $ip_address = $_SERVER['REMOTE_ADDR'];
   date_default_timezone_set('Asia/Kolkata');
   $current_date = date("Y-m-d");
// amount
$query_amount = "SELECT sum(transfer_amount) as total FROM transactions WHERE transaction_time = '$current_date' and login_username='$login_username' and balance_type='debit'";
$result = mysqli_query($conn, $query_amount);
$row = mysqli_fetch_assoc($result);
$total=$row['total'];





//    conditions
$sender_account= "select * from card_account_details where login_username='$login_username'";
   $sql = mysqli_query($conn,$sender_account);
   

   $num = mysqli_num_rows($sql);
   
if($num==1){
   while($row1 = mysqli_fetch_assoc($sql)){
   $login_username= $row1['login_username'];
   $sender_account_number=$row1['account_number'];
   $sender_ifsc_code=$row1['ifsc_code'];
   $sender_balance=$row1['balance'];
   $sender_email_id=$row1['email_id'];
   $sender_account_holder_name=$row1['full_name'];
   $sender_country=$row1['country'];
   $sender_transfer_amount=$row1['transfer_amount'];
   }
if($sender_balance<$transfer_amount){
	$errors['sender_balance'] = "insufficient funds in your account";
}
else if($sender_account_number===$receiver_account_number){
	$errors['same_sender'] = "Receiver's account number cannot be the same as sender's account number";

}
else if ($total+$transfer_amount > 1000) {
    $errors['amount_max']= "Alert: Transfer amount exceeds 1000 ";
  }
    

else{


    


// conditions ends
   

   
   if($number_of_transactions>10){

    $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
    'X-Mailer: PHP/' . phpversion()."\r\n" ;
$headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
$to = "$sender_email_id";
$additional_parameters = '-fsupport@smilewellnessfoundation.org';
$subject = 'Alert Transaction limit reached  ';
    $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
    <html xmlns:v='urn:schemas-microsoft-com:vml'>
    
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
        <!--[if !mso]--><!-- -->                                               u
        <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
        <!-- <![endif]-->
    
        <title>Material Design for Bootstrap</title>
    
        <style type='text/css'>
            body {
                width: 100%;
                background-color: #ffffff;
                margin: 0;
                padding: 0;
                -webkit-font-smoothing: antialiased;
                mso-margin-top-alt: 0px;
                mso-margin-bottom-alt: 0px;
                mso-padding-alt: 0px 0px 0px 0px;
            }
    
            p,
            h1,
            h2,
            h3,
            h4 {
                margin-top: 0;
                margin-bottom: 0;
                padding-top: 0;
                padding-bottom: 0;
            }
    
            span.preheader {
                display: none;
                font-size: 1px;
            }
    
            html {
                width: 100%;
            }
    
            table {
                font-size: 14px;
                border: 0;
            }
            /* ----------- responsivity ----------- */
    
            @media only screen and (max-width: 640px) {
                /*------ top header ------ */
                .main-header {
                    font-size: 20px !important;
                }
                .main-section-header {
                    font-size: 28px !important;
                }
                .show {
                    display: block !important;
                }
                .hide {
                    display: none !important;
                }
                .align-center {
                    text-align: center !important;
                }
                .no-bg {
                    background: none !important;
                }
                /*----- main image -------*/
                .main-image img {
                    width: 440px !important;
                    height: auto !important;
                }
                /* ====== divider ====== */
                .divider img {
                    width: 440px !important;
                }
                /*-------- container --------*/
                .container590 {
                    width: 440px !important;
                }
                .container580 {
                    width: 400px !important;
                }
                .main-button {
                    width: 220px !important;
                }
                /*-------- secions ----------*/
                .section-img img {
                    width: 320px !important;
                    height: auto !important;
                }
                .team-img img {
                    width: 100% !important;
                    height: auto !important;
                }
            }
    
            @media only screen and (max-width: 479px) {
                /*------ top header ------ */
                .main-header {
                    font-size: 18px !important;
                }
                .main-section-header {
                    font-size: 26px !important;
                }
                /* ====== divider ====== */
                .divider img {
                    width: 280px !important;
                }
                /*-------- container --------*/
                .container590 {
                    width: 280px !important;
                }
                .container590 {
                    width: 280px !important;
                }
                .container580 {
                    width: 260px !important;
                }
                /*-------- secions ----------*/
                .section-img img {
                    width: 280px !important;
                    height: auto !important;
                }
            }
        </style>
        <!-- [if gte mso 9]><style type=”text/css”>
            body {
            font-family: arial, sans-serif!important;
            }
            </style>
        <![endif]-->
    </head>
    
    
    <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
        <!-- pre-header -->
        <table style='display:none!important;'>
            <tr>
                <td>
                    <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
                        Pre-header for the newsletter template
                    </div>
                </td>
            </tr>
        </table>
        <!-- pre-header end -->
        <!-- header -->
        <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
    
            <tr>
                <td align='center'>
                    <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
    
                        <tr>
                            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align='center'>
    
                                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
    
                                    <tr>
                                        <td align='center' height='70' style='height:17px;'>
                                            <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png' alt='' /></a>
                                        </td>
                                    </tr>
    
                                   
                                </table>
                            </td>
                        </tr>
    
                        
                    </table>
                </td>
            </tr>
        </table>
        <!-- end header -->
    
        <!-- big image section -->
        <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
    
            <tr>
                <td align='center'>
                    <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                        
                        <tr>
                            <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                        </tr>
                        <tr>
                            <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
                                class='main-header'>
    
    
                                <div style='line-height: 35px'>
    
                                    Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank ".$sender_account_holder_name."</span>
    
                                </div>
                            </td>
                        </tr>
    
                        <tr>
                            <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align='center'>
                                <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
                                    <tr>
                                        <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
    
                        <tr>
                            <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align='center'>
                                <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
                                    <tr>
                                        <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
    
    
                                            <div style='line-height: 24px'>
    
                                               <h2>Funds can not be transfered successfully from your account number to </h2><span style='color: #FFD700;'> <b>".$receiver_account_number."</b></span> <br> !!!  and transaction Ip address is <b>".$ip_address." </b> at time <b>".$timestamp."</b> <br>
                                               
                        
                                               </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
    
                        <tr>
                            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td> 
                        </tr>
    
                       
    
                    </table>
    
                </td>
            </tr>
    
            <tr class='hide'>
                <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
            </tr>
            <tr>
                <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
            </tr>
    
        </table>
        <!-- end section -->
    
    

    
    
        <!-- footer ====== -->
        <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
    
            <tr>
                <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
            </tr>
    
            <tr>
                <td align='center'>
    
                    <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
    
                        <tr>
                            <td>
                                <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                    class='container590'>
                                    <tr>
                                        <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                                            <div style='line-height: 24px;'>
    
                                                <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
    
                                            </div>
                                        </td>
                                    </tr>
                                </table>
    
                                
                               
                            </td>
                        </tr>
    
                    </table>
                </td>
            </tr>
    
            
    
        </table>
        <!-- end footer ====== -->
    
    </body>
    
    </html>";
                              //whether ip is from share internet


    if (mail($to,$subject,$message,$headers,$additional_parameters)){
      //echo "Your Mail is sent successfully.";
      $errors['transaction_limit']="Dear user maximum transaction limit has been reached please do the transaction tomorrow!!";                    
    }
    else{
      //echo "Your Mail is not sent. Try Again.";
      $errors['mail'] = "mail not send";
    }


   }
   else{




   $ip_address = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Kolkata');
          $timestamp = date("Y-m-d H:i:s");


        
   


   //$email=$_POST['email'];
   $sender_account= "select * from card_account_details where login_username='$login_username'";
   $sql = mysqli_query($conn,$sender_account);
   

   $num = mysqli_num_rows($sql);
   
if($num==1){
   while($row1 = mysqli_fetch_assoc($sql)){
   $login_username= $row1['login_username'];
   $sender_account_number=$row1['account_number'];
   $sender_ifsc_code=$row1['ifsc_code'];
   $sender_balance=$row1['balance'];
   $sender_email_id=$row1['email_id'];
   $sender_account_holder_name=$row1['full_name'];
   $sender_country=$row1['country'];
   $store=$row1['transaction_pin'];
	if (password_verify($transaction_pin_entered,$store)){
			$password_verified=true;

		
	
		

		
$receiver_account= "select * from card_account_details where account_number='$receiver_account_number' and ifsc_code='$receiver_ifsc_code'";
   $sql_receiver = mysqli_query($conn,$receiver_account);
   while($row2 = mysqli_fetch_assoc($sql_receiver)){
   $receiver_login_username= $row2['login_username'];
   $receiver_account_number=$row2['account_number'];
   $receiver_ifsc_code=$row2['ifsc_code'];
   $receiver_balance=$row2['balance'];
   $receiver_email_id=$row2['email_id'];
   $receiver_account_holder_name=$row2['full_name'];
   $receiver_country=$row2['country'];
}
$timestamp = date("Y-m-d H:i:s");

$current_date = date('Y-m-d');


$payee_transaction_limit_count= "select count(*) from transactions where login_username='$login_username' and account_number='$receiver_account_number' and transaction_time='$current_date'";
$sql_payee_transaction_limit = mysqli_query($conn,$payee_transaction_limit_count);
$number_of_payee_transactions = mysqli_fetch_array($sql_payee_transaction_limit)[0];

if($number_of_payee_transactions>2){
    

    $sender_new_balance=$sender_balance-$transfer_amount;
        
        $update_sender="update card_account_details set balance='$sender_new_balance' where login_username='$login_username'";
        $sql2=mysqli_query($conn,$update_sender);
    if($sql2){
        
            $insert_sender ="INSERT INTO `transactions` ( `tid_id`,`login_username`, `email_id`,`account_number`,`full_name`,`ifsc_code`,`transfer_amount`,`balance`,`ip_address`,`balance_type`,`transaction_time`,`country`,`activity_type`) VALUES 
                                                        ('$tid_id','$login_username','$receiver_email_id','$receiver_account_number','$receiver_account_holder_name','$receiver_ifsc_code','$transfer_amount','$sender_new_balance','$ip_address','debit','$timestamp','$receiver_country','fraud/suspicious')";
    
              $sql_sender_deduct=mysqli_query($conn,$insert_sender);

    
    $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
    'X-Mailer: PHP/' . phpversion()."\r\n" ;
$headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
$to = "$sender_email_id";
$additional_parameters = '-fsupport@smilewellnessfoundation.org';
$subject = 'Suspicious transaction notice  ';
    $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
    <html xmlns:v='urn:schemas-microsoft-com:vml'>
    
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
        <!--[if !mso]--><!-- -->
        <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
        <!-- <![endif]-->
    
        <title>Material Design for Bootstrap</title>
    
        <style type='text/css'>
            body {
                width: 100%;
                background-color: #ffffff;
                margin: 0;
                padding: 0;
                -webkit-font-smoothing: antialiased;
                mso-margin-top-alt: 0px;
                mso-margin-bottom-alt: 0px;
                mso-padding-alt: 0px 0px 0px 0px;
            }
    
            p,
            h1,
            h2,
            h3,
            h4 {
                margin-top: 0;
                margin-bottom: 0;
                padding-top: 0;
                padding-bottom: 0;
            }
    
            span.preheader {
                display: none;
                font-size: 1px;
            }
    
            html {
                width: 100%;
            }
    
            table {
                font-size: 14px;
                border: 0;
            }
            /* ----------- responsivity ----------- */
    
            @media only screen and (max-width: 640px) {
                /*------ top header ------ */
                .main-header {
                    font-size: 20px !important;
                }
                .main-section-header {
                    font-size: 28px !important;
                }
                .show {
                    display: block !important;
                }
                .hide {
                    display: none !important;
                }
                .align-center {
                    text-align: center !important;
                }
                .no-bg {
                    background: none !important;
                }
                /*----- main image -------*/
                .main-image img {
                    width: 440px !important;
                    height: auto !important;
                }
                /* ====== divider ====== */
                .divider img {
                    width: 440px !important;
                }
                /*-------- container --------*/
                .container590 {
                    width: 440px !important;
                }
                .container580 {
                    width: 400px !important;
                }
                .main-button {
                    width: 220px !important;
                }
                /*-------- secions ----------*/
                .section-img img {
                    width: 320px !important;
                    height: auto !important;
                }
                .team-img img {
                    width: 100% !important;
                    height: auto !important;
                }
            }
    
            @media only screen and (max-width: 479px) {
                /*------ top header ------ */
                .main-header {
                    font-size: 18px !important;
                }
                .main-section-header {
                    font-size: 26px !important;
                }
                /* ====== divider ====== */
                .divider img {
                    width: 280px !important;
                }
                /*-------- container --------*/
                .container590 {
                    width: 280px !important;
                }
                .container590 {
                    width: 280px !important;
                }
                .container580 {
                    width: 260px !important;
                }
                /*-------- secions ----------*/
                .section-img img {
                    width: 280px !important;
                    height: auto !important;
                }
            }
        </style>
        <!-- [if gte mso 9]><style type=”text/css”>
            body {
            font-family: arial, sans-serif!important;
            }
            </style>
        <![endif]-->
    </head>
    
    
    <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
        <!-- pre-header -->
        <table style='display:none!important;'>
            <tr>
                <td>
                    <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
                        Pre-header for the newsletter template
                    </div>
                </td>
            </tr>
        </table>
        <!-- pre-header end -->
        <!-- header -->
        <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
    
            <tr>
                <td align='center'>
                    <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
    
                        <tr>
                            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align='center'>
    
                                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
    
                                    <tr>
                                        <td align='center' height='70' style='height:17px;'>
                                            <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png' alt='' /></a>
                                        </td>
                                    </tr>
    
                                   
                                </table>
                            </td>
                        </tr>
    
                        
                    </table>
                </td>
            </tr>
        </table>
        <!-- end header -->
    
        <!-- big image section -->
        <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
    
            <tr>
                <td align='center'>
                    <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                        
                        <tr>
                            <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                        </tr>
                        <tr>
                            <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
                                class='main-header'>
    
    
                                <div style='line-height: 35px'>
    
                                    Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank ".$sender_account_holder_name."</span>
    
                                </div>
                            </td>
                        </tr>
    
                        <tr>
                            <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align='center'>
                                <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
                                    <tr>
                                        <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
    
                        <tr>
                            <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align='center'>
                                <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
                                    <tr>
                                        <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
    
    
                                            <div style='line-height: 24px'>
    
                                               <h2>Suspicious funds debit from your account number to </h2><span style='color: #FFD700;'> <b>".$receiver_account_number."</b></span> <br> !!!  and updated balance is ".$sender_new_balance."and transaction Ip address is <b>".$ip_address." </b> at time <b>".$timestamp."</b> <br>
                                               
                        
                                               </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
    
                        <tr>
                            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td> 
                        </tr>
    
                       
    
                    </table>
    
                </td>
            </tr>
    
            <tr class='hide'>
                <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
            </tr>
            <tr>
                <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
            </tr>
    
        </table>
        <!-- end section -->
    
    

    
    
        <!-- footer ====== -->
        <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
    
            <tr>
                <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
            </tr>
    
            <tr>
                <td align='center'>
    
                    <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
    
                        <tr>
                            <td>
                                <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                    class='container590'>
                                    <tr>
                                        <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                                            <div style='line-height: 24px;'>
    
                                                <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
    
                                            </div>
                                        </td>
                                    </tr>
                                </table>
    
                                
                               
                            </td>
                        </tr>
    
                    </table>
                </td>
            </tr>
    
            
    
        </table>
        <!-- end footer ====== -->
    
    </body>
    
    </html>";
                              //whether ip is from share internet


    if (mail($to,$subject,$message,$headers,$additional_parameters)){
      //echo "Your Mail is sent successfully.";
      $errors['payee_limit']="Dear user transaction more than 2 for same receiver has been notice  tomorrow!!";                    
    }
    else{
      //echo "Your Mail is not sent. Try Again.";
      $errors['mail'] = "mail not send";
    }



}

if($sql_sender_deduct){
    $receiver_new_balance=$receiver_balance+$transfer_amount;
    $update_receiver="update card_account_details set balance='$receiver_new_balance' where account_number='$receiver_account_number' and ifsc_code='$receiver_ifsc_code'";
    $sql3=mysqli_query($conn,$update_receiver);
    }
    if($sql3){
    
        $insert_receiver ="INSERT INTO `transactions` ( `tid_id`,`login_username`, `email_id`,`account_number`,`full_name`,`ifsc_code`,`transfer_amount`,`balance`,`ip_address`,`balance_type`,`transaction_time`,country) VALUES 
                                                      ('$tid_id','$receiver_login_username','$sender_email_id','$sender_account_number','$sender_account_holder_name','$sender_ifsc_code','$transfer_amount','$receiver_new_balance','$ip_address','credit','$timestamp','$sender_country')";
          $sql_receiver_added=mysqli_query($conn,$insert_receiver);
          $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
          'X-Mailer: PHP/' . phpversion()."\r\n" ;
$headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
$to = "$receiver_email_id";
$additional_parameters = '-fsupport@smilewellnessfoundation.org';
$subject = 'suspicious Transaction happend Money credit';
$message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
          <html xmlns:v='urn:schemas-microsoft-com:vml'>
          
          <head>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
              <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
              <!--[if !mso]--><!-- -->
              <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
              <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
              <!-- <![endif]-->
          
              <title>Material Design for Bootstrap</title>
          
              <style type='text/css'>
                  body {
                      width: 100%;
                      background-color: #ffffff;
                      margin: 0;
                      padding: 0;
                      -webkit-font-smoothing: antialiased;
                      mso-margin-top-alt: 0px;
                      mso-margin-bottom-alt: 0px;
                      mso-padding-alt: 0px 0px 0px 0px;
                  }
          
                  p,
                  h1,
                  h2,
                  h3,
                  h4 {
                      margin-top: 0;
                      margin-bottom: 0;
                      padding-top: 0;
                      padding-bottom: 0;
                  }
          
                  span.preheader {
                      display: none;
                      font-size: 1px;
                  }
          
                  html {
                      width: 100%;
                  }
          
                  table {
                      font-size: 14px;
                      border: 0;
                  }
                  /* ----------- responsivity ----------- */
          
                  @media only screen and (max-width: 640px) {
                      /*------ top header ------ */
                      .main-header {
                          font-size: 20px !important;
                      }
                      .main-section-header {
                          font-size: 28px !important;
                      }
                      .show {
                          display: block !important;
                      }
                      .hide {
                          display: none !important;
                      }
                      .align-center {
                          text-align: center !important;
                      }
                      .no-bg {
                          background: none !important;
                      }
                      /*----- main image -------*/
                      .main-image img {
                          width: 440px !important;
                          height: auto !important;
                      }
                      /* ====== divider ====== */
                      .divider img {
                          width: 440px !important;
                      }
                      /*-------- container --------*/
                      .container590 {
                          width: 440px !important;
                      }
                      .container580 {
                          width: 400px !important;
                      }
                      .main-button {
                          width: 220px !important;
                      }
                      /*-------- secions ----------*/
                      .section-img img {
                          width: 320px !important;
                          height: auto !important;
                      }
                      .team-img img {
                          width: 100% !important;
                          height: auto !important;
                      }
                  }
          
                  @media only screen and (max-width: 479px) {
                      /*------ top header ------ */
                      .main-header {
                          font-size: 18px !important;
                      }
                      .main-section-header {
                          font-size: 26px !important;
                      }
                      /* ====== divider ====== */
                      .divider img {
                          width: 280px !important;
                      }
                      /*-------- container --------*/
                      .container590 {
                          width: 280px !important;
                      }
                      .container590 {
                          width: 280px !important;
                      }
                      .container580 {
                          width: 260px !important;
                      }
                      /*-------- secions ----------*/
                      .section-img img {
                          width: 280px !important;
                          height: auto !important;
                      }
                  }
              </style>
              <!-- [if gte mso 9]><style type=”text/css”>
                  body {
                  font-family: arial, sans-serif!important;
                  }
                  </style>
              <![endif]-->
          </head>
          
          
          <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
              <!-- pre-header -->
              <table style='display:none!important;'>
                  <tr>
                      <td>
                          <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
                              Pre-header for the newsletter template
                          </div>
                      </td>
                  </tr>
              </table>
              <!-- pre-header end -->
              <!-- header -->
              <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
          
                  <tr>
                      <td align='center'>
                          <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
          
                              <tr>
                                  <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                              </tr>
          
                              <tr>
                                  <td align='center'>
          
                                      <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
          
                                          <tr>
                                              <td align='center' height='70' style='height:17px;'>
                                                  <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png' alt='' /></a>
                                              </td>
                                          </tr>
          
                                         
                                      </table>
                                  </td>
                              </tr>
          
                              
                          </table>
                      </td>
                  </tr>
              </table>
              <!-- end header -->
          
              <!-- big image section -->
              <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
          
                  <tr>
                      <td align='center'>
                          <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                              
                              <tr>
                                  <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                              </tr>
                              <tr>
                                  <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
                                      class='main-header'>
          
          
                                      <div style='line-height: 35px'>
          
                                          Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank ".$receiver_account_holder_name."</span>
          
                                      </div>
                                  </td>
                              </tr>
          
                              <tr>
                                  <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                              </tr>
          
                              <tr>
                                  <td align='center'>
                                      <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
                                          <tr>
                                              <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
                                          </tr>
                                      </table>
                                  </td>
                              </tr>
          
                              <tr>
                                  <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                              </tr>
          
                              <tr>
                                  <td align='center'>
                                      <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
                                          <tr>
                                              <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
          
          
                                                  <div style='line-height: 24px'>
          
                                                     <h2>Suspicious Funds added successfully to your account number from </h2><span style='color: #FFD700;'> <b>".$sender_account_number."</b></span> <br> !!! <h2>updated balance is </h2><span style='color: #FFD700;'><b>".$receiver_new_balance."</b></span>  and transaction Ip address is <b>".$ip_address." </b> at time <b>".$timestamp."</b> <br>
                                                     
                              
                                                     </div>
                                              </td>
                                          </tr>
                                      </table>
                                  </td>
                              </tr>
          
                              <tr>
                                  <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td> 
                              </tr>
          
                             
          
                          </table>
          
                      </td>
                  </tr>
          
                  <tr class='hide'>
                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                  </tr>
                  <tr>
                      <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                  </tr>
          
              </table>
              <!-- end section -->
          
          

          
          
              <!-- footer ====== -->
              <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
          
                  <tr>
                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                  </tr>
          
                  <tr>
                      <td align='center'>
          
                          <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
          
                              <tr>
                                  <td>
                                      <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                          class='container590'>
                                          <tr>
                                              <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                                                  <div style='line-height: 24px;'>
          
                                                      <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
          
                                                  </div>
                                              </td>
                                          </tr>
                                      </table>
          
                                      
                                     
                                  </td>
                              </tr>
          
                          </table>
                      </td>
                  </tr>
          
                  
          
              </table>
              <!-- end footer ====== -->
          
          </body>
          
          </html>";
                                    //whether ip is from share internet


          if (mail($to,$subject,$message,$headers,$additional_parameters)){
            //echo "Your Mail is sent successfully.";

           $showAlert=true;
                          
                            header('location:view_bank_balance.php');
          }
          else{
            //echo "Your Mail is not sent. Try Again.";
            $errors['mail'] = "mail not send";
          }
    
   }
}



// checking for payee more than 2  fine





// beow code working fine


else{
// if($sender_balance<$transfer_amount){
// 	$errors['sender_balance'] = "insufficient funds in your account";
// }
// else if($sender_account_number===$receiver_account_number){
// 	$errors['same_sender'] = "Receiver's account number cannot be the same as sender's account number";

// }
if($sender_country!='india'){
        $sender_new_balance=$sender_balance-$transfer_amount;
        
        $update_sender="update card_account_details set balance='$sender_new_balance' where login_username='$login_username'";
        $sql2=mysqli_query($conn,$update_sender);
    if($sql2){
        
            $insert_sender ="INSERT INTO `transactions` ( `tid_id`,`login_username`, `email_id`,`account_number`,`full_name`,`ifsc_code`,`transfer_amount`,`balance`,`ip_address`,`balance_type`,`transaction_time`,country) VALUES 
                                                        ('$tid_id','$login_username','$receiver_email_id','$receiver_account_number','$receiver_account_holder_name','$receiver_ifsc_code','$transfer_amount','$sender_new_balance','$ip_address','debit','$timestamp','$receiver_country')";
    
              $sql_sender_deduct=mysqli_query($conn,$insert_sender);
    
              $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
              'X-Mailer: PHP/' . phpversion()."\r\n" ;
    $headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
    $to = "$sender_email_id";
    $additional_parameters = '-fsupport@smilewellnessfoundation.org';
    $subject = 'Alert International Transaction happend Money Debit  ';
              $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
              <html xmlns:v='urn:schemas-microsoft-com:vml'>
              
              <head>
                  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                  <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
                  <!--[if !mso]--><!-- -->
                  <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
                  <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
                  <!-- <![endif]-->
              
                  <title>Material Design for Bootstrap</title>
              
                  <style type='text/css'>
                      body {
                          width: 100%;
                          background-color: #ffffff;
                          margin: 0;
                          padding: 0;
                          -webkit-font-smoothing: antialiased;
                          mso-margin-top-alt: 0px;
                          mso-margin-bottom-alt: 0px;
                          mso-padding-alt: 0px 0px 0px 0px;
                      }
              
                      p,
                      h1,
                      h2,
                      h3,
                      h4 {
                          margin-top: 0;
                          margin-bottom: 0;
                          padding-top: 0;
                          padding-bottom: 0;
                      }
              
                      span.preheader {
                          display: none;
                          font-size: 1px;
                      }
              
                      html {
                          width: 100%;
                      }
              
                      table {
                          font-size: 14px;
                          border: 0;
                      }
                      /* ----------- responsivity ----------- */
              
                      @media only screen and (max-width: 640px) {
                          /*------ top header ------ */
                          .main-header {
                              font-size: 20px !important;
                          }
                          .main-section-header {
                              font-size: 28px !important;
                          }
                          .show {
                              display: block !important;
                          }
                          .hide {
                              display: none !important;
                          }
                          .align-center {
                              text-align: center !important;
                          }
                          .no-bg {
                              background: none !important;
                          }
                          /*----- main image -------*/
                          .main-image img {
                              width: 440px !important;
                              height: auto !important;
                          }
                          /* ====== divider ====== */
                          .divider img {
                              width: 440px !important;
                          }
                          /*-------- container --------*/
                          .container590 {
                              width: 440px !important;
                          }
                          .container580 {
                              width: 400px !important;
                          }
                          .main-button {
                              width: 220px !important;
                          }
                          /*-------- secions ----------*/
                          .section-img img {
                              width: 320px !important;
                              height: auto !important;
                          }
                          .team-img img {
                              width: 100% !important;
                              height: auto !important;
                          }
                      }
              
                      @media only screen and (max-width: 479px) {
                          /*------ top header ------ */
                          .main-header {
                              font-size: 18px !important;
                          }
                          .main-section-header {
                              font-size: 26px !important;
                          }
                          /* ====== divider ====== */
                          .divider img {
                              width: 280px !important;
                          }
                          /*-------- container --------*/
                          .container590 {
                              width: 280px !important;
                          }
                          .container590 {
                              width: 280px !important;
                          }
                          .container580 {
                              width: 260px !important;
                          }
                          /*-------- secions ----------*/
                          .section-img img {
                              width: 280px !important;
                              height: auto !important;
                          }
                      }
                  </style>
                  <!-- [if gte mso 9]><style type=”text/css”>
                      body {
                      font-family: arial, sans-serif!important;
                      }
                      </style>
                  <![endif]-->
              </head>
              
              
              <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
                  <!-- pre-header -->
                  <table style='display:none!important;'>
                      <tr>
                          <td>
                              <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
                                  Pre-header for the newsletter template
                              </div>
                          </td>
                      </tr>
                  </table>
                  <!-- pre-header end -->
                  <!-- header -->
                  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
              
                      <tr>
                          <td align='center'>
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                  <tr>
                                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
              
                                          <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                              <tr>
                                                  <td align='center' height='70' style='height:17px;'>
                                                      <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png' alt='' /></a>
                                                  </td>
                                              </tr>
              
                                             
                                          </table>
                                      </td>
                                  </tr>
              
                                  
                              </table>
                          </td>
                      </tr>
                  </table>
                  <!-- end header -->
              
                  <!-- big image section -->
                  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
              
                      <tr>
                          <td align='center'>
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                  
                                  <tr>
                                      <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
                                          class='main-header'>
              
              
                                          <div style='line-height: 35px'>
              
                                              Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank ".$sender_account_holder_name."</span>
              
                                          </div>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
                                          <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
                                              <tr>
                                                  <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
                                          <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
                                              <tr>
                                                  <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
              
              
                                                      <div style='line-height: 24px'>
              
                                                         <h2>Funds transfered successfully from your account number to international account  </h2><span style='color: #FFD700;'> <b>".$receiver_account_number."</b></span> <br> !!! <h2>updated balance is </h2><span style='color: #FFD700;'><b>".$sender_new_balance."</b></span>  and transaction Ip address is <b>".$ip_address." </b> at time <b>".$timestamp."</b> <br>
                                                         
                                  
                                                         </div>
                                                  </td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td> 
                                  </tr>
              
                                 
              
                              </table>
              
                          </td>
                      </tr>
              
                      <tr class='hide'>
                          <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                      </tr>
                      <tr>
                          <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                      </tr>
              
                  </table>
                  <!-- end section -->
              
              
    
              
              
                  <!-- footer ====== -->
                  <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
              
                      <tr>
                          <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                      </tr>
              
                      <tr>
                          <td align='center'>
              
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                  <tr>
                                      <td>
                                          <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                              class='container590'>
                                              <tr>
                                                  <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                                                      <div style='line-height: 24px;'>
              
                                                          <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
              
                                                      </div>
                                                  </td>
                                              </tr>
                                          </table>
              
                                          
                                         
                                      </td>
                                  </tr>
              
                              </table>
                          </td>
                      </tr>
              
                      
              
                  </table>
                  <!-- end footer ====== -->
              
              </body>
              
              </html>";
                                        //whether ip is from share internet
    
    
              if (mail($to,$subject,$message,$headers,$additional_parameters)){
                //echo "Your Mail is sent successfully.";
                
    
                              
                                
              }
              else{
                //echo "Your Mail is not sent. Try Again.";
                $errors['mail'] = "mail not send";
              }
    
    
    
             
        }
        else{
            $errors['receiver_account_number'] = "receiver account number not exist!! please check again";
        }
        if($sql_sender_deduct){
        $receiver_new_balance=$receiver_balance+$transfer_amount;
        $update_receiver="update card_account_details set balance='$receiver_new_balance' where account_number='$receiver_account_number' and ifsc_code='$receiver_ifsc_code'";
        $sql3=mysqli_query($conn,$update_receiver);
        }
        if($sql3){
        
            $insert_receiver ="INSERT INTO `transactions` ( `tid_id`,`login_username`, `email_id`,`account_number`,`full_name`,`ifsc_code`,`transfer_amount`,`balance`,`ip_address`,`balance_type`,`transaction_time`,country) VALUES 
                                                          ('$tid_id','$receiver_login_username','$sender_email_id','$sender_account_number','$sender_account_holder_name','$sender_ifsc_code','$transfer_amount','$receiver_new_balance','$ip_address','credit','$timestamp','$sender_country')";
              $sql_receiver_added=mysqli_query($conn,$insert_receiver);
              $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
              'X-Mailer: PHP/' . phpversion()."\r\n" ;
    $headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
    $to = "$receiver_email_id";
    $additional_parameters = '-fsupport@smilewellnessfoundation.org';
    $subject = 'International Transaction happend Money credit';
              $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
              <html xmlns:v='urn:schemas-microsoft-com:vml'>
              
              <head>
                  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                  <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
                  <!--[if !mso]--><!-- -->
                  <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
                  <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
                  <!-- <![endif]-->
              
                  <title>Material Design for Bootstrap</title>
              
                  <style type='text/css'>
                      body {
                          width: 100%;
                          background-color: #ffffff;
                          margin: 0;
                          padding: 0;
                          -webkit-font-smoothing: antialiased;
                          mso-margin-top-alt: 0px;
                          mso-margin-bottom-alt: 0px;
                          mso-padding-alt: 0px 0px 0px 0px;
                      }
              
                      p,
                      h1,
                      h2,
                      h3,
                      h4 {
                          margin-top: 0;
                          margin-bottom: 0;
                          padding-top: 0;
                          padding-bottom: 0;
                      }
              
                      span.preheader {
                          display: none;
                          font-size: 1px;
                      }
              
                      html {
                          width: 100%;
                      }
              
                      table {
                          font-size: 14px;
                          border: 0;
                      }
                      /* ----------- responsivity ----------- */
              
                      @media only screen and (max-width: 640px) {
                          /*------ top header ------ */
                          .main-header {
                              font-size: 20px !important;
                          }
                          .main-section-header {
                              font-size: 28px !important;
                          }
                          .show {
                              display: block !important;
                          }
                          .hide {
                              display: none !important;
                          }
                          .align-center {
                              text-align: center !important;
                          }
                          .no-bg {
                              background: none !important;
                          }
                          /*----- main image -------*/
                          .main-image img {
                              width: 440px !important;
                              height: auto !important;
                          }
                          /* ====== divider ====== */
                          .divider img {
                              width: 440px !important;
                          }
                          /*-------- container --------*/
                          .container590 {
                              width: 440px !important;
                          }
                          .container580 {
                              width: 400px !important;
                          }
                          .main-button {
                              width: 220px !important;
                          }
                          /*-------- secions ----------*/
                          .section-img img {
                              width: 320px !important;
                              height: auto !important;
                          }
                          .team-img img {
                              width: 100% !important;
                              height: auto !important;
                          }
                      }
              
                      @media only screen and (max-width: 479px) {
                          /*------ top header ------ */
                          .main-header {
                              font-size: 18px !important;
                          }
                          .main-section-header {
                              font-size: 26px !important;
                          }
                          /* ====== divider ====== */
                          .divider img {
                              width: 280px !important;
                          }
                          /*-------- container --------*/
                          .container590 {
                              width: 280px !important;
                          }
                          .container590 {
                              width: 280px !important;
                          }
                          .container580 {
                              width: 260px !important;
                          }
                          /*-------- secions ----------*/
                          .section-img img {
                              width: 280px !important;
                              height: auto !important;
                          }
                      }
                  </style>
                  <!-- [if gte mso 9]><style type=”text/css”>
                      body {
                      font-family: arial, sans-serif!important;
                      }
                      </style>
                  <![endif]-->
              </head>
              
              
              <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
                  <!-- pre-header -->
                  <table style='display:none!important;'>
                      <tr>
                          <td>
                              <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
                                  Pre-header for the newsletter template
                              </div>
                          </td>
                      </tr>
                  </table>
                  <!-- pre-header end -->
                  <!-- header -->
                  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
              
                      <tr>
                          <td align='center'>
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                  <tr>
                                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
              
                                          <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                              <tr>
                                                  <td align='center' height='70' style='height:17px;'>
                                                      <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png' alt='' /></a>
                                                  </td>
                                              </tr>
              
                                             
                                          </table>
                                      </td>
                                  </tr>
              
                                  
                              </table>
                          </td>
                      </tr>
                  </table>
                  <!-- end header -->
              
                  <!-- big image section -->
                  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
              
                      <tr>
                          <td align='center'>
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                  
                                  <tr>
                                      <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
                                          class='main-header'>
              
              
                                          <div style='line-height: 35px'>
              
                                              Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank ".$receiver_account_holder_name."</span>
              
                                          </div>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
                                          <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
                                              <tr>
                                                  <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
                                          <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
                                              <tr>
                                                  <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
              
              
                                                      <div style='line-height: 24px'>
              
                                                         <h2>International Funds added successfully to your account number from </h2><span style='color: #FFD700;'> <b>".$sender_account_number."</b></span> <br> !!! <h2>updated balance is </h2><span style='color: #FFD700;'><b>".$receiver_new_balance."</b></span>  and transaction Ip address is <b>".$ip_address." </b> at time <b>".$timestamp."</b> <br>
                                                         
                                  
                                                         </div>
                                                  </td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td> 
                                  </tr>
              
                                 
              
                              </table>
              
                          </td>
                      </tr>
              
                      <tr class='hide'>
                          <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                      </tr>
                      <tr>
                          <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                      </tr>
              
                  </table>
                  <!-- end section -->
              
              
    
              
              
                  <!-- footer ====== -->
                  <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
              
                      <tr>
                          <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                      </tr>
              
                      <tr>
                          <td align='center'>
              
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                  <tr>
                                      <td>
                                          <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                              class='container590'>
                                              <tr>
                                                  <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                                                      <div style='line-height: 24px;'>
              
                                                          <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
              
                                                      </div>
                                                  </td>
                                              </tr>
                                          </table>
              
                                          
                                         
                                      </td>
                                  </tr>
              
                              </table>
                          </td>
                      </tr>
              
                      
              
                  </table>
                  <!-- end footer ====== -->
              
              </body>
              
              </html>";
                                        //whether ip is from share internet
    
    
              if (mail($to,$subject,$message,$headers,$additional_parameters)){
                //echo "Your Mail is sent successfully.";
    
               $showAlert=true;
                              
                                header('location:view_bank_balance.php');
              }
              else{
                //echo "Your Mail is not sent. Try Again.";
                $errors['mail'] = "mail not send";
              }
    
              
    
    
    
    
        }
    }
    else if($receiver_country!='india'){

        $sender_new_balance=$sender_balance-$transfer_amount;
        
        $update_sender="update card_account_details set balance='$sender_new_balance' where login_username='$login_username'";
        $sql2=mysqli_query($conn,$update_sender);
    if($sql2){
        
            $insert_sender ="INSERT INTO `transactions` ( `tid_id`,`login_username`, `email_id`,`account_number`,`full_name`,`ifsc_code`,`transfer_amount`,`balance`,`ip_address`,`balance_type`,`transaction_time`,country) VALUES 
                                                        ('$tid_id','$login_username','$receiver_email_id','$receiver_account_number','$receiver_account_holder_name','$receiver_ifsc_code','$transfer_amount','$sender_new_balance','$ip_address','debit','$timestamp','$receiver_country')";
    
              $sql_sender_deduct=mysqli_query($conn,$insert_sender);
    
              $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
              'X-Mailer: PHP/' . phpversion()."\r\n" ;
    $headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
    $to = "$sender_email_id";
    $additional_parameters = '-fsupport@smilewellnessfoundation.org';
    $subject = 'Alert International Transaction happend Money Debit  ';
              $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
              <html xmlns:v='urn:schemas-microsoft-com:vml'>
              
              <head>
                  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                  <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
                  <!--[if !mso]--><!-- -->
                  <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
                  <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
                  <!-- <![endif]-->
              
                  <title>Material Design for Bootstrap</title>
              
                  <style type='text/css'>
                      body {
                          width: 100%;
                          background-color: #ffffff;
                          margin: 0;
                          padding: 0;
                          -webkit-font-smoothing: antialiased;
                          mso-margin-top-alt: 0px;
                          mso-margin-bottom-alt: 0px;
                          mso-padding-alt: 0px 0px 0px 0px;
                      }
              
                      p,
                      h1,
                      h2,
                      h3,
                      h4 {
                          margin-top: 0;
                          margin-bottom: 0;
                          padding-top: 0;
                          padding-bottom: 0;
                      }
              
                      span.preheader {
                          display: none;
                          font-size: 1px;
                      }
              
                      html {
                          width: 100%;
                      }
              
                      table {
                          font-size: 14px;
                          border: 0;
                      }
                      /* ----------- responsivity ----------- */
              
                      @media only screen and (max-width: 640px) {
                          /*------ top header ------ */
                          .main-header {
                              font-size: 20px !important;
                          }
                          .main-section-header {
                              font-size: 28px !important;
                          }
                          .show {
                              display: block !important;
                          }
                          .hide {
                              display: none !important;
                          }
                          .align-center {
                              text-align: center !important;
                          }
                          .no-bg {
                              background: none !important;
                          }
                          /*----- main image -------*/
                          .main-image img {
                              width: 440px !important;
                              height: auto !important;
                          }
                          /* ====== divider ====== */
                          .divider img {
                              width: 440px !important;
                          }
                          /*-------- container --------*/
                          .container590 {
                              width: 440px !important;
                          }
                          .container580 {
                              width: 400px !important;
                          }
                          .main-button {
                              width: 220px !important;
                          }
                          /*-------- secions ----------*/
                          .section-img img {
                              width: 320px !important;
                              height: auto !important;
                          }
                          .team-img img {
                              width: 100% !important;
                              height: auto !important;
                          }
                      }
              
                      @media only screen and (max-width: 479px) {
                          /*------ top header ------ */
                          .main-header {
                              font-size: 18px !important;
                          }
                          .main-section-header {
                              font-size: 26px !important;
                          }
                          /* ====== divider ====== */
                          .divider img {
                              width: 280px !important;
                          }
                          /*-------- container --------*/
                          .container590 {
                              width: 280px !important;
                          }
                          .container590 {
                              width: 280px !important;
                          }
                          .container580 {
                              width: 260px !important;
                          }
                          /*-------- secions ----------*/
                          .section-img img {
                              width: 280px !important;
                              height: auto !important;
                          }
                      }
                  </style>
                  <!-- [if gte mso 9]><style type=”text/css”>
                      body {
                      font-family: arial, sans-serif!important;
                      }
                      </style>
                  <![endif]-->
              </head>
              
              
              <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
                  <!-- pre-header -->
                  <table style='display:none!important;'>
                      <tr>
                          <td>
                              <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
                                  Pre-header for the newsletter template
                              </div>
                          </td>
                      </tr>
                  </table>
                  <!-- pre-header end -->
                  <!-- header -->
                  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
              
                      <tr>
                          <td align='center'>
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                  <tr>
                                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
              
                                          <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                              <tr>
                                                  <td align='center' height='70' style='height:17px;'>
                                                      <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png' alt='' /></a>
                                                  </td>
                                              </tr>
              
                                             
                                          </table>
                                      </td>
                                  </tr>
              
                                  
                              </table>
                          </td>
                      </tr>
                  </table>
                  <!-- end header -->
              
                  <!-- big image section -->
                  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
              
                      <tr>
                          <td align='center'>
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                  
                                  <tr>
                                      <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
                                          class='main-header'>
              
              
                                          <div style='line-height: 35px'>
              
                                              Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank ".$sender_account_holder_name."</span>
              
                                          </div>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
                                          <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
                                              <tr>
                                                  <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
                                          <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
                                              <tr>
                                                  <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
              
              
                                                      <div style='line-height: 24px'>
              
                                                         <h2>Funds transfered successfully from your account number to </h2><span style='color: #FFD700;'> <b>".$receiver_account_number."</b></span> <br> !!! <h2>updated balance is </h2><span style='color: #FFD700;'><b>".$sender_new_balance."</b></span>  and transaction Ip address is <b>".$ip_address." </b> at time <b>".$timestamp."</b> <br>
                                                         
                                  
                                                         </div>
                                                  </td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td> 
                                  </tr>
              
                                 
              
                              </table>
              
                          </td>
                      </tr>
              
                      <tr class='hide'>
                          <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                      </tr>
                      <tr>
                          <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                      </tr>
              
                  </table>
                  <!-- end section -->
              
              
    
              
              
                  <!-- footer ====== -->
                  <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
              
                      <tr>
                          <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                      </tr>
              
                      <tr>
                          <td align='center'>
              
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                  <tr>
                                      <td>
                                          <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                              class='container590'>
                                              <tr>
                                                  <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                                                      <div style='line-height: 24px;'>
              
                                                          <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
              
                                                      </div>
                                                  </td>
                                              </tr>
                                          </table>
              
                                          
                                         
                                      </td>
                                  </tr>
              
                              </table>
                          </td>
                      </tr>
              
                      
              
                  </table>
                  <!-- end footer ====== -->
              
              </body>
              
              </html>";
                                        //whether ip is from share internet
    
    
              if (mail($to,$subject,$message,$headers,$additional_parameters)){
                //echo "Your Mail is sent successfully.";
                
    
                              
                                
              }
              else{
                //echo "Your Mail is not sent. Try Again.";
                $errors['mail'] = "mail not send";
              }
    
    
    
             
        }
        else{
            $errors['receiver_account_number'] = "receiver account number not exist!! please check again";
        }
        if($sql_sender_deduct){
        $receiver_new_balance=$receiver_balance+$transfer_amount;
        $update_receiver="update card_account_details set balance='$receiver_new_balance' where account_number='$receiver_account_number' and ifsc_code='$receiver_ifsc_code'";
        $sql3=mysqli_query($conn,$update_receiver);
        }
        if($sql3){ 
        
            $insert_receiver ="INSERT INTO `transactions` ( `tid_id`,`login_username`, `email_id`,`account_number`,`full_name`,`ifsc_code`,`transfer_amount`,`balance`,`ip_address`,`balance_type`,`transaction_time`,`country`) VALUES 
                                                          ('$tid_id','$receiver_login_username','$sender_email_id','$sender_account_number','$sender_account_holder_name','$sender_ifsc_code','$transfer_amount','$receiver_new_balance','$ip_address','credit','$timestamp','$sender_country')";
              $sql_receiver_added=mysqli_query($conn,$insert_receiver);
              $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
              'X-Mailer: PHP/' . phpversion()."\r\n" ;
    $headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
    $to = "$receiver_email_id";
    $additional_parameters = '-fsupport@smilewellnessfoundation.org';
    $subject = 'Transaction happend Money credit';
              $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
              <html xmlns:v='urn:schemas-microsoft-com:vml'>
              
              <head>
                  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                  <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
                  <!--[if !mso]--><!-- -->
                  <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
                  <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
                  <!-- <![endif]-->
              
                  <title>Material Design for Bootstrap</title>
              
                  <style type='text/css'>
                      body {
                          width: 100%;
                          background-color: #ffffff;
                          margin: 0;
                          padding: 0;
                          -webkit-font-smoothing: antialiased;
                          mso-margin-top-alt: 0px;
                          mso-margin-bottom-alt: 0px;
                          mso-padding-alt: 0px 0px 0px 0px;
                      }
              
                      p,
                      h1,
                      h2,
                      h3,
                      h4 {
                          margin-top: 0;
                          margin-bottom: 0;
                          padding-top: 0;
                          padding-bottom: 0;
                      }
              
                      span.preheader {
                          display: none;
                          font-size: 1px;
                      }
              
                      html {
                          width: 100%;
                      }
              
                      table {
                          font-size: 14px;
                          border: 0;
                      }
                      /* ----------- responsivity ----------- */
              
                      @media only screen and (max-width: 640px) {
                          /*------ top header ------ */
                          .main-header {
                              font-size: 20px !important;
                          }
                          .main-section-header {
                              font-size: 28px !important;
                          }
                          .show {
                              display: block !important;
                          }
                          .hide {
                              display: none !important;
                          }
                          .align-center {
                              text-align: center !important;
                          }
                          .no-bg {
                              background: none !important;
                          }
                          /*----- main image -------*/
                          .main-image img {
                              width: 440px !important;
                              height: auto !important;
                          }
                          /* ====== divider ====== */
                          .divider img {
                              width: 440px !important;
                          }
                          /*-------- container --------*/
                          .container590 {
                              width: 440px !important;
                          }
                          .container580 {
                              width: 400px !important;
                          }
                          .main-button {
                              width: 220px !important;
                          }
                          /*-------- secions ----------*/
                          .section-img img {
                              width: 320px !important;
                              height: auto !important;
                          }
                          .team-img img {
                              width: 100% !important;
                              height: auto !important;
                          }
                      }
              
                      @media only screen and (max-width: 479px) {
                          /*------ top header ------ */
                          .main-header {
                              font-size: 18px !important;
                          }
                          .main-section-header {
                              font-size: 26px !important;
                          }
                          /* ====== divider ====== */
                          .divider img {
                              width: 280px !important;
                          }
                          /*-------- container --------*/
                          .container590 {
                              width: 280px !important;
                          }
                          .container590 {
                              width: 280px !important;
                          }
                          .container580 {
                              width: 260px !important;
                          }
                          /*-------- secions ----------*/
                          .section-img img {
                              width: 280px !important;
                              height: auto !important;
                          }
                      }
                  </style>
                  <!-- [if gte mso 9]><style type=”text/css”>
                      body {
                      font-family: arial, sans-serif!important;
                      }
                      </style>
                  <![endif]-->
              </head>
              
              
              <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
                  <!-- pre-header -->
                  <table style='display:none!important;'>
                      <tr>
                          <td>
                              <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
                                  Pre-header for the newsletter template
                              </div>
                          </td>
                      </tr>
                  </table>
                  <!-- pre-header end -->
                  <!-- header -->
                  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
              
                      <tr>
                          <td align='center'>
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                  <tr>
                                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
              
                                          <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                              <tr>
                                                  <td align='center' height='70' style='height:17px;'>
                                                      <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png' alt='' /></a>
                                                  </td>
                                              </tr>
              
                                             
                                          </table>
                                      </td>
                                  </tr>
              
                                  
                              </table>
                          </td>
                      </tr>
                  </table>
                  <!-- end header -->
              
                  <!-- big image section -->
                  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
              
                      <tr>
                          <td align='center'>
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                  
                                  <tr>
                                      <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
                                          class='main-header'>
              
              
                                          <div style='line-height: 35px'>
              
                                              Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank ".$receiver_account_holder_name."</span>
              
                                          </div>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
                                          <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
                                              <tr>
                                                  <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
                                          <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
                                              <tr>
                                                  <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
              
              
                                                      <div style='line-height: 24px'>
              
                                                         <h2>Funds added successfully to your account number from </h2><span style='color: #FFD700;'> <b>".$sender_account_number."</b></span> <br> !!! <h2>updated balance is </h2><span style='color: #FFD700;'><b>".$receiver_new_balance."</b></span>  and transaction Ip address is <b>".$ip_address." </b> at time <b>".$timestamp."</b> <br>
                                                         
                                  
                                                         </div>
                                                  </td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td> 
                                  </tr>
              
                                 
              
                              </table>
              
                          </td>
                      </tr>
              
                      <tr class='hide'>
                          <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                      </tr>
                      <tr>
                          <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                      </tr>
              
                  </table>
                  <!-- end section -->
              
              
    
              
              
                  <!-- footer ====== -->
                  <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
              
                      <tr>
                          <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                      </tr>
              
                      <tr>
                          <td align='center'>
              
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                  <tr>
                                      <td>
                                          <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                              class='container590'>
                                              <tr>
                                                  <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                                                      <div style='line-height: 24px;'>
              
                                                          <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
              
                                                      </div>
                                                  </td>
                                              </tr>
                                          </table>
              
                                          
                                         
                                      </td>
                                  </tr>
              
                              </table>
                          </td>
                      </tr>
              
                      
              
                  </table>
                  <!-- end footer ====== -->
              
              </body>
              
              </html>";
                                        //whether ip is from share internet
    
    
              if (mail($to,$subject,$message,$headers,$additional_parameters)){
                //echo "Your Mail is sent successfully.";
    
               $showAlert=true;
                              
                                header('location:view_bank_balance.php');
              }
              else{
                //echo "Your Mail is not sent. Try Again.";
                $errors['mail'] = "mail not send";
              }
    
              
    
    
    
    
        }

        
    }
    else if ($sender_country!='india' and $receiver_country!='india'){
        $sender_new_balance=$sender_balance-$transfer_amount;
        
        $update_sender="update card_account_details set balance='$sender_new_balance' where login_username='$login_username'";
        $sql2=mysqli_query($conn,$update_sender);
    if($sql2){
        
            $insert_sender ="INSERT INTO `transactions` ( `tid_id`,`login_username`, `email_id`,`account_number`,`full_name`,`ifsc_code`,`transfer_amount`,`balance`,`ip_address`,`balance_type`,`transaction_time`,`country`) VALUES 
                                                        ('$tid_id','$login_username','$receiver_email_id','$receiver_account_number','$receiver_account_holder_name','$receiver_ifsc_code','$transfer_amount','$sender_new_balance','$ip_address','debit','$timestamp','$receiver_country')";
    
              $sql_sender_deduct=mysqli_query($conn,$insert_sender);
    
              $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
              'X-Mailer: PHP/' . phpversion()."\r\n" ;
    $headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
    $to = "$sender_email_id";
    $additional_parameters = '-fsupport@smilewellnessfoundation.org';
    $subject = 'Alert International Transaction happend Money Debit  ';
              $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
              <html xmlns:v='urn:schemas-microsoft-com:vml'>
              
              <head>
                  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                  <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
                  <!--[if !mso]--><!-- -->
                  <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
                  <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
                  <!-- <![endif]-->
              
                  <title>Material Design for Bootstrap</title>
              
                  <style type='text/css'>
                      body {
                          width: 100%;
                          background-color: #ffffff;
                          margin: 0;
                          padding: 0;
                          -webkit-font-smoothing: antialiased;
                          mso-margin-top-alt: 0px;
                          mso-margin-bottom-alt: 0px;
                          mso-padding-alt: 0px 0px 0px 0px;
                      }
              
                      p,
                      h1,
                      h2,
                      h3,
                      h4 {
                          margin-top: 0;
                          margin-bottom: 0;
                          padding-top: 0;
                          padding-bottom: 0;
                      }
              
                      span.preheader {
                          display: none;
                          font-size: 1px;
                      }
              
                      html {
                          width: 100%;
                      }
              
                      table {
                          font-size: 14px;
                          border: 0;
                      }
                      /* ----------- responsivity ----------- */
              
                      @media only screen and (max-width: 640px) {
                          /*------ top header ------ */
                          .main-header {
                              font-size: 20px !important;
                          }
                          .main-section-header {
                              font-size: 28px !important;
                          }
                          .show {
                              display: block !important;
                          }
                          .hide {
                              display: none !important;
                          }
                          .align-center {
                              text-align: center !important;
                          }
                          .no-bg {
                              background: none !important;
                          }
                          /*----- main image -------*/
                          .main-image img {
                              width: 440px !important;
                              height: auto !important;
                          }
                          /* ====== divider ====== */
                          .divider img {
                              width: 440px !important;
                          }
                          /*-------- container --------*/
                          .container590 {
                              width: 440px !important;
                          }
                          .container580 {
                              width: 400px !important;
                          }
                          .main-button {
                              width: 220px !important;
                          }
                          /*-------- secions ----------*/
                          .section-img img {
                              width: 320px !important;
                              height: auto !important;
                          }
                          .team-img img {
                              width: 100% !important;
                              height: auto !important;
                          }
                      }
              
                      @media only screen and (max-width: 479px) {
                          /*------ top header ------ */
                          .main-header {
                              font-size: 18px !important;
                          }
                          .main-section-header {
                              font-size: 26px !important;
                          }
                          /* ====== divider ====== */
                          .divider img {
                              width: 280px !important;
                          }
                          /*-------- container --------*/
                          .container590 {
                              width: 280px !important;
                          }
                          .container590 {
                              width: 280px !important;
                          }
                          .container580 {
                              width: 260px !important;
                          }
                          /*-------- secions ----------*/
                          .section-img img {
                              width: 280px !important;
                              height: auto !important;
                          }
                      }
                  </style>
                  <!-- [if gte mso 9]><style type=”text/css”>
                      body {
                      font-family: arial, sans-serif!important;
                      }
                      </style>
                  <![endif]-->
              </head>
              
              
              <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
                  <!-- pre-header -->
                  <table style='display:none!important;'>
                      <tr>
                          <td>
                              <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
                                  Pre-header for the newsletter template
                              </div>
                          </td>
                      </tr>
                  </table>
                  <!-- pre-header end -->
                  <!-- header -->
                  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
              
                      <tr>
                          <td align='center'>
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                  <tr>
                                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
              
                                          <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                              <tr>
                                                  <td align='center' height='70' style='height:17px;'>
                                                      <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png' alt='' /></a>
                                                  </td>
                                              </tr>
              
                                             
                                          </table>
                                      </td>
                                  </tr>
              
                                  
                              </table>
                          </td>
                      </tr>
                  </table>
                  <!-- end header -->
              
                  <!-- big image section -->
                  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
              
                      <tr>
                          <td align='center'>
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                  
                                  <tr>
                                      <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
                                          class='main-header'>
              
              
                                          <div style='line-height: 35px'>
              
                                              Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank ".$sender_account_holder_name."</span>
              
                                          </div>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
                                          <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
                                              <tr>
                                                  <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
                                          <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
                                              <tr>
                                                  <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
              
              
                                                      <div style='line-height: 24px'>
              
                                                         <h2>Funds transfered successfully from your account number to </h2><span style='color: #FFD700;'> <b>".$receiver_account_number."</b></span> <br> !!! <h2>updated balance is </h2><span style='color: #FFD700;'><b>".$sender_new_balance."</b></span>  and transaction Ip address is <b>".$ip_address." </b> at time <b>".$timestamp."</b> <br>
                                                         
                                  
                                                         </div>
                                                  </td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td> 
                                  </tr>
              
                                 
              
                              </table>
              
                          </td>
                      </tr>
              
                      <tr class='hide'>
                          <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                      </tr>
                      <tr>
                          <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                      </tr>
              
                  </table>
                  <!-- end section -->
              
              
    
              
              
                  <!-- footer ====== -->
                  <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
              
                      <tr>
                          <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                      </tr>
              
                      <tr>
                          <td align='center'>
              
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                  <tr>
                                      <td>
                                          <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                              class='container590'>
                                              <tr>
                                                  <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                                                      <div style='line-height: 24px;'>
              
                                                          <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
              
                                                      </div>
                                                  </td>
                                              </tr>
                                          </table>
              
                                          
                                         
                                      </td>
                                  </tr>
              
                              </table>
                          </td>
                      </tr>
              
                      
              
                  </table>
                  <!-- end footer ====== -->
              
              </body>
              
              </html>";
                                        //whether ip is from share internet
    
    
              if (mail($to,$subject,$message,$headers,$additional_parameters)){
                //echo "Your Mail is sent successfully.";
                
    
                              
                                
              }
              else{
                //echo "Your Mail is not sent. Try Again.";
                $errors['mail'] = "mail not send";
              }
    
    
    
             
        }
        else{
            $errors['receiver_account_number'] = "receiver account number not exist!! please check again";
        }
        if($sql_sender_deduct){
        $receiver_new_balance=$receiver_balance+$transfer_amount;
        $update_receiver="update card_account_details set balance='$receiver_new_balance' where account_number='$receiver_account_number' and ifsc_code='$receiver_ifsc_code'";
        $sql3=mysqli_query($conn,$update_receiver);
        }
        if($sql3){
        
            $insert_receiver ="INSERT INTO `transactions` ( `tid_id`,`login_username`, `email_id`,`account_number`,`full_name`,`ifsc_code`,`transfer_amount`,`balance`,`ip_address`,`balance_type`,`transaction_time`,`country`) VALUES 
                                                          ('$tid_id','$receiver_login_username','$sender_email_id','$sender_account_number','$sender_account_holder_name','$sender_ifsc_code','$transfer_amount','$receiver_new_balance','$ip_address','credit','$timestamp','$sender_country')";
              $sql_receiver_added=mysqli_query($conn,$insert_receiver);
              $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
              'X-Mailer: PHP/' . phpversion()."\r\n" ;
    $headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
    $to = "$receiver_email_id";
    $additional_parameters = '-fsupport@smilewellnessfoundation.org';
    $subject = 'Transaction happend Money credit';
              $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
              <html xmlns:v='urn:schemas-microsoft-com:vml'>
              
              <head>
                  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                  <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
                  <!--[if !mso]--><!-- -->
                  <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
                  <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
                  <!-- <![endif]-->
              
                  <title>Material Design for Bootstrap</title>
              
                  <style type='text/css'>
                      body {
                          width: 100%;
                          background-color: #ffffff;
                          margin: 0;
                          padding: 0;
                          -webkit-font-smoothing: antialiased;
                          mso-margin-top-alt: 0px;
                          mso-margin-bottom-alt: 0px;
                          mso-padding-alt: 0px 0px 0px 0px;
                      }
              
                      p,
                      h1,
                      h2,
                      h3,
                      h4 {
                          margin-top: 0;
                          margin-bottom: 0;
                          padding-top: 0;
                          padding-bottom: 0;
                      }
              
                      span.preheader {
                          display: none;
                          font-size: 1px;
                      }
              
                      html {
                          width: 100%;
                      }
              
                      table {
                          font-size: 14px;
                          border: 0;
                      }
                      /* ----------- responsivity ----------- */
              
                      @media only screen and (max-width: 640px) {
                          /*------ top header ------ */
                          .main-header {
                              font-size: 20px !important;
                          }
                          .main-section-header {
                              font-size: 28px !important;
                          }
                          .show {
                              display: block !important;
                          }
                          .hide {
                              display: none !important;
                          }
                          .align-center {
                              text-align: center !important;
                          }
                          .no-bg {
                              background: none !important;
                          }
                          /*----- main image -------*/
                          .main-image img {
                              width: 440px !important;
                              height: auto !important;
                          }
                          /* ====== divider ====== */
                          .divider img {
                              width: 440px !important;
                          }
                          /*-------- container --------*/
                          .container590 {
                              width: 440px !important;
                          }
                          .container580 {
                              width: 400px !important;
                          }
                          .main-button {
                              width: 220px !important;
                          }
                          /*-------- secions ----------*/
                          .section-img img {
                              width: 320px !important;
                              height: auto !important;
                          }
                          .team-img img {
                              width: 100% !important;
                              height: auto !important;
                          }
                      }
              
                      @media only screen and (max-width: 479px) {
                          /*------ top header ------ */
                          .main-header {
                              font-size: 18px !important;
                          }
                          .main-section-header {
                              font-size: 26px !important;
                          }
                          /* ====== divider ====== */
                          .divider img {
                              width: 280px !important;
                          }
                          /*-------- container --------*/
                          .container590 {
                              width: 280px !important;
                          }
                          .container590 {
                              width: 280px !important;
                          }
                          .container580 {
                              width: 260px !important;
                          }
                          /*-------- secions ----------*/
                          .section-img img {
                              width: 280px !important;
                              height: auto !important;
                          }
                      }
                  </style>
                  <!-- [if gte mso 9]><style type=”text/css”>
                      body {
                      font-family: arial, sans-serif!important;
                      }
                      </style>
                  <![endif]-->
              </head>
              
              
              <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
                  <!-- pre-header -->
                  <table style='display:none!important;'>
                      <tr>
                          <td>
                              <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
                                  Pre-header for the newsletter template
                              </div>
                          </td>
                      </tr>
                  </table>
                  <!-- pre-header end -->
                  <!-- header -->
                  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
              
                      <tr>
                          <td align='center'>
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                  <tr>
                                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
              
                                          <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                              <tr>
                                                  <td align='center' height='70' style='height:17px;'>
                                                      <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png' alt='' /></a>
                                                  </td>
                                              </tr>
              
                                             
                                          </table>
                                      </td>
                                  </tr>
              
                                  
                              </table>
                          </td>
                      </tr>
                  </table>
                  <!-- end header -->
              
                  <!-- big image section -->
                  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
              
                      <tr>
                          <td align='center'>
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                  
                                  <tr>
                                      <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
                                          class='main-header'>
              
              
                                          <div style='line-height: 35px'>
              
                                              Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank ".$receiver_account_holder_name."</span>
              
                                          </div>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
                                          <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
                                              <tr>
                                                  <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                  </tr>
              
                                  <tr>
                                      <td align='center'>
                                          <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
                                              <tr>
                                                  <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
              
              
                                                      <div style='line-height: 24px'>
              
                                                         <h2>Funds added successfully to your account number from </h2><span style='color: #FFD700;'> <b>".$sender_account_number."</b></span> <br> !!! <h2>updated balance is </h2><span style='color: #FFD700;'><b>".$receiver_new_balance."</b></span>  and transaction Ip address is <b>".$ip_address." </b> at time <b>".$timestamp."</b> <br>
                                                         
                                  
                                                         </div>
                                                  </td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
              
                                  <tr>
                                      <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td> 
                                  </tr>
              
                                 
              
                              </table>
              
                          </td>
                      </tr>
              
                      <tr class='hide'>
                          <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                      </tr>
                      <tr>
                          <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                      </tr>
              
                  </table>
                  <!-- end section -->
              
              
    
              
              
                  <!-- footer ====== -->
                  <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
              
                      <tr>
                          <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                      </tr>
              
                      <tr>
                          <td align='center'>
              
                              <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
              
                                  <tr>
                                      <td>
                                          <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                              class='container590'>
                                              <tr>
                                                  <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                                                      <div style='line-height: 24px;'>
              
                                                          <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
              
                                                      </div>
                                                  </td>
                                              </tr>
                                          </table>
              
                                          
                                         
                                      </td>
                                  </tr>
              
                              </table>
                          </td>
                      </tr>
              
                      
              
                  </table>
                  <!-- end footer ====== -->
              
              </body>
              
              </html>";
                                        //whether ip is from share internet
    
    
              if (mail($to,$subject,$message,$headers,$additional_parameters)){
                //echo "Your Mail is sent successfully.";
    
               $showAlert=true;
                              
                                header('location:view_bank_balance.php');
              }
              else{
                //echo "Your Mail is not sent. Try Again.";
                $errors['mail'] = "mail not send";
              }
    
              
    
    
    
    
        }
    }




// working fine below
    else{
	$sender_new_balance=$sender_balance-$transfer_amount;
	
	$update_sender="update card_account_details set balance='$sender_new_balance' where login_username='$login_username'";
	$sql2=mysqli_query($conn,$update_sender);
if($sql2){
	
        $insert_sender ="INSERT INTO `transactions` ( `tid_id`,`login_username`, `email_id`,`account_number`,`full_name`,`ifsc_code`,`transfer_amount`,`balance`,`ip_address`,`balance_type`,`transaction_time`,`country`) VALUES 
													('$tid_id','$login_username','$receiver_email_id','$receiver_account_number','$receiver_account_holder_name','$receiver_ifsc_code','$transfer_amount','$sender_new_balance','$ip_address','debit','$timestamp','$receiver_country')";

	  	$sql_sender_deduct=mysqli_query($conn,$insert_sender);

		  $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
		  'X-Mailer: PHP/' . phpversion()."\r\n" ;
$headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
$to = "$sender_email_id";
$additional_parameters = '-fsupport@smilewellnessfoundation.org';
$subject = 'Transaction happend Money Debit  ';
		  $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		  <html xmlns:v='urn:schemas-microsoft-com:vml'>
		  
		  <head>
			  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
			  <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
			  <!--[if !mso]--><!-- -->
			  <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
			  <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
			  <!-- <![endif]-->
		  
			  <title>Material Design for Bootstrap</title>
		  
			  <style type='text/css'>
				  body {
					  width: 100%;
					  background-color: #ffffff;
					  margin: 0;
					  padding: 0;
					  -webkit-font-smoothing: antialiased;
					  mso-margin-top-alt: 0px;
					  mso-margin-bottom-alt: 0px;
					  mso-padding-alt: 0px 0px 0px 0px;
				  }
		  
				  p,
				  h1,
				  h2,
				  h3,
				  h4 {
					  margin-top: 0;
					  margin-bottom: 0;
					  padding-top: 0;
					  padding-bottom: 0;
				  }
		  
				  span.preheader {
					  display: none;
					  font-size: 1px;
				  }
		  
				  html {
					  width: 100%;
				  }
		  
				  table {
					  font-size: 14px;
					  border: 0;
				  }
				  /* ----------- responsivity ----------- */
		  
				  @media only screen and (max-width: 640px) {
					  /*------ top header ------ */
					  .main-header {
						  font-size: 20px !important;
					  }
					  .main-section-header {
						  font-size: 28px !important;
					  }
					  .show {
						  display: block !important;
					  }
					  .hide {
						  display: none !important;
					  }
					  .align-center {
						  text-align: center !important;
					  }
					  .no-bg {
						  background: none !important;
					  }
					  /*----- main image -------*/
					  .main-image img {
						  width: 440px !important;
						  height: auto !important;
					  }
					  /* ====== divider ====== */
					  .divider img {
						  width: 440px !important;
					  }
					  /*-------- container --------*/
					  .container590 {
						  width: 440px !important;
					  }
					  .container580 {
						  width: 400px !important;
					  }
					  .main-button {
						  width: 220px !important;
					  }
					  /*-------- secions ----------*/
					  .section-img img {
						  width: 320px !important;
						  height: auto !important;
					  }
					  .team-img img {
						  width: 100% !important;
						  height: auto !important;
					  }
				  }
		  
				  @media only screen and (max-width: 479px) {
					  /*------ top header ------ */
					  .main-header {
						  font-size: 18px !important;
					  }
					  .main-section-header {
						  font-size: 26px !important;
					  }
					  /* ====== divider ====== */
					  .divider img {
						  width: 280px !important;
					  }
					  /*-------- container --------*/
					  .container590 {
						  width: 280px !important;
					  }
					  .container590 {
						  width: 280px !important;
					  }
					  .container580 {
						  width: 260px !important;
					  }
					  /*-------- secions ----------*/
					  .section-img img {
						  width: 280px !important;
						  height: auto !important;
					  }
				  }
			  </style>
			  <!-- [if gte mso 9]><style type=”text/css”>
				  body {
				  font-family: arial, sans-serif!important;
				  }
				  </style>
			  <![endif]-->
		  </head>
		  
		  
		  <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
			  <!-- pre-header -->
			  <table style='display:none!important;'>
				  <tr>
					  <td>
						  <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
							  Pre-header for the newsletter template
						  </div>
					  </td>
				  </tr>
			  </table>
			  <!-- pre-header end -->
			  <!-- header -->
			  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
		  
				  <tr>
					  <td align='center'>
						  <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
		  
							  <tr>
								  <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
							  </tr>
		  
							  <tr>
								  <td align='center'>
		  
									  <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
		  
										  <tr>
											  <td align='center' height='70' style='height:17px;'>
												  <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png' alt='' /></a>
											  </td>
										  </tr>
		  
										 
									  </table>
								  </td>
							  </tr>
		  
							  
						  </table>
					  </td>
				  </tr>
			  </table>
			  <!-- end header -->
		  
			  <!-- big image section -->
			  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
		  
				  <tr>
					  <td align='center'>
						  <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
							  
							  <tr>
								  <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
							  </tr>
							  <tr>
								  <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
									  class='main-header'>
		  
		  
									  <div style='line-height: 35px'>
		  
										  Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank ".$sender_account_holder_name."</span>
		  
									  </div>
								  </td>
							  </tr>
		  
							  <tr>
								  <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
							  </tr>
		  
							  <tr>
								  <td align='center'>
									  <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
										  <tr>
											  <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
										  </tr>
									  </table>
								  </td>
							  </tr>
		  
							  <tr>
								  <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
							  </tr>
		  
							  <tr>
								  <td align='center'>
									  <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
										  <tr>
											  <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
		  
		  
												  <div style='line-height: 24px'>
		  
													 <h2>Funds transfered successfully from your account number to </h2><span style='color: #FFD700;'> <b>".$receiver_account_number."</b></span> <br> !!! <h2>updated balance is </h2><span style='color: #FFD700;'><b>".$sender_new_balance."</b></span>  and transaction Ip address is <b>".$ip_address." </b> at time <b>".$timestamp."</b> <br>
													 
							  
													 </div>
											  </td>
										  </tr>
									  </table>
								  </td>
							  </tr>
		  
							  <tr>
								  <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td> 
							  </tr>
		  
							 
		  
						  </table>
		  
					  </td>
				  </tr>
		  
				  <tr class='hide'>
					  <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
				  </tr>
				  <tr>
					  <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
				  </tr>
		  
			  </table>
			  <!-- end section -->
		  
		  

		  
		  
			  <!-- footer ====== -->
			  <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
		  
				  <tr>
					  <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
				  </tr>
		  
				  <tr>
					  <td align='center'>
		  
						  <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
		  
							  <tr>
								  <td>
									  <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
										  class='container590'>
										  <tr>
											  <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
												  <div style='line-height: 24px;'>
		  
													  <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
		  
												  </div>
											  </td>
										  </tr>
									  </table>
		  
									  
									 
								  </td>
							  </tr>
		  
						  </table>
					  </td>
				  </tr>
		  
				  
		  
			  </table>
			  <!-- end footer ====== -->
		  
		  </body>
		  
		  </html>";
									//whether ip is from share internet


		  if (mail($to,$subject,$message,$headers,$additional_parameters)){
			//echo "Your Mail is sent successfully.";
            

						  
							
		  }
		  else{
			//echo "Your Mail is not sent. Try Again.";
			$errors['mail'] = "mail not send";
		  }



		 
	}
	else{
		$errors['receiver_account_number'] = "receiver account number not exist!! please check again";
	}
	if($sql_sender_deduct){
	$receiver_new_balance=$receiver_balance+$transfer_amount;
	$update_receiver="update card_account_details set balance='$receiver_new_balance' where account_number='$receiver_account_number' and ifsc_code='$receiver_ifsc_code'";
	$sql3=mysqli_query($conn,$update_receiver);
	}
	if($sql3){
	
        $insert_receiver ="INSERT INTO `transactions` ( `tid_id`,`login_username`, `email_id`,`account_number`,`full_name`,`ifsc_code`,`transfer_amount`,`balance`,`ip_address`,`balance_type`,`transaction_time`,`country`) VALUES 
													  ('$tid_id','$receiver_login_username','$sender_email_id','$sender_account_number','$sender_account_holder_name','$sender_ifsc_code','$transfer_amount','$receiver_new_balance','$ip_address','credit','$timestamp','$country')";
	  	$sql_receiver_added=mysqli_query($conn,$insert_receiver);
		  $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
		  'X-Mailer: PHP/' . phpversion()."\r\n" ;
$headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
$to = "$receiver_email_id";
$additional_parameters = '-fsupport@smilewellnessfoundation.org';
$subject = 'Transaction happend Money credit';
		  $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		  <html xmlns:v='urn:schemas-microsoft-com:vml'>
		  
		  <head>
			  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
			  <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
			  <!--[if !mso]--><!-- -->
			  <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
			  <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
			  <!-- <![endif]-->
		  
			  <title>Material Design for Bootstrap</title>
		  
			  <style type='text/css'>
				  body {
					  width: 100%;
					  background-color: #ffffff;
					  margin: 0;
					  padding: 0;
					  -webkit-font-smoothing: antialiased;
					  mso-margin-top-alt: 0px;
					  mso-margin-bottom-alt: 0px;
					  mso-padding-alt: 0px 0px 0px 0px;
				  }
		  
				  p,
				  h1,
				  h2,
				  h3,
				  h4 {
					  margin-top: 0;
					  margin-bottom: 0;
					  padding-top: 0;
					  padding-bottom: 0;
				  }
		  
				  span.preheader {
					  display: none;
					  font-size: 1px;
				  }
		  
				  html {
					  width: 100%;
				  }
		  
				  table {
					  font-size: 14px;
					  border: 0;
				  }
				  /* ----------- responsivity ----------- */
		  
				  @media only screen and (max-width: 640px) {
					  /*------ top header ------ */
					  .main-header {
						  font-size: 20px !important;
					  }
					  .main-section-header {
						  font-size: 28px !important;
					  }
					  .show {
						  display: block !important;
					  }
					  .hide {
						  display: none !important;
					  }
					  .align-center {
						  text-align: center !important;
					  }
					  .no-bg {
						  background: none !important;
					  }
					  /*----- main image -------*/
					  .main-image img {
						  width: 440px !important;
						  height: auto !important;
					  }
					  /* ====== divider ====== */
					  .divider img {
						  width: 440px !important;
					  }
					  /*-------- container --------*/
					  .container590 {
						  width: 440px !important;
					  }
					  .container580 {
						  width: 400px !important;
					  }
					  .main-button {
						  width: 220px !important;
					  }
					  /*-------- secions ----------*/
					  .section-img img {
						  width: 320px !important;
						  height: auto !important;
					  }
					  .team-img img {
						  width: 100% !important;
						  height: auto !important;
					  }
				  }
		  
				  @media only screen and (max-width: 479px) {
					  /*------ top header ------ */
					  .main-header {
						  font-size: 18px !important;
					  }
					  .main-section-header {
						  font-size: 26px !important;
					  }
					  /* ====== divider ====== */
					  .divider img {
						  width: 280px !important;
					  }
					  /*-------- container --------*/
					  .container590 {
						  width: 280px !important;
					  }
					  .container590 {
						  width: 280px !important;
					  }
					  .container580 {
						  width: 260px !important;
					  }
					  /*-------- secions ----------*/
					  .section-img img {
						  width: 280px !important;
						  height: auto !important;
					  }
				  }
			  </style>
			  <!-- [if gte mso 9]><style type=”text/css”>
				  body {
				  font-family: arial, sans-serif!important;
				  }
				  </style>
			  <![endif]-->
		  </head>
		  
		  
		  <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
			  <!-- pre-header -->
			  <table style='display:none!important;'>
				  <tr>
					  <td>
						  <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
							  Pre-header for the newsletter template
						  </div>
					  </td>
				  </tr>
			  </table>
			  <!-- pre-header end -->
			  <!-- header -->
			  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
		  
				  <tr>
					  <td align='center'>
						  <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
		  
							  <tr>
								  <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
							  </tr>
		  
							  <tr>
								  <td align='center'>
		  
									  <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
		  
										  <tr>
											  <td align='center' height='70' style='height:17px;'>
												  <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png' alt='' /></a>
											  </td>
										  </tr>
		  
										 
									  </table>
								  </td>
							  </tr>
		  
							  
						  </table>
					  </td>
				  </tr>
			  </table>
			  <!-- end header -->
		  
			  <!-- big image section -->
			  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
		  
				  <tr>
					  <td align='center'>
						  <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
							  
							  <tr>
								  <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
							  </tr>
							  <tr>
								  <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
									  class='main-header'>
		  
		  
									  <div style='line-height: 35px'>
		  
										  Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank ".$receiver_account_holder_name."</span>
		  
									  </div>
								  </td>
							  </tr>
		  
							  <tr>
								  <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
							  </tr>
		  
							  <tr>
								  <td align='center'>
									  <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
										  <tr>
											  <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
										  </tr>
									  </table>
								  </td>
							  </tr>
		  
							  <tr>
								  <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
							  </tr>
		  
							  <tr>
								  <td align='center'>
									  <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
										  <tr>
											  <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
		  
		  
												  <div style='line-height: 24px'>
		  
													 <h2>Funds added successfully to your account number from </h2><span style='color: #FFD700;'> <b>".$sender_account_number."</b></span> <br> !!! <h2>updated balance is </h2><span style='color: #FFD700;'><b>".$receiver_new_balance."</b></span>  and transaction Ip address is <b>".$ip_address." </b> at time <b>".$timestamp."</b> <br>
													 
							  
													 </div>
											  </td>
										  </tr>
									  </table>
								  </td>
							  </tr>
		  
							  <tr>
								  <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td> 
							  </tr>
		  
							 
		  
						  </table>
		  
					  </td>
				  </tr>
		  
				  <tr class='hide'>
					  <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
				  </tr>
				  <tr>
					  <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
				  </tr>
		  
			  </table>
			  <!-- end section -->
		  
		  

		  
		  
			  <!-- footer ====== -->
			  <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
		  
				  <tr>
					  <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
				  </tr>
		  
				  <tr>
					  <td align='center'>
		  
						  <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
		  
							  <tr>
								  <td>
									  <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
										  class='container590'>
										  <tr>
											  <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
												  <div style='line-height: 24px;'>
		  
													  <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
		  
												  </div>
											  </td>
										  </tr>
									  </table>
		  
									  
									 
								  </td>
							  </tr>
		  
						  </table>
					  </td>
				  </tr>
		  
				  
		  
			  </table>
			  <!-- end footer ====== -->
		  
		  </body>
		  
		  </html>";
									//whether ip is from share internet


		  if (mail($to,$subject,$message,$headers,$additional_parameters)){
			//echo "Your Mail is sent successfully.";

		   $showAlert=true;
						  
							header('location:view_bank_balance.php');
		  }
		  else{
			//echo "Your Mail is not sent. Try Again.";
			$errors['mail'] = "mail not send";
		  }

		  




	}
}
}



		}
		else{
			$errors['transaction_pin']="transaction_pin didnt match";
		}
	}
}
}
}
		
	}
}




?>
	

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Tansfer Money </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php require 'nav.php' ?>


    
<br><br><br>

<div class="container">
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card" style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
                            <img src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/deposit.png'  alt='Admin' class='rounded-circle bg-dark' width='110'>
								<div class="mt-3">
		
									 <h4>account number <?php echo $account_number?></h4>
									 <p class="text-secondary mb-1"><b>ifsc code:</b><?php echo $ifsc_code?></p>
                                     <p class="text-secondary mb-1"><b>balance:</b><?php echo $current_balance?></p>
								
								
				
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card" style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<form action="#" method="post">

							<?php               
                    if($showAlert){
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>transaction successful</strong> '. $showError.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
            }
				 if(count($errors) == 1){
					 ?>
					 <div class="alert alert-danger text-center">
						 <?php
						 foreach($errors as $showerror){
							 echo $showerror;
						 }
						 ?>
					 </div>
					 <?php
				 }elseif(count($errors) > 1){
					 ?>
					 <div class="alert alert-danger">
						 <?php
						 foreach($errors as $showerror){
							 ?>
							 <li><?php echo $showerror; ?></li>
							 <?php
						 }
						 ?>
					 </div>
					 <?php
				 }
				 ?>
                           



							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0" >tid id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <?php $tid_id= rand(999999, 111111);?>
									<input type="text" class="form-control" value="<?php echo $tid_id?>" name="tid_id"id="tid_id" readonly>
								</div>
		
							</div>
							
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">receiver account number</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter account number" name="account_number" id="account_number" required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">receiver account holder name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter account holder name" name="full_name" id="full_name" required>
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">receiver ifsc code</h6>
								</div>
							<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter ifsc code" name="ifsc_code" id="ifsc_code" required> 
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">country</h6>
								</div>
							<div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control " name="country" id="country" placeholder="country"required style='text-transform:lowercase;'>
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">amount</h6>
								</div>
							<div class="col-sm-9 text-secondary">
                            <input type="number" class="form-control" name="transfer_amount" id="transfer_amount" pattern="[0-9]+" title="Please enter a positive number" required>
								</div>
							</div>


							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">transaction pin</h6>
								</div>
							<div class="col-sm-9 text-secondary">
                            <input type="password" class="form-control" name="transaction_pin" id="transaction_pin" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^\w\s]).{8,}" title="Please enter one uppercase,one digit,one symbol with minmun length 8" required>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="transfer now"  required>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br>

<style type="text/css">
body{
    background: #f7f7ff !important;
   
}

.me-2 {
    margin-right: .5rem!important;
}
</style>


	

</script>
</body>
</html>