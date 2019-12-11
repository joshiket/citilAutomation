<?php
    session_start();
    if(isset($_SESSION["lgUser"]))
    {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/png" href="assets/images/favicon2.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Warranty </title>

        <!-- Bootstrap Core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="assets/css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="assets/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="assets/css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="assets/css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="assets/fontawesome5/css/all.css" rel="stylesheet" type="text/css">
        <!-- Custom styling -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
        <!-- Bootstrap datePicker plugin-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body ng-app="app">

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html"><img src="assets/images/logo.png"></a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="#"></a></li>
                </ul>

                <ul class="nav navbar-right navbar-top-links">

                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="#/" class="active"><i class="fa fa-tachometer-alt fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-users"></i>  &nbsp;Customers <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#/customers/new">New Customer</a>
                                    </li>
                                    <li>
                                        <a href="#/customers/list">Manage Customers</a>
                                    </li>
                                    <li>
                                        <a href="#/CutomerBranches/new">New Customer Branch</a>
                                    </li>
                                    <li>
                                        <a href="#/CutomerBranches/add">Add Customer Branch</a>
                                    </li>      
                                    <li>
                                        <a href="#/CutomerBranches/list">Manage Customer Branches</a>
                                    </li>                                                                                                       
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-user-tie"></i>  &nbsp;Account Managers <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#/managers/new">New Account Manager</a>
                                    </li>
                                    <li>
                                        <a href="#/managers/list">Manage Account Managers</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>                            
                            <li>
                                <a href="#"><i class="fa fa-shopping-bag"></i>  &nbsp;Distributors <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#/distributors/new">New Distributor</a>
                                    </li>
                                    <li>
                                        <a href="#/distributors/list">Manage Distributors</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-file-contract"></i>  &nbsp;Warranty records <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#/WarrantyRecords/new">New Warranty record</a>
                                    </li>
                                    <li>
                                        <a href="#/WarrantyRecords/list">Manage Warranty records</a>
                                    </li>
                                </ul>
                            </li>    
                            <li>
                                <a href="#"><i class="fa fa-archive"></i>  &nbsp;Products <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#/products/new">New Product</a>
                                    </li>
                                    <li>
                                        <a href="#/products/list">Manage Products</a>
                                    </li>
                                </ul>
                            </li>       
                            <li>
                            <a href="#"><i class="fa fa-file-signature"></i>  &nbsp;OEM Certifications <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                    <a href="#/Certifications/new">New OEM Certifications</a>
                                    </li>                                    
                                    <li>
                                        <a href="#/Certifications/list">Manage OEM Certifications</a>
                                    </li>
                                </ul>
                            </li>    
                            <li>
                                <a href="#"><i class="fa fa-building"></i>&nbsp; OEM Certification Providers <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                            <li>
                                                <a href="#/CertificationProviders/new">New Certification Provider</a>
                                            </li>
                                            <li>
                                                <a href="#/CertificationProviders/list">Manage Certification Providers</a>
                                            </li>
                                 </ul>                                         
                            </li>   
                            <li>
                                <a href="#"><i class="fa fa-user-graduate"></i>&nbsp; OEM Certified Professionals <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                            <li>
                                                <a href="#/CertifiedProfessionals/new">New OEM Certified Professionals</a>
                                            </li>
                                            <li>
                                                <a href="#/CertifiedProfessionals/list">Manage OEM Certified Professionals</a>
                                            </li>
                                </ul>                                         

                            </li>
                            <li>
                                <a href="#"><i class="fa fa-user"></i>&nbsp; Users <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                            <li>
                                                <a href="#/Users/new">New User</a>
                                            </li>
                                            <li>
                                                <a href="#/Users/changePassword">Change Password</a>
                                            </li>
                                            <li>
                                                <a href="logout.php">Logout</a>
                                            </li>
                                </ul>                                         

                            </li>                            
                                                                                                                                    
                                <!-- /.nav-second-level -->
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="page-wrapper">
                <div ng-view>

                </div>
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- Bootstrap datePicker plugin-->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

        <!--Angular JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.1/angular.js"></script>

        <!--Angular Routes-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.1/angular-route.js"></script>

        <!--Angular Messages-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.4.1/angular-messages.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="assets/js/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="assets/js/raphael.min.js"></script>
        <!--script src="assets/js/morris.min.js"></script-->
        <!--script src="assets/js/morris-data.js"></script-->

        <!-- Custom Theme JavaScript -->
        <script src="assets/js/startmin.js"></script>

        <!--main Angujar JS app-->
        <script src="app.js"></script>

        <!--Services-->
        <script src="Services/dataService.js"></script>
        <script src="Services/alertService.js"></script>
        <script src="Services/pageService.js"></script>
        <script src="Services/sessionService.js"></script>

        <!--Controller Laading-->
        <!--
        <Script src="Controllers/Dashboard/dashBoardController.js" ></script>
        <script src="Controllers/Customers/customerController.js"></script>
        <script src="Controllers/Distributors/distributorController.js"></script>
        <script src="Controllers/Managers/managerController.js"></script>
        <script src="Controllers/WarrantyRecords/warrantyRecordController.js"></script>
        <script src="Controllers/Products/productController.js"></script-->
        <script src="Controllers/loadControllers.js"></script>

    </body>
</html>
<?php
    }
    else
    {
        header("Location: se.php");
    }
?>
