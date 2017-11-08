<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=APP_NAME?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/dist/css/custom.css">
    <?php if (!$admin) { ?>
    <link rel="stylesheet" href="/dist/css/notLoggedIn.css">
    <?php } ?>
    <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="/plugins/daterangepicker/moment.min.js"></script>
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue-light sidebar-mini <?php if($this->session->userdata('menu_state')) { ?> sidebar-collapse <?php } ?>">
    <div class="wrapper">
      <?php if ($admin) { ?>
      <header class="main-header">
        <a href="/" class="logo">
          <span class="logo-mini"><b><?=APP_SHORT?></b></span>
          <span class="logo-lg"><b><?=APP_NAME?></b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Slide navigatie</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                    
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">U heeft 0 notificaties</li>
                </ul>
              </li>
     
              <li class="name"><?=$this->session->userdata('name');?></li>
              <li><a href="/login/logout" class="btn btn-warning">Afmelden</a></li>
          
            </ul>
          </div>

        </nav>
      </header>
    <?php } ?>
    