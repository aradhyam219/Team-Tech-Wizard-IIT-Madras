<?php
$showAlert = false;
$showError = false;
$showAlert1 = false;
$showError1 = false;
session_start();





if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    include 'dbconnect.php';
   
    $email_id=$_POST["email_id"];
    // $password = $_POST["password"];
    // $cpassword = $_POST["cpassword"];

    // $exists=false;

    // Check whether this email exists
    $sql_email = "SELECT * FROM `users` WHERE email_id = '$email_id'";
    $result_email=mysqli_query($conn, $sql_email) or die (mysqli_error($conn));
    $numExistRows1 = mysqli_num_rows($result_email);
    
    if($numExistRows1 ==0){
        // $exists = true;
        $showError = true;
    }
else{
    $password_token= bin2hex(random_bytes(15));
    $sql = "UPDATE users SET login_attempts=0,password_token='$password_token',password_code=0 WHERE email_id='$email_id'";
            $result = mysqli_query($conn, $sql);
            if ($result){
               
                $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
                'X-Mailer: PHP/' . phpversion()."\r\n" ;
$headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
$to = "$email_id";
$additional_parameters = '-fsupport@smilewellnessfoundation.org';
$subject = "password reset link";

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

                                Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank </span>

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
                            <td align='center'>
                                <table border='0' align='center' width='160' cellpadding='0' cellspacing='0' bgcolor='5caad2' style=''>
        
                                    <tr>
                                        <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                    </tr>
        
                                    <tr>
                                        <td align='center' style='color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;'>
        
        
                                            <div style='line-height: 26px;'>
                                                <a href='http://www.smilewellnessfoundation.org/hackathon_iitmadras/password_activate.php?password_token=".$password_token."' style='color: #ffffff; text-decoration: none;'>reset password </a>
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
      
      if (mail($to,$subject,$message,$headers,$additional_parameters)){
    $_SESSION['email_id'] = $email_id;
  //echo "Your Mail is sent successfully.";
  $showAlert = true;
}
else{
  //echo "Your Mail is not sent. Try Again.";
  $showError1 = true;

}
}

       
}
}
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>Account Locked</title>
  </head>
  <body>
    
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Password reset link send sucessfully!!</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Email Id dont exist!!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }

    if($showAlert1){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Email send succesfully!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        }
        if($showError1){
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Verification mail not send please check your email id!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
            }
    ?>

    <div class="container my-4">
     <h1 class="text-center">account locked Password-reset</h1><br><br>
     <form action="account_locked.php" method="post">
        <div class="form-group">
            <label for="email">Email</label><br>
            <input type="email"  class="form-control" id="email_id" name="email_id"  >
            
        </div>
  
  <button class="btn btn-primary" type="submit" name='continue'>Continue</button>

        
     </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>