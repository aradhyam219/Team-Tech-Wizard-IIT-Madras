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
 $select_display= "select login_username,email_id,Mno,full_name,address,state,city,zip from profile where login_username='$login_username'" ;
 $sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($sql1)){
 $login_username=$row1[0];
 $email_id=$row1[1];
 $Mno=$row1[2];
 $full_name=$row1[3];
 $address=$row1[4];
 $state=$row1[5];
 $city=$row1[6];
 $zip=$row1[7];
 }
}

?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
   $login_username=$_SESSION['login_username'];
   
  
   $address=$_POST['address'];
   $state=$_POST['state'];
   $city=$_POST['city'];
   $zip=$_POST['zip'];


   //$email=$_POST['email'];
   $select= "select * from profile where login_username='$login_username'";
   $sql = mysqli_query($conn,$select);
   $row = mysqli_fetch_assoc($sql);
   $res= $row['login_username'];
   if($res === $login_username)
   {
	  
	  $update = "update profile set address='$address',state='$state',city='$city',zip='$zip' where login_username='$login_username'";
	  $sql2=mysqli_query($conn,$update);
if($sql2)
	  { 
		  $showAlert=true;
		 
	  }
	  else
	  {
		  //$showError=true;
		 
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
    <title>profile </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php require 'nav.php' ?>

<?php
    

    if($showAlert){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Profile Update Successfully!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        }
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
								<img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
		
									 <h4><?php echo $login_username?></h4>
									<p class="text-secondary mb-1"><?php echo $email_id?></p>
								<p class="text-muted font-size-sm"><?php echo $Mno?></p>
								
				
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card" style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<form action="profile.php" method="post">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $full_name?>" name="full_name"id="full_name" disabled>
								</div>
		
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $email_id?>" disabled>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Mobile</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $Mno?>"  name="Mno" id="Mno" disabled>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Address</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $address?>" name="address" id="address" required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">State</h6>
								</div>
							<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $state?>" name="state" id="state" required> 
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">City</h6>
								</div>
							<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $city?>" name="city" id="city" required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">zip</h6>
								</div>
							<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $zip?>" name="zip" id="zip" required>
								</div>
							</div>
                            
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="Save Changes"  required>
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