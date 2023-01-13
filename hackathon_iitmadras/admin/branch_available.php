<?php
$showAlert=false;
$showError=false;
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location:login.php");
    exit;
}
else{
    include 'dbconnect.php';


    $branch_id=$_GET['branch_id'];

   $update_disabled="update branch_detail  SET service_available='not available' where branch_id='$branch_id'";


	  $sql3=mysqli_query($conn,$update_disabled);
if($sql3)
	  { 
		  $showAlert=true;
		  header("location:manage_branch_details.php");
      
		 
	  }
	  else
	  {
		  //$showError=true;
		 
	  }
}



?>

<?php
if($showAlert){
                echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Account disabled successfully</strong> '. $showAlert.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> ';
                }
				?>