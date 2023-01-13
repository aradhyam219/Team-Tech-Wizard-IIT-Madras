<?php
session_start();
 include 'dbconnect.php';

$showAlert = false;
$showError = false;
$showAlert1 = false;
$showError1 = false;
$showError2 = false;
$showError3 = false;
$showError4 = false;
$showError5 = false;
$showError6 = false;
$errors = array();
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
	$full_name = $_POST["full_name"];
    $login_username = $_POST["login_username"];
    $email_id=$_POST["email_id"];
    $Mno=$_POST["Mno"];
    $password=$_POST["password"];
    $account_type=$_POST["account_type"];
    $aadhar_card=$_POST["aadhar_card"];
    $pan_card=$_POST["pan_card"];
    $cpassword = $_POST["cpassword"];
    $branch_name=$_POST["branch_name"];
    $ifsc_code=$_POST["ifsc_code"];
    $country=$_POST["country"];
    



    // $exists=false;

    //Check whether this email exists
    $sql_email_id = "SELECT * FROM `application` WHERE email_id = '$email_id'";
    $sql_login_username = "SELECT * FROM `application` WHERE login_username = '$login_username'";
    $sql_Mno = "SELECT * FROM `application` WHERE email_id = '$Mno'";
    $sql_aadhar_card = "SELECT * FROM `application` WHERE aadhar_card = '$aadhar_card'";
    $sql_pan_card = "SELECT * FROM `application` WHERE pan_card = '$pan_card'";
    $result_email_id=mysqli_query($conn, $sql_email_id) or die (mysqli_error($conn));
    $result_login_username=mysqli_query($conn, $sql_login_username) or die (mysqli_error($conn));
    $result_Mno=mysqli_query($conn, $sql_Mno) or die (mysqli_error($conn));
    $result_aadhar_card=mysqli_query($conn, $sql_aadhar_card) or die (mysqli_error($conn));
    $result_pan_card=mysqli_query($conn, $sql_pan_card) or die (mysqli_error($conn));
    $numExistRows = mysqli_num_rows($result_login_username);
    $numExistRows1 = mysqli_num_rows($result_email_id);
    $numExistRows2 = mysqli_num_rows($result_Mno);
    $numExistRows3 = mysqli_num_rows($result_aadhar_card);
    $numExistRows4 = mysqli_num_rows($result_pan_card);




 
    
    if($numExistRows > 0){
        // $exists = true;
       $errors['login_username'] = "Username  that you have entered is already exist!";
    }
    if($numExistRows1 > 0){
        // $exists = true;
        $errors['email_id'] = "Email that you have entered is already exist!";
    }
    if($numExistRows2 > 0){
        // $exists = true;
        $errors['Mno'] = "Mobile Number that you have entered is already exist!";
    }
    if($numExistRows3 > 0){
        // $exists = true;
        $errors['aadhar_card'] = "aadhar_card that you have entered is already exist!";
    }
    if($numExistRows4 > 0){
        // $exists = true;
       $errors['pan_card'] = "pan_card that you have entered is already exist!";
    }
?>
                    
        
    <?php
        // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $token= rand(999999, 111111);
            $ip_address = $_SERVER['REMOTE_ADDR'];

            date_default_timezone_set('Asia/Kolkata');
            $timestamp = date("Y-m-d H:i:s");
            $aadhar_card= chunk_split($aadhar_card, 4, ' ');
            
            $sql = "INSERT INTO `application` ( `full_name`,`login_username`, `email_id`,`Mno`,`password`,`account_type`,`branch_name`,`ifsc_code`,`country`,`token`,`aadhar_card`,`pan_card`,`apply_time`) VALUES ('$full_name','$login_username','$email_id','$Mno','$hash','$account_type','$branch_name','$ifsc_code','$country','$token','$aadhar_card','$pan_card', '$timestamp')";
            $result = mysqli_query($conn, $sql);
                 if ($result){
                    
                    $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
                    'X-Mailer: PHP/' . phpversion()."\r\n" ;
$headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
$to = "$email_id";
$additional_parameters = '-fsupport@smilewellnessfoundation.org';
$subject = "Application Verification Code";
                    $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                    <html xmlns:v='urn:schemas-microsoft-com:vml'>
                    
                    <head>
                        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                        <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
                        <!--[if !mso]--><!-- -->
                        <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
                        <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
                        <!-- <![endif]-->
                    
                        <title>apply with us</title>
                    
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
                    
                                                    Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank ".$full_name."</span>
                    
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
                    
                                                               Thank you for choosing us !!! Verification code is  ".$token." and  Ip address is ".$ip_address."  at time ".$timestamp." <br>
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
                    
                            
                            <tr>
                                <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                            </tr>
                    
                        </table>
                        <!-- end section -->
                    
                    
                    
                        
                    
                    
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
                    
                                               Your Login Credential for net banking  <span style='color: #FFD700;'>Tech Wizard Bank</span>
                    
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
                    
                                                           Hello ".$full_name." <br>Thank you for choosing us  !!! Here is your Net banking credentials 
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
                    
                    <table border='0' align='center' width='50%' cellpadding='0' cellspacing='0' bgcolor='#FFD700'>
                        <tr>
                            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                        </tr>
                        <tr>
                            <td align='center'>
                    
                                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                    <tr>
                                        <td align='center'>
                                            <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                                <tr>
                                                    <td>            
                                                        <table border='0' align='left' cellpadding='10' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                                class='container590'>
                                                <tr>
                                                            <td align='left' style='color: black; font-size: 20px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'
                                                                class='align-center'>            
                                                                <div style='line-height: 24px'>
                                                                    <strong>Login Username:</strong><br><p> ".$login_username."</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border='0' width='280' align='right' cellpadding='10' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                            class='container590'>
                                            <tr>
                                                <td align='left' style='color: black; font-size: 20px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'
                                                    class='align-center'>
                                                    <div style='line-height: 24px'>
                                                        <strong> Login  Password:</strong><br> <p>".$password."</p>
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
                            </td>
                        </tr>
                    
                        <tr>
                            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                        </tr>
                        
                    
                        
                    
                    
                    </table>
                    
                    <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
                    
                        
                                    
                    
                                  
                    
                                   
                    
                    t
                                    <tr>
                                        <td align='center'>
                                            <table border='0' align='center' width='160' cellpadding='0' cellspacing='0' bgcolor='5caad2' style=''>
                    
                                                <tr>
                                                    <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                                </tr>
                    
                                                <tr>
                                                    <td align='center' style='color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;'>
                    
                    
                                                        <div style='line-height: 26px;'>
                                                            <a href='https://smilewellnessfoundation.org/hackathon_iitmadras/net_banking_login.php' style='color: #ffffff; text-decoration: none;'>LOGIN NOW</a>
                                                        </div>
                                                    </td>
                                                </tr>
                    
                                                <tr>
                                                    <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                                </tr>
                    
                                            </table>
                                        </td>
                                    </tr>
                    
                    
                                </table>
                    
                            </td>
                        </tr>
                    
                        
                        
                    
                    </table>
                    
                    <table>
                        <tr>
                            <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                        </tr>
                    </table>
                    
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
                    
                    




                    if (mail($to,$subject,$message,$headers,$additional_parameters)){
                      //echo "Your Mail is sent successfully.";
                      $info = "We've sent a verification code to your email - $email_id";
                                    $_SESSION['info'] = $info;
                                    $_SESSION['login_username'] = $login_username;
                                    $_SESSION['password'] = $password;
                      header('location:user-otp.php');
                    }
                    else{
                      //echo "Your Mail is not sent. Try Again.";
                      $errors['mail'] = "mail not send";
                    }
                    //     $slowAlert1=false;
                    //     $showError1 = false;
                    // }
                    
            }
     
        }
        
       
    if($password != $cpassword){
        $errors['password'] = "Confirm password not matched!";
        
}

       
}

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title>Apply with us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="mt-5 pt-5 pl-3" style="background:white">


<!--card started outer 1-->
<div class="card col-lg-11 ml-5 pb-5 " style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" >
	<!--container start-->
<div class="container ">
		<div class="main-body">
			<div class="row">
				
					<!--card image card -->
					
						<div class="card-body ml-2">
							<div class="d-flex flex-column align-items-center text-left">
								<div class="col-lg-12 mt-5">
								<img src="http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png" alt="Admin" class="rounded-circle  bg-transparent" height="200" width="300" style="margin-top:50%">
								
							</div>
						</div>
							
							
						</div>
					
				
				<!--card style ended-->
				<div class="col-lg-8 mt-5">
					<!--card form-->
					<div class="card"  style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
					-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" >
					
						
						
						<div class="card-body">
						    
   
                    
							<form action="apply_with_us.php" method="POST">
							    
							    <?php if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! Account created Sucessfully</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';}
    if($showAlert1){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Email send succesfully!</strong> 
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
									<h6 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="Enter your name" name="full_name" id="full_name" required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">login_username</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control"   name="login_username" id="login_username" placeholder="Enter login username"  required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="email" class="form-control" name="email_id" id="email_id" paceholder="example@gmail.com" required>
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Mobile Number</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="Mno" id="Mno" placeholder="enter your number" pattern="[0-9]{10}" title="Please enter a valid 10-digit mobile number." required  >
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="password" id="password" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^\w\s]).{8,}" title="Please enter one uppercase,one digit,one symbol with minmun length 8" required >
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">confirm password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="cpassword" id="cpassword" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^\w\s]).{8,}" title="Please enter one uppercase,one digit,one symbol with minmun length 8" required >
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">account type</h6>
								</div>
								<div class="col-sm-9 text-secondary">
								<select name="account_type" class="form-control" id="account_type" required>
                                	<?php 
									$sql_option="select * from account_category where service_available='available'";
									$select_sql2 = mysqli_query($conn,$sql_option);
									while($row4 = mysqli_fetch_assoc($select_sql2)){?>
									
										 <option value= "<?php echo $row4['account_type']?>"><?php echo $row4['account_type']?></option>;
									
									<?php
									}
									?>
								
         							</select>
								</div>
							</div>




                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Branch Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
								<select name="branch_name" class="form-control" id="branch_name" title="choose the branch you want to open your account"required >
                                	<?php 
									$sql_option="select * from branch_detail where service_available='available' ";
									$select_sql2 = mysqli_query($conn,$sql_option);
									while($row3 = mysqli_fetch_assoc($select_sql2)){?>
									
										 <option value= "<?php echo $row3['branch_name']?>"><?php echo $row3['branch_name']?></option>;
									
									<?php
									}
									?>
								
         							</select>
								</div>
							</div>




                            
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">IFSC Code</h6>
								</div>
								<div class="col-sm-9 text-secondary">
								<select name="ifsc_code" class="form-control" id="ifsc_code" title="here branch name is displayed to know what is the ifsc code of each branch"required>
                                	<?php 
									$sql_option="select * from branch_detail where service_available='available' ";
									$select_sql2 = mysqli_query($conn,$sql_option);
									while($row5 = mysqli_fetch_assoc($select_sql2)){
									 $branch_name=$row5['branch_name'];
                                        $ifsc_code=$row5['ifsc_code'];?>
										 <option value= "<?php  echo $ifsc_code ?>"><?php  echo $branch_name.' '.$ifsc_code ; ?></option>;
									
									<?php
									}
									?>
								
         							</select>
								</div>
							</div>



                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">country</h6>
								</div>
								<div class="col-sm-9 text-secondary">
								<select name="country" class="form-control" id="country" required>
                                	<?php 
									$sql_option="select distinct country from branch_detail ";
									$select_sql2 = mysqli_query($conn,$sql_option);
									while($row6 = mysqli_fetch_assoc($select_sql2)){?>
									
										 <option value= "<?php echo $row6['country']?>"><?php echo $row6['country']?></option>;
									
									<?php
									}
									?>
								
         							</select>
								</div>
							</div>


                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">aadhar card</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="aadhar_card" id="aadhar_card" max-length="12" placeholder="aadhar card without space" required>
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Pan card</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="pan_card" id="pan_card" max-length="10" placeholder="pan card" required>
								</div>
							</div>




							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="apply Now">
                                    
								</div>
							</div>
						</div>
						</form>
						
					</div>
					
				</div>
			</div>
            
			<!--row ended-->
		</div>
	</div>

</div>
<br><br>

<style type="text/css">
body{

    margin-top:20px;
}


</style>

<script type="text/javascript">

</script>
</body>
</html>