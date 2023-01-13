
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style2.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<!-- fontawesome icons
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
    <script src="https://kit.fontawesome.com/2715ab056d.js" crossorigin="anonymous"></script>

</head>



        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header mt-4">
                <h3>Tech wizard</h3>
            </div>

            <ul class="list-unstyled components">
                <p><i class="fa fa-fw fa-home"></i> &nbsp;Home</p>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-fw fa-user"></i>&nbsp;Users</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                        <a href="auto_view_users.php"><i class="fa fa-fw fa-users"></i>&nbsp;View Users </a>
                        </li>
                       
                        <li>
                        <a href="manage_users.php"><i class="fa fa-fw fa-people-roof"></i>&nbsp;Manage Users</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu6" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-fw fa-user"></i>&nbsp;Application Request</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu6">
                        
                        <li>
                        <a href="manage_apply_with_us.php"><i class="fa fa-fw fa-people-roof"></i>&nbsp;Manage application</a>
                        </li>
                       
                        
                    </ul>
                </li>

                <li>
                    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-fw fa-user"></i>&nbsp;Account Category</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu1">
                        <li>
                        <a href="add_account_category.php"><i class="fa fa-fw fa-users"></i>&nbsp;Add Category </a>
                        </li>
                        <li>
                        <a href="manage_account_category.php"><i class="fa fa-fw fa-people-roof"></i>&nbsp;Manage Category</a>
                        </li>
                       
                        
                    </ul>
                </li>


                <li>
                    <a href="#pageSubmenu7" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-fw fa-user"></i>&nbsp;Bank Branch</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu7">
                        <li>
                        <a href="add_branch_details.php"><i class="fa fa-fw fa-users"></i>&nbsp;Add Branch </a>
                        </li>
                        <li>
                        <a href="manage_branch_details.php"><i class="fa fa-fw fa-people-roof"></i>&nbsp;Manage Branch</a>
                        </li>
                       
                        
                    </ul>
                </li>

                <li>
                    <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-fw fa-user"></i>&nbsp;Generated Card</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu2">
                        
                        <li>
                        <a href="manage_card_details.php"><i class="fa fa-fw fa-people-roof"></i>&nbsp;Manage card details</a>
                        </li>
                        
                        
                    </ul>
                </li>


               


                <li>
                    <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-fw fa-user"></i>&nbsp;Transaction reports </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu4">
                        <li>
                        <a href="view_transactions.php"><i class="fa fa-fw fa-users"></i>&nbsp;view_transactions  </a>
                        </li>
                        <li>
                        <a href="fraud account.php"><i class="fa fa-fw fa-users"></i>&nbsp;suspicious activity  </a>
                        </li>
                        
                       
                    </ul>
                </li>

                
                

                
                <li>
                    <a href="#"><i class="fa-solid fa-gear"></i>&nbsp;Setting</a>
                </li>
                
            </ul>

            <ul class="list-unstyled CTAs">
                
                <li>
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid ">
                  

                    <button type="button" id="sidebarCollapse" class="btn btn-info mt-0">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <a class="navbar-brand" href="#">Admin Panel</a>
                    <a class="navbar-brand" href="#"><?php echo $_SESSION['admin_username']?></a>
                                            
                          
                         
                        </div>
                      
                   
            
            </nav>

 

        
        <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
 

