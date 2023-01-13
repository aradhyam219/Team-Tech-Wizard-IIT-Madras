<?php


$showAlert = false;
$showError = false;
$showAlert1 = false;
$showError1 = false;
$showError2 = false;
$showError3 = false;
$showError4 = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
	$fname = $_POST["fname"];
    $admin_username = $_POST["admin_username"];
    $email=$_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // $exists=false;

    //Check whether this email exists
    $sql_email = "SELECT * FROM `admin` WHERE email = '$email'";
    $sql_username = "SELECT * FROM `admin` WHERE admin_username = '$admin_username'";
    $result_email=mysqli_query($conn, $sql_email) or die (mysqli_error($conn));
    $result_username=mysqli_query($conn, $sql_username) or die (mysqli_error($conn));
    $numExistRows = mysqli_num_rows($result_username);
    $numExistRows1 = mysqli_num_rows($result_email);

 
    
    if($numExistRows > 0){
        // $exists = true;
        $showError2 = true;
    }
    else if($numExistRows1 > 0){
        // $exists = true;
        $showError3 = true;
    }
    else{
        // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $token= bin2hex(random_bytes(15));
            date_default_timezone_set('Asia/Kolkata');
            $timestamp = date("Y-m-d H:i:s");
            
            $sql = "INSERT INTO `admin` ( `admin_username`, `email`,`password`, `account_creation_time`,`token_email`) VALUES ('$admin_username','$email','$hash', '$timestamp','$token')";
            $result = mysqli_query($conn, $sql);
        }
       
    if($password != $cpassword){
        
        $slowAlert1=false;
    $showError= true;
        
}
else{
    $headers = 'From:support@smilewellnessfoundation.org' ."\r\n" .
'reply-to:smilewellnessfoundation@gmail.com'. "\r\n" .
'X-Mailer: PHP/' . phpversion();
$to = "$email";
$sub = "Email Verification ";
$msg="
     thank you for signing up on our website.
     please click on the verification link below to verify your email
      http://www.smilewellnessfoundation.org/activate.php?token=$token";
if (mail($to,$sub,$msg,$headers)){
  //echo "Your Mail is sent successfully.";
  $showAlert1 = true;
  header('location:login.php');
}
else{
  //echo "Your Mail is not sent. Try Again.";
  $showError1 = true;
}
//     $slowAlert1=false;
//     $showError1 = false;
// }
}
       
}
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title>admin Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="mt-5 pt-5 pl-3" style="background:linear-gradient(90deg,#fc855a,#9c9bff,#fadb7d);">

<?php
     
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! Account created Sucessfully</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>password dont match</strong> '. $showError.'
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
                <strong>Verification mail not send please check your email id!!</strong> '. $showError1.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
            }
            if($showError2){
                echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Username already taken</strong> '. $showError2.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> ';
                }
                if($showError3){
                    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>email already exist</strong> '. $showError3.'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> ';
                    }
                    if($showError4){
                        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>phone number already exist</strong> '. $showError3.'
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> ';
                        }
    ?>
<!--card started outer 1-->
<div class="card col-lg-11   pb-5 " style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" >
	<!--container start-->
<div class="container ">
		<div class="main-body">
			<div class="row">
				
					<!--card image card -->
					
						<div class="card-body ml-2">
							<div class="d-flex flex-column align-items-center text-left">
								<div class="col-lg-12 mt-5">
								<img src="Admission-open-min.jpg" alt="Admin" class="rounded-circle  bg-transparent" height="200" width="200">
								
							</div>
						</div>
							
							
						</div>
					
				
				<!--card style ended-->
				<div class="col-lg-9 mt-5 pl-5">
					<!--card form-->
					<div class="card"  style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
					-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" >
					
						
						
						<div class="card-body">
							<form action="signup.php" method="POST">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="John Doe" name="fname" id="fname">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Admin Username</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control"   name="admin_username" id="admin_username" placeholder="asifali"  required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="email" class="form-control" name="email" id="email" paceholder="example@gmail.com">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="password" id="password" >
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">confirm password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="cpassword" id="cpassword" >
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="Sign Up">
								</div>
							</div>
						</div>
						</form>
						<p class = "text-center">Already Have An Account?? <a href="login.php">login Here</a></p>
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