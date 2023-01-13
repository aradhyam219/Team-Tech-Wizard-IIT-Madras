<?php

session_start();
$showAlert1=false;
$showError=false;
$showError2=false;
$showError3=false;

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: net_banking_login.php");
    exit;
}
include "dbconnect.php";
$login_username=$_SESSION['login_username'];

$select_display= "select * from users where login_username='$login_username'" ;
$select_sql1 = mysqli_query($conn,$select_display);
while($row1 = mysqli_fetch_array($select_sql1)){
$login_username=$row1[1];

}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $login_username = $_POST["login_username"];
    $account_number=$_POST["account_number"];
    $current_transaction_pin=$_POST["current_transaction_pin"];
    

    $sql = "Select * from card_account_details where account_number='$account_number'  and login_username='$login_username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            $store=$row['transaction_pin'];
            $account_number=$row['account_number'];
            if (password_verify($current_transaction_pin,$store)){ 
                $hash=$_POST["transaction_pin"];
                $transaction_pin = password_hash($hash, PASSWORD_DEFAULT);                
                $sql_update="update card_account_details set transaction_pin='$transaction_pin' where account_number='$account_number' and login_username='$login_username'";
                $result_update = mysqli_query($conn, $sql_update);
                $showAlert1=true; 
                if($result_update){
                    echo 'sql inserted';
                }
                else{
                    $showError = "unsuccessful";
                }               
            } 
            else{
                $showError = "current password doesnt match";
            }
            
        }
        
    } 
    else{
        $showError="invalid credential check account number";
    }
}
    
  
    
    

    
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>change transaction pin</title>

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
					
						<?php
                        if($showAlert1){
                            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Transaction Password change</strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div> ';
                            }
                            if($showError){
                                echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>current password doesnt matched 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button
                                </div> ';
                                }
                               
                        ?>
						
						<div class="card-body">
							<form action="change_transaction_pin.php" method="POST">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">account number</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter account number" name="account_number" id="account number" pattern="[0-9]{10}" title="Please enter a valid 10-digit account number."required >
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">current transaction password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="current_transaction_pin" id="current_transaction_pin" placeholder="transaction pin" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^\w\s]).{8,}" title="Please enter one uppercase,one digit,one symbol with minmun length 8" required>
								</div>
							</div>


                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">New transaction password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="transaction_pin" id="transaction_pin" placeholder="new transaction pin"  pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^\w\s]).{8,}" title="Please enter one uppercase,one digit,one symbol with minmun length 8" required>
								</div>
							</div>


							
							

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0" style="display:none;">login_username</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="hidden" class="form-control"   name="login_username" id="login_username" value="<?php echo $_SESSION['login_username']?>">
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="change password">
								</div>
							</div>
						</div>
						</form>
						
					</div><br>
					<p style='color:red;'><b>password must contain 1 uppercase,lowercase,digit,symbols and minimum length is 8</b></p>
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