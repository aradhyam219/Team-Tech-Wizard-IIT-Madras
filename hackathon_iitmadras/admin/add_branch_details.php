<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
include "dbconnect.php";
$admin_username=$_SESSION['admin_username'];

$select_display= "select * from admin where admin_username='$admin_username'" ;
$select_sql1 = mysqli_query($conn,$select_display);
while($row1 = mysqli_fetch_array($select_sql1)){
$admin_username=$row1[1];

}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $branch_name = $_POST["branch_name"];
    $ifsc_code=$_POST["ifsc_code"];
	$country=$_POST["country"];
	

        // $exists = false; 
     
            
            
            $sql = "INSERT INTO `branch_detail`(`branch_name`,`admin_username`,`ifsc_code`,`country`) VALUES ('$branch_name','$admin_username', '$ifsc_code','$country')";
            
            $result = mysqli_query($conn, $sql);
            if($result){
                
            echo 'successfull';
            }
            else{
                echo 'username doesnt exist';
            }
			     
   

}
    
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>account category</title>

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
							<form action="add_branch_details.php" method="POST">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Branch name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter branch name" name="branch_name" id="branch_name">

								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">IFSC Code</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="ifsc code">
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Country</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="country" id="country" placeholder="country">
								</div>
							</div>
							
							

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0" style="display:none;">admin_username</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="hidden" class="form-control"   name="admin_username" id="admin_username" value="<?php echo $_SESSION['admin_username']?>">
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="add branch">
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