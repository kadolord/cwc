<?php // matching the token url and the token session
    if($this->session->userdata('token_session') != en_dec("dec", $token)){
        header("Location:".base_url('Main/logout')); /* Redirect to login */
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=company_name();?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/jquery-ui.css');?>">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="<?=base_url('assets/css/google_fonts.css');?>">
    <!-- theme stylesheet--><!-- we change the color theme by changing color.css -->
    <link rel="stylesheet" href="<?=base_url('assets/css/style.blue.css');?>" id="theme-stylesheet">
    <link rel="stylesheet" href="<?=base_url('assets/css/select2-materialize.css');?>">
    <!-- Custom stylesheet - for your changes--> 
    <link rel="stylesheet" href="<?=base_url('assets/css/custom.css');?>">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?=base_url('assets/img/favicon.png');?>">
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
   <link rel="stylesheet" href="<?=base_url('assets/css/font-awesome.min.css');?>">
    <!-- Font Icons CSS-->
    <!-- <link rel="stylesheet" href="<?=base_url('assets/css/myfontastic.css');?>"> -->
    <!-- Jquery Datatable CSS-->
    <link rel="stylesheet" href="<?=base_url('assets/css/jquery.dataTables.css');?>">
    <!-- Jquery Select2 CSS-->
    <link rel="stylesheet" href="<?=base_url('assets/css/select2.min.css');?>">
    <!-- Bootstrap Datepicker CSS-->
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap-datepicker3.min.css');?>">
    <!-- Jquery Toast CSS-->
    <link rel="stylesheet" href="<?=base_url('assets/css/jquery.toast.css');?>">
    <!-- print.js css -->
    <link rel="stylesheet" href="<?=base_url('assets/css/print.min.css');?>">
<!--     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <style type="text/css">
         a:hover {
          cursor:pointer;
         }
    </style>
</head>
<body data-base_url="<?=base_url();?>" data-token = "<?php echo $token; ?>" data-player_id="<?php echo sha1(md5($applicant_info->applicant_id));?>">
    <div class="page charts-page">
        <!-- Main Navbar-->
        <header class="header">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-holder d-flex align-items-center justify-content-between">
                        <!-- Navbar Header-->
                        <div class="navbar-header">
                            <!-- Navbar Brand -->
                            <a href="<?=base_url('Main/home/'.$token);?>" class="navbar-brand">
                                <div class="brand-text brand-big hidden-lg-down">
                                    <span><?=company_name();?></span>
                                </div>
                                <div class="brand-text brand-small">
                                    <strong><?=company_initial();?></strong>
                                </div>
                            </a>
                            <!-- Toggle Button-->
                            <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                        </div>
                        <!-- Navbar Menu -->
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                            <!-- Logout    -->
                            <input type="hidden" id="current_balance_val">
                        
                            <li class="nav-item"><a href="<?=base_url('Main/logout');?>" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="page-content d-flex align-items-stretch"> 
            <!-- Side Navbar -->
            <nav class="side-navbar">
                <!-- Sidebar Header-->
                <div class="sidebar-header d-flex align-items-center">
                    <div class="avatar">
                        <img src="<?=base_url('assets/img/immigration_side_logo.png')?>" alt="..." class="img-fluid rounded-circle">
                    </div>
                    <div class="title">
                        <h1 class="h4"><?php echo $applicant_info->first_name.' '.$applicant_info->last_name;?></h1>
                        <p><?=$applicant_info->position?></p>
                    </div>
                </div>
                <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
                <ul class="list-unstyled pageNavigation">
                    <li data-num="1"> 
                        <a href="<?=base_url('Main/home/'.$token);?>"><i class="icon-home"></i>Home</a>
                    </li>
                    <li data-num="2">
                        <a id="profile-collapse-a" href="#profile-collapse" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface  -windows"></i>Profile </a>
                        <ul id="profile-collapse" class="select-collapse collapse list-unstyled">
                            <li><a href="<?=base_url('Main/information/'.$token);?>">Personal Info</a></li>
                            <li><a href="<?=base_url('Main/security/'.$token);?>">Change Password</a></li>
                            <li><a href="<?=base_url('Main/documents/'.$token);?>">Documents</a></li>
                        </ul>
                    </li>
                    <li data-num="3"> 
                        <a href="<?=base_url('Main/view_application/'.$token);?>"><i class="icon-home"></i>Application</a>
                    </li>

<!--                      <li data-num="3"> 
                        <a id="transaction-collapse-a" href="#transaction-collapse" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Application </a>
                        <ul id="transaction-collapse" class="select-collapse collapse list-unstyled">
                            <li><a href="<?=base_url('Main/view_application/'.$token);?>">Application</a></li>
                            <li><a href="<?=base_url('Main/view_schedule_appointment/'.$token);?>">Schedule / Reschedule</a></li>
                        </ul>
                    </li> -->
                </ul>
            </nav>