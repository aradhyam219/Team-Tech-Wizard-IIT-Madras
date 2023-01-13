
<?php 
$showError=false;
session_start();
$errors = array();
$login_username = $_SESSION['login_username'];
include 'dbconnect.php';

if(isset($_POST['check'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM users WHERE token = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['token'];
        $login_username = $fetch_data['login_username'];
        $token = 0;
        
        $update_otp = "UPDATE users SET token = $token WHERE token = $fetch_code";
        $update_res = mysqli_query($conn, $update_otp);
        if($update_res){
            $_SESSION['login_username'] = $login_username;
            $_SESSION['loggedin'] = true;
            // $_SESSION['login_username'] = $login_username;
            $login = true;
           
            header('location: login-successfully.html');
            exit();
        }else{
            $errors['otp-error'] = "Failed while updating code!";
        }
    }else{
        $errors['otp-error1'] = "You've entered incorrect code!";
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title>Login Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>





<body class="mt-5 pt-5 pl-3" style="background:white;">
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
                        <form action="login-otp.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    
                     <?php 
                     if(isset($_SESSION['info']) and count($errors)==0){
                         ?>
                         <div class="alert alert-success text-center">
                             <?php echo $_SESSION['info']; ?>
                         </div>
                         <?php
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
                                     
                                     <div class="row mb-3">
								<div class="col-sm-2">
									<h6 class="mt-2 ">OTP</h6>
								</div>
								<div class="col-sm-10 text-secondary">
                                <input class="form-control" type="text" name="otp" placeholder="Enter verification code" title="Enter 6 digit OTP number" pattern="[0-9]{6}" required required>

									
								</div>
							</div><br>
                    <div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" name="check" value="verify  Now">
                                    
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












