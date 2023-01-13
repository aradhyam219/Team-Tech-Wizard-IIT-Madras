<?php
	session_start();
$login = false;
$showError = false;
$showAlert=false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $login_username = $_POST["login_username"];
    $password = $_POST["password"];
	$sql3 = "Select * from users where  login_username='$login_username' and disabled_account=0";
    $result3 = mysqli_query($conn, $sql3);
    $num3 = mysqli_num_rows($result3);
	if($num3==1){
		$login=false;
		$showError='contact bank user account disabled';

	}
else{
	
	

	
	
		$sql = "Select * from users where  login_username='$login_username' and login_attempts<=5";
		$result = mysqli_query($conn, $sql);
		$num = mysqli_num_rows($result);
		if($result){
        while($row=mysqli_fetch_assoc($result)){
			 if (!password_verify($password, $row['password'])) {
			$query = "UPDATE users SET login_attempts = login_attempts + 1 WHERE login_username = '$login_username'";
			$result_update = mysqli_query($conn, $query);
			$showError='Wrong password';
			$query1 = "SELECT login_attempts FROM users WHERE login_username = '$login_username'";
			$result_update = mysqli_query($conn, $query1);
			$attempts=mysqli_fetch_assoc($result_update);
			if ($attempts['login_attempts'] >= 5) {
				
					$select_display_user= "select * from users where login_username='$login_username' " ;
 $sql2 = mysqli_query($conn,$select_display_user);
 while($row3 = mysqli_fetch_array($sql2)){
 $login_username=$row3[1];
 $email_id=$row3[3];
 $full_name=$row3[2];
 date_default_timezone_set('Asia/Kolkata');
		$timestamp = date("Y-m-d H:i:s");
		$ip_address = $_SERVER['REMOTE_ADDR'];
					$headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
						'X-Mailer: PHP/' . phpversion()."\r\n" ;
	$headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
	$to = "$email_id";
	$additional_parameters = '-fsupport@smilewellnessfoundation.org';
	$subject = "Account locked unsuccessfull login";
						$message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
						<html xmlns:v='urn:schemas-microsoft-com:vml'>
						
						<head>
							<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
							<meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
							<!--[if !mso]--><!-- -->
							<link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
							<link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
							<!-- <![endif]-->
						
							<title>Net Banking login</title>
						
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
						
																   Account has been locked please reset your password  and login  Ip address is ".$ip_address."  at time ".$timestamp." <br>
																   
											
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
						
								
						
							</table>
							<!-- end section -->

							<table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
                    
                        
                                    
                    
                                  
                    
                                   
                    
                    
							<tr>
								<td align='center'>
									<table border='0' align='center' width='160' cellpadding='0' cellspacing='0' bgcolor='5caad2' style=''>
			
										
			
										<tr>
											<td align='center' style='color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;'>
			
			
												<div style='line-height: 26px;'>
													<a href='https://smilewellnessfoundation.org/hackathon_iitmadras/account_locked.php' style='color: #ffffff; text-decoration: none;'>LOGIN NOW</a>
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
					
						  $showError='Check mail to reset your net banking password account locked';
						  

						  
						  
										
										 
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
				else{
					$showError='wrong password';
				}
			
		}
	}
}


		
		date_default_timezone_set('Asia/Kolkata');
		$timestamp = date("Y-m-d H:i:s");
		$ip_address = $_SERVER['REMOTE_ADDR'];
		
    
     
   
    $sql = "Select * from users where  login_username='$login_username' and login_attempts<5";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
	
    if ($num>0){
        while($row=mysqli_fetch_assoc($result)){
            if (password_verify($password, $row['password'])){
				echo $password;
				$token= rand(999999, 111111);
				echo $token;
				$login_username=$row['login_username'];
				echo $login_username;
				$query = "UPDATE users SET login_attempts = 0 WHERE login_username = '$login_username'";
				$result_query = mysqli_query($conn, $query);




				$sql_update="update users set token= ".$token." where login_username='$login_username'"; 
				$result_update = mysqli_query($conn, $sql_update);
				echo $result_update;
			



				
				if($result_update==1){
					$select_display_user= "select * from users where login_username='$login_username' " ;
 $sql2 = mysqli_query($conn,$select_display_user);
 while($row3 = mysqli_fetch_array($sql2)){
 $login_username=$row3[1];
 $email_id=$row3[3];
 $full_name=$row3[2];
					$headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
						'X-Mailer: PHP/' . phpversion()."\r\n" ;
	$headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
	$to = "$email_id";
	$additional_parameters = '-fsupport@smilewellnessfoundation.org';
	$subject = "Login Verification Code";
						$message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
						<html xmlns:v='urn:schemas-microsoft-com:vml'>
						
						<head>
							<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
							<meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
							<!--[if !mso]--><!-- -->
							<link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
							<link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
							<!-- <![endif]-->
						
							<title>Net Banking login</title>
						
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
						
																   Thank you for choosing us !!! Verification code is  ".$token."  and login  Ip address is ".$ip_address."  at time ".$timestamp." <br>
																   
											
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

						  $info = "We've sent a verification code to your email - $email_id";
										$_SESSION['info'] = $info;
										$_SESSION['login_username'] = $login_username;
										$_SESSION['password'] = $password;
										
										  header('location:login-otp.php');
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
					else{
						echo 'something went wrong';
					}
	
			}
			else{
				// echo 'wrong';
			}
			// $email_id=$row['email_id'];
			// $full_name=$row['full_name'];
		}
	}
	else{
		$showError="account locked please reset your password from your email first";
	}
	
		
	}


	$sql = "Select * from users where  login_username='$login_username'";
		$result = mysqli_query($conn, $sql);
		$num = mysqli_num_rows($result);
	if(!$num){
		$showError="no account found";
	}
}
    
    

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title>Net Banking Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>




<body class="mt-5 pt-5 pl-3" style="background:white">
<!--card started outer 1-->
<div class="card col-lg-11 ml-5 pb-5 " style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" >
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
							<form action="net_banking_login.php" method="POST">
								
<?php
    if($login){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
	if($showAlert){
		echo ' <div class="alert alert-d\success alert-dismissible fade show" role="alert">
			<strong>verification Mail send !</strong> '. $showAlert.'
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div> ';
		}

    
    ?>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">login_username</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter your username" name="login_username" id="admin_login_username" required>
								</div>
							</div>
							
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="password" id="password" placeholder="enter your password">
								</div>
							</div>
		
							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="login">
								</div>
							</div>
						</div>
						</form>
						<p class = "text-center">dont Have An Account?? <a href="apply_with_us.php">create Here</a></p>
						<div class="text-center"><a href="pass1.php">Forgot password?</a></div>
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













