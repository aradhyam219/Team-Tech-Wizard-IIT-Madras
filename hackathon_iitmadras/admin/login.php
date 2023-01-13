
    <?php
	
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $admin_username = $_POST["admin_username"];
    $password = $_POST["password"]; 
    
    
     
   
    $sql = "Select * from admin where  admin_username='$admin_username' and verification_status=1 ";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if (password_verify($password, $row['password'])){ 
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['admin_username'] = $admin_username;
                $login = true;
                header("location: manage_apply_with_us.php");
                
            } 
            else{
                $showError = "Invalid Credentials";
            }
        }
        
    } 
    else{
		$sql2 = "Select * from admin where  admin_username='$admin_username' AND verification_status=0";
		$result2 = mysqli_query($conn, $sql2);
		$num2 = mysqli_num_rows($result2);
		if($num2==1){
         $showError = "Account not verified yet";
		}
		else{
         $showError = "No account found";
        
    }
}
}
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title>admin tech wizard bank</title>
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
								<div class="col-lg-12 mt-2">
								<img src="http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png" alt="Admin" class="rounded-circle  bg-transparent" height="200" width="300" >																
							</div>
						</div>
							
							
			</div>
					
				
				<!--card style ended-->
				<div class="col-lg-8 mt-5">
					<!--card form-->
					<div class="card"  style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
					-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" >
					
						
						
						<div class="card-body">
							<form action="login.php" method="POST">
								
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

    
    ?>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">admin_username</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter your username" name="admin_username" id="admin_username">
								</div>
							</div>
							
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="password" id="password">
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














