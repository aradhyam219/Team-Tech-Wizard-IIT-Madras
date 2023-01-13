<?php
 session_start();

$showAlert=false;
$showError=false;

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
 $email_id=$row1[3];
 $account_number=$row1[4]; 
 $ifsc_code=$row1[10];
 $current_balance=$row1[13];
 }
}

?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
   $login_username=$_SESSION['login_username'];
   
   
  
   
   $balance=$_POST['balance'];
   $transaction_id=$_POST['transaction_id'];
   


   //$email=$_POST['email'];
   $select= "select * from card_account_details where login_username='$login_username'";
   $sql = mysqli_query($conn,$select);
   $row = mysqli_fetch_assoc($sql);
   $res= $row['login_username'];
   if($res === $login_username)
   {
	  $new_balance=$current_balance+$balance;
	  $update = "update card_account_details set balance='$new_balance' where login_username='$login_username'";
	  $sql2=mysqli_query($conn,$update);
if($sql2)
	  {
        
        $ip_address = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Kolkata');
        $timestamp = date("Y-m-d H:i:s");
        $deposit ="INSERT INTO `deposit` ( `transaction_id`,`login_username`, `email_id`,`account_number`,`full_name`,`ifsc_code`,`balance`,`ip_address`,`deposit_time`) VALUES ('$transaction_id','$login_username','$email_id','$account_number','$full_name','$ifsc_code','$balance','$ip_address','$timestamp')";

	  $sql_deposit=mysqli_query($conn,$deposit); 
      $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
						'X-Mailer: PHP/' . phpversion()."\r\n" ;
	$headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
	$to = "$email_id";
	$additional_parameters = '-fsupport@smilewellnessfoundation.org';
	$subject = 'Funds added to your account  ';
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
						
																   <h2>Funds added successfully to your account number </h2><span style='color: #FFD700;'> <b>".$account_number."</b></span> <br> !!! <h2>updated balance is </h2><span style='color: #FFD700;'><b>".$new_balance."</b></span>  and transaction Ip address is <b>".$ip_address." </b> at time <b>".$timestamp."</b> <br>
																   
											
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
						//     $slowAlert1=false;
						//     $showError1 = false;
						// }
					}









      $showAlert=true;
		  
		 
	  }
	  else
	  {
		  //$showError=true;
		 
	  }
   }


?>
	

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>add_balance </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php require 'nav.php' ?>

<?php
    

    
        if($showError){
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Something went Wrong</strong> '. $showError.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
            }
         
    ?>
    
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
							<form action="" method="post">
                            <?php			
				if($showAlert){
					echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Funds added  Sucessfully</strong> 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div> ';
					}
							?>
                           



							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0" >transaction id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <?php $transaction_id= rand(999999, 111111);?>
									<input type="text" class="form-control" value="<?php echo $transaction_id?>" name="transaction_id"id="transaction_id" readonly>
								</div>
		
							</div>
							
								<div class="col-sm-9 text-secondary">
									<input type="hidden" class="form-control" value="<?php echo $email_id?>" disabled>
								</div>
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">account number</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $account_number?>" name="account_number" id="account_number" readonly>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ifsc code</h6>
								</div>
							<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $ifsc_code?>" name="ifsc_code" id="ifsc_code" readonly> 
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">balance</h6>
								</div>
							<div class="col-sm-9 text-secondary">
                            <input type="number" class="form-control" name="balance" id="balance" pattern="[0-9]+" title="Please enter a positive number" required>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="add balance"  required>
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