
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
        <title>
            view previous deposit</title>
</head>

<body>



    

    
    
<br><br><br>
<div class="wrapper">
<?php include 'nav.php';?>



    <div class="container">
		<div class="main-body">
            <!--list product-->
<h1 class="align-items-center">Deposit Transactions</h1><br>
			
            <?php
            
            $select_display="select    * from deposit where login_username='$login_username' order by deposit_id" ;
            $sql1 = mysqli_query($conn,$select_display);
            $num=mysqli_num_rows($sql1);
            if($num>0){
                echo '<table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Serial Number</th>
                <th scope="col">transaction_id</th>
                <th scope="col">amount added</th>
                <th scope="col">deposit_time</th>
            </tr>
        </thead>
        <tbody>';

            
            $counter=0;
        

                while($row = mysqli_fetch_assoc($sql1))
                {
                    $counter=++$counter;
                    $transaction_id=$row["transaction_id"];
                    $balance=$row["balance"];
                    $deposit_time=$row["deposit_time"];
                echo "<tr>
                    <td> $counter</td>
                    <td>$transaction_id</td>
                    <td>$balance</td>
                    <td>$deposit_time</td>
                </tr>";
            }
        echo '</tbody>
    </table>';
        }
        else{
            echo '<b>No deposit History';
        }
              ?>          
                
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
    background-color: black;
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

