<?php
$showAlert=false;
$errors = array();
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location:login.php");
    exit;
}
include "dbconnect.php";
$application_id=$_GET['application_id'];
$admin_username=$_SESSION['admin_username'];


$select_display= "select * from admin where admin_username='$admin_username'" ;
$select_sql1 = mysqli_query($conn,$select_display);
while($row1 = mysqli_fetch_array($select_sql1)){
$admin_username=$row1[1];

}


$select_username= "select * from application where application_id='$application_id'" ;
$select_username_sql= mysqli_query($conn,$select_username);
while($row2 = mysqli_fetch_array($select_username_sql)){
$application_id=$row2[0];
$login_username=$row2[1];
$full_name=$row2[2];
$email_id=$row2[3];
$Mno=$row2[4];
$password=$row2[5];
$branch_name=$row2[7];
$ifsc_code=$row2[8];
$country=$row2[9];

}


if(isset($_POST['generate'])){
    include 'dbconnect.php';
	

	
    
    
   

	$account_number= rand(9999999999,1000000000);
	$debit_card=rand(1000000000000000, 9999999999999999); // generates a 16-digit random number
	$debit_card = chunk_split($debit_card, 4, ' ');
	$validity = mt_rand(01, 12) . '/' . mt_rand(22, 23); 
	// prints the 4-digit validity with a slash after the first 2 digits
	$expiry = mt_rand(01, 12) . '/' . mt_rand(28, 30);
	$cvv= rand(111,999);
	// transaction pin



    function generatePassword() {
	$uppercase_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$lowercase_letters = 'abcdefghijklmnopqrstuvwxyz';
$symbols = '!@#$%^&*';
$numbers = '0123456789';

// create an array with the characters to use in the pin
$characters = str_split($uppercase_letters . $lowercase_letters . $symbols . $numbers);

// shuffle the array to randomize the characters
shuffle($characters);

// create an empty string to store the pin
$hash = '';


// loop through the array and add 1 of each type of character to the pin
for ($i = 0; $i < 1; $i++) {
    $hash .= $uppercase_letters[mt_rand(0, strlen($uppercase_letters) - 1)];
    
}
for ($i = 0; $i < 6; $i++) {
    
    $hash .= $lowercase_letters[mt_rand(0, strlen($lowercase_letters) - 1)];
   }

for ($i = 0; $i < 3; $i++) {
    $hash .= $numbers[mt_rand(0, strlen($numbers) - 1)];
     
}
for ($i = 0; $i < 1; $i++) {
   
      $hash .= $symbols[mt_rand(0, strlen($symbols) - 1)];
}

return $hash;
    }
$hash = generatePassword();
$transaction_pin=password_hash($hash, PASSWORD_DEFAULT);


$sql_check = "SELECT * from  `card_account_details` where login_username='$login_username'";

            
            $result_check = mysqli_query($conn, $sql_check);  
			$numExistRows = mysqli_num_rows($result_check); 
			if ($numExistRows > 0){
				$errors['login_username'] = "Card already generated for $login_username";
			}
			else{
            
            
            $sql = "INSERT INTO `card_account_details`(`login_username`,`full_name`,`email_id`, `account_number`, `debit_card`, `validity`, `expiry`,`cvv`,`branch_name`,`ifsc_code`,`country`,`transaction_pin`,`balance`) values('$login_username','$full_name','$email_id', '$account_number', '$debit_card', '$validity','$expiry','$cvv','$branch_name','$ifsc_code','$country',2000)";
            
            $result= mysqli_query($conn, $sql); 
			$showAlert=true;
			if($result){
                $sql_update="UPDATE application set permission='approved' where login_username='$login_username'";
				$result_update= mysqli_query($conn, $sql_update);
            

           
            

                $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
                    'X-Mailer: PHP/' . phpversion();
$headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$to = "$email_id";
$additional_parameters = '-fsupport@smilewellnessfoundation.org';
$sub = "Bank Account  details ";
$msg="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
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
            cellpadding=20 !important;
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
                    Application Update
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

                                Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank</span>

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

                                           Thank you for choosing us !!! bank account details ".$full_name." and Reward 2000 Rs is deposited
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



    <table border='0' align='center' width='50%' cellpadding='0' cellspacing='0' bgcolor='black'>
        <tr>
            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
        </tr>
        <tr>
            <td align='center'>

                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>

                    <tr>
                        <td>
                            <table border='0' align='left' cellpadding='10' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                class='container590'>
                                <tr>
                                    <td align='center'>
                                        <img src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/visa.png' style='display: block; height:100px;width: 100px;' width='100' height='100' border='0' alt='' />
                                    </td>
                                </tr>
                            </table>
                            <table border='0' width='280' align='right' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                            class='container590'>
                            <tr>
                                <td height='50' style='font-size: 12px; line-height: 25px;'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td align='left' style='color: #C0C0C0; font-size: 30px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'
                                    class='align-center'>
                                    <div style='line-height: 24px;color: #C0C0C0;'>
                                        <strong>".$debit_card."</strong>
                                    </div>
                                </td>
                            </tr>                            
                        </table>  
                        </td>
                    </tr>

                    <tr>
                        <td align='center'>
                            <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                <tr>
                                    <td>            
                                        <table border='0' align='left' cellpadding='10' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                class='container590'>
                                <tr>
                                            <td align='left' style='color: #C0C0C0; font-size: 20px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'
                                                class='align-center'>            
                                                <div style='line-height: 24px;color: #C0C0C0;'>
                                                    <strong>Account Number:</strong><br><p> ".$account_number."</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table border='0' width='280' align='right' cellpadding='10' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                            class='container590'>
                            <tr>
                                <td align='left' style='color: #C0C0C0; font-size: 20px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'
                                    class='align-center'>
                                    <div style='line-height: 24px;color: #C0C0C0;'>
                                        <strong> Name:</strong><br> <p>".$full_name."</p>
                                    </div>
                                </td>
                            </tr>
                        </table>       
                                    </td>
                                </tr>
            
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align='center'>
                            <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                <tr>
                                    <td>
                                        <table border='0' align='left' cellpadding='10' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                class='container590'>
                                        <tr>
                                            <td align='left' style='color: #C0C0C0; font-size: 20px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'
                                                class='align-center'>
                                                <div style='line-height: 24px;color: #C0C0C0;'>
                                                    <strong>Validity Date:</strong><br> <p>".$validity."</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table border='0' width='280' align='right' cellpadding='10' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                            class='container590'>
                             <tr>
                                <td align='left' style='color: #C0C0C0; font-size: 20px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'
                                    class='align-center'>


                                    <div style='line-height: 24px;color: #C0C0C0;'>

                                        <strong>Expiry Date:</strong><br> <p>".$expiry."</p>

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
        <tr>
            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
        </tr>

        


    </table>

<table>
    <tr>
        <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
    </tr>
</table>
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

                            Your Netbanking Credential <span style='color: #FFD700;'>Tech Wizard Bank</span>

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

                                       Thank you for choosing us !!! Here is your transaction pin please change after login ".$full_name."
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
                                                <strong>account number :</strong><br><p> ".$account_number."</p>
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
                                    <strong> Transaction Password:</strong><br> <p>".$hash."</p>
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
<tr>
<td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
</tr>
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

    <tr class='hide'>
        <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
    </tr>
    <tr>
        <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
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

        <tr>
            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
        </tr>

    </table>
    <!-- end footer ====== -->

</body>

</html>";
	  
	 
	 
if (mail($to,$sub,$msg,$headers,$additional_parameters)){
  //echo "Your Mail is sent successfully.";
  $showAlert1 = true;
  
}
else{
  //echo "Your Mail is not sent. Try Again.";
  $showError1 = true;
}
		
			}
            if($result_update){
                $sql_profile ="INSERT INTO profile (`login_username`,`full_name`, `email_id`,`Mno`) SELECT `login_username`,`full_name`,`email_id`,`Mno` from application WHERE NOT EXISTS (SELECT `login_username` FROM profile WHERE profile.login_username= application.login_username) LIMIT 1";
                $result_profile = mysqli_query($conn, $sql_profile);
            }
            if($result_profile){
                $sql_users ="INSERT INTO users (`login_username`,`full_name`, `email_id`,`Mno`,`password`) SELECT `login_username`,`full_name`,`email_id`,`Mno`,`password`from application WHERE NOT EXISTS (SELECT `login_username` FROM users WHERE users.login_username= application.login_username) LIMIT 1";
                    $result_users = mysqli_query($conn, $sql_users);
                
			
		}
    }
		
			

			
		
   

}
    
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style2.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<!-- fontawesome icons
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src="https://kit.fontawesome.com/2715ab056d.js" crossorigin="anonymous"></script>

</head>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>

<body>

<div class="wrapper">
<?php include 'nav.php';?>
        
	<!--container start-->
<div class="container ">
		<div class="main-body">
			<div class="row">
				
					<!--card image card -->
					
						<div class="card-body ml-2">
							<div class="d-flex flex-column align-items-center text-left">
								<div class="col-lg-12 mt-5">
	                            <img src="http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png" alt="Admin" class="rounded-circle  bg-transparent" height="200" width="300" >								
							</div>
						</div>
							
							
						</div>
					
				
				<!--card style ended-->
				<div class="col-lg-8 mt-5">
					<!--card form-->
					<div class="card"  style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
					-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" >
					
						
						
						<div class="card-body">
							<form action="#" method="POST">
					<?php			
				if($showAlert){
					echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Card generated Sucessfully</strong> 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div> ';
					}
							?>
							<?php               
                 
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
                            
                           
                            <!-- <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">customer username  </h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control"   name="login_username" id="login_username" required>
								</div>
							</div> -->
							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" name="generate"value="Generate card">
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
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

 
</body>

</html>