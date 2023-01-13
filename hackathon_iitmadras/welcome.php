
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

 $select_display= "select * from users where login_username='$login_username'" ;
 $select_sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($select_sql1)){
 $login_username=$row1[1];
 
 }

 
 }
 

?>

	

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome </title>
</head>
<body>



    

    
    
<br><br><br>
<div class="wrapper">
<?php include 'nav.php';?>



    <div class="container">
		<div class="main-body d-flex flex-column align-items-center text-center">
       <h4> Welcome to  <span style='color: #FFD700;'>Tech Wizard Bank</span><h4>
            <!--list product-->
            <div class="row">
				<div class="col-lg-12">
					
						
							<div class="d-flex flex-column align-items-center text-center">
                            <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/logo1.png' alt='' /></a>
								<div class="mt-3">
                               

		
									
								
				
									
								</div>
							</div>
							
						</div>
					</div>
</div>

<div class="card-deck">
  <div class="card">
  <div class='d-flex flex-column align-items-center text-center mt-3'>
  <img src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/deposit.png'  alt='Admin' class='rounded-circle bg-dark' width='110'>
    <div class="card-body">
      <h5 class="card-title">Deposit Money</h5>
      <a class='btn btn-primary mt-3' href='add_balance.php'>Deposit</a>
      
    </div>
</div>
  </div>
  <div class="card">
  <div class='d-flex flex-column align-items-center text-center mt-3'>
  <img src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/view_balance.png' alt='Admin' class='rounded-circle  bg-dark' width='110'>
    <div class="card-body">
    <h5 class="card-title">view Balance</h5>
      <a class='btn btn-primary mt-3' href='view_bank_balance.php'>View Bank Balance</a>
      
    </div>
</div>
  </div>
  <div class="card">
  <div class='d-flex flex-column align-items-center text-center mt-3'>
  <img src='http://smilewellnessfoundation.org/hackathon_iitmadras/images/money-transfer.png' alt='Admin' class='rounded-circle  bg-dark' width='110'>
    <div class="card-body">
    <h5 class="card-title">Make Transactions</h5>
      <a class='btn btn-primary mt-3' href='transfer_money.php'>make Transaction</a>
    </div>
  </div>
</div>
</div>
<br><br>
    
</div>







</div>
</div>


				        
	 </div>
    

    <style type="text/css">
body{
    background: #f7f7ff;
    margin-top:20px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: white;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.table{
    border: 1px solid black;
    
}
td,th{
text-align: left;
  padding: 8px;
  
}
.me-2 {
    margin-right: .5rem!important;
}
.payment-icon-big {
  font-size: 60px;
  color: #FFD700;
}
</style>




   
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
</body>
</html>

