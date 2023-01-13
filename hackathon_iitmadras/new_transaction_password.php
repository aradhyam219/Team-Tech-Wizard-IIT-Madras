<?php
$showAlert = false;
$showError = false;


// if($_SERVER["REQUEST_METHOD"] == "GET"){
include 'dbconnect.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $login_username=$_POST['login_username'];
    $password =$_POST["password"];
    $cpassword =$_POST["cpassword"];
// if(!empty($_GET['code']) && isset($_GET['code'])){
//    $code=$_GET['code'];
 
    if(($password == $cpassword)){
       
        $password = password_hash($password,PASSWORD_DEFAULT);
$result_update=mysqli_query($conn,"UPDATE card_account_details SET transaction_pin='$password' WHERE login_username='$login_username' and password_code=1");

if($result_update){
$showAlert = true;
$showError=false;
header('location:password-reset-sucessfully.html');

    }
}
if($password != $cpassword){
        
    $slowAlert1=false;
$showError= true;
    
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
    <title>new password</title>
  </head>
  <body>
   
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Password updated Sucessfully!!</strong> 
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

    
       
    ?>

    <div class="container my-4">
     <h1 class="text-center">Create New  Password</h1>
     <form action="new_transaction_password.php" method="post">
     <div class="form-group">
            <label for="username">username</label>
            <input type="text"  class="form-control" id="login_username" name="login_username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password"  class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
            <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
        </div>
         
        <button type="submit" class="btn btn-primary">update</button>
     </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>