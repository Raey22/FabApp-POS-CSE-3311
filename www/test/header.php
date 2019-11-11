<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Language" content="en">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>FabApp Dashboard - A Tool By Engineers For Engineers</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
  <meta name="description" content="FabApp, A Tool By Engineers For Engineers">
  <meta name="msapplication-tap-highlight" content="no">
  <!--
  =========================================================
  * ArchitectUI HTML Theme Dashboard - v1.0.0
  =========================================================
  * Product Page: https://dashboardpack.com
  * Copyright 2019 DashboardPack (https://dashboardpack.com)
  * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
  =========================================================
  * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<!-- Meta links -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="FabApp, track your equipment">
<meta name="author" content="UTA FabLab">
<link rel="shortcut icon" href="/images/fa-icon.png" type="image/png">

<!-- Stylesheets -->
<link href="./main.css" rel="stylesheet">
<!-- <link href="/vendor/fabapp/fabapp.css" rel="stylesheet"> -->
<link href="/vendor/fontawesome/css/all.min.css" rel="stylesheet">
<link href="/vendor/blackrock-digital/css/sb-admin-2.css" rel="stylesheet">
<link href="/vendor/bs-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="/vendor/datatables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
<link href="/vendor/morrisjs/morris.css" rel="stylesheet">
<!-- <link href="/vendor/bootstrap/css/bootstrap.css" rel="stylesheet"> -->

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<?php
$staff = null;
ob_start();
session_start();
include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/ldap.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/class/all_classes.php');
date_default_timezone_set($sv['timezone']);
if(!$mysqli->query("SET NAMES 'utf8';")) throw new Exception("Could not set MySqli encoding to UTF-8");

if( isset($_SESSION['staff']) ){
  $staff = unserialize($_SESSION['staff']);
  $_SESSION['loc'] = $_SERVER['PHP_SELF'];
  //Logout if session has timed out.
  if ($_SESSION["timeOut"] < time()) {
    header("Location:/logout.php");
  }
  else {
    //echo $_SESSION["timeOut"] ." - ". time();
    $_SESSION["timeOut"] = (intval(time()) + $staff->getTimeLimit());
  }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if( isset($_POST['signBtn']) ){
    if ( empty($_POST["netID"])){
      $_SESSION['error_msg'] = 'No User Name';
    }
    elseif (empty($_POST["pass"]) ){
      $_SESSION['error_msg'] = 'Missing Password';
    }
    else {
      //Remove 3rd argument, define attribute in ldap.php
      $operator = AuthenticateUser($_POST["netID"],$_POST["pass"]);
      if (array_key_exists('netID', $_SESSION)){
        if ($_SESSION['netID'] != $_POST["netID"]){
          unset($_SESSION['loc']);
        }
        $_SESSION['netID'] = $_POST["netID"];
      }
      if (Users::regexUser($operator)) {
        $staff = Staff::withID($operator);
        //staff get either limit or limit_long as their auto logout timer
        if ($staff->getRoleID() > $sv["LvlOfStaff"])
        $staff->setTimeLimit( $sv["limit_long"] );
        else
        $staff->setTimeLimit( $sv["limit"] );
        //set the timeOut = current + limit of login
        $_SESSION["timeOut"] = (intval(time()) + $staff->getTimeLimit());
        $_SESSION["staff"] = serialize($staff);
        if ( isset($_SESSION['loc']) ){
          header("Location:$_SESSION[loc]");
        }
        if (!headers_sent()){
          echo "<script>window.location.href='/index.php';</script>";
        }
        exit();
      }
      else {
        echo "<script type='text/javascript'> window.onload = function(){goModal('Invalid','Invalid user name and/or password!', false)}</script>";
      }
    }
  }
  elseif( isset($_POST['searchBtn']) ){
    if(filter_input(INPUT_POST, 'searchField')){
      $searchField = filter_input(INPUT_POST, 'searchField');
      if(filter_input(INPUT_POST, 'searchType')){
        $searchType = filter_input(INPUT_POST, 'searchType');
        if(strcmp($searchType, "s_trans") == 0){
          $trans_id = $searchField;
          header("location:/pages/lookup.php?trans_id=$trans_id");
        }
        elseif (strcmp($searchType, "s_operator") == 0){
          $operator = $searchField;
          header("location:/pages/lookup.php?operator=$operator");
        }
        else {
          echo "<script type='text/javascript'> window.onload = function(){goModal('Invalid','Illegal Search Condition', false)}</script>";
        }
      }
      else {
        echo "<script type='text/javascript'> window.onload = function(){goModal('Invalid','Illegal Search Condition', false)}</script>";
      }
    }
    else {
      echo "<script type='text/javascript'> window.onload = function(){goModal('Invalid','Please enter a number.', false)}</script>";
    }
  }
  elseif( filter_input(INPUT_POST, 'pickBtn') !== null ){
    if( filter_input(INPUT_POST, 'pickField') !== null){
      if(!Users::regexUser(filter_input(INPUT_POST, 'pickField'))){
        echo "<script>window.onload = function(){goModal('Success',\"Invalid ID # ".filter_input(INPUT_POST, pickField)."\", true)}</script>";
      }
      else {
        $operator = filter_input(INPUT_POST, 'pickField');
        header("location:/pages/pickup.php?operator=$operator");
      }
    }
  }
}
//Display a Successful message from a previous page
if (isset($_SESSION['success_msg']) && $_SESSION['success_msg']!= ""){
  echo "<script>window.onload = function(){goModal('Success',\"$_SESSION[success_msg]\", true)}</script>";
  unset($_SESSION['success_msg']);
}
elseif (isset($_SESSION['error_msg']) && $_SESSION['error_msg']!= ""){
  echo "<script>window.onload = function(){goModal('Error',\"$_SESSION[error_msg]\", false)}</script>";
  unset($_SESSION['error_msg']);
}
?>

</head>
<body>
  <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <div class="app-header header-shadow">
      <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
          <div>
            <!-- <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button> -->
          </div>
        </div>
      </div>
      <div class="app-header__mobile-menu">
        <div>
          <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>
      </div>
      <div class="app-header__menu">
        <span>
          <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
            <span class="btn-icon-wrapper">
              <i class="fas fa-ellipsis-v fa-w-6"></i>
            </span>
          </button>
        </span>
      </div>
      <div class="app-header__content">
        <div class="app-header-left">
          <div class="search-wrapper">
            <div class="input-holder">
              <input type="text" class="search-input" placeholder="Search for something...">
              <button class="search-icon"><span></span></button>
            </div>
            <button class="close"></button>
          </div>

          <!-- <ul class="header-menu nav">
          <li class="nav-item">
          <a href="javascript:void(0);" class="nav-link">
          <i class="nav-link-icon fas fa-database"> </i>
          Statistics
        </a>
      </li>
      <li class="btn-group nav-item">
      <a href="javascript:void(0);" class="nav-link">
      <i class="nav-link-icon fas fa-edit"></i>
      Projects
    </a>
  </li>
  <li class="dropdown nav-item">
  <a href="javascript:void(0);" class="nav-link">
  <i class="nav-link-icon fas fa-cog"></i>
  Settings
</a>
</li>
</ul>         -->
</div>
<div class="app-header-right">
  <div class="header-btn-lg pr-0">
    <div class="widget-content p-0">
      <div class="widget-content-wrapper">
        <div class="widget-content-left">
          <div class="btn-group">
            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
              <img width="42" class="rounded-circle" src="assets/images/avatars/13.jpg" alt="">
              <i class="fa fa-angle-down ml-2 opacity-8"></i>
            </a>
            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
              <button type="button" tabindex="0" class="dropdown-item">User Profile</button>
              <button type="button" tabindex="0" class="dropdown-item">Settings</button>
              <!-- <h6 tabindex="-1" class="dropdown-header">Header</h6> -->
              <div tabindex="-1" class="dropdown-divider"></div>
              <!-- <button type="button" tabindex="0" class="dropdown-item">Dividers</button> -->
              <button type="button" tabindex="0" class="dropdown-item">Logout</button>
            </div>
          </div>
        </div>
        <div class="widget-content-left  ml-3 header-user-info">
          <div class="widget-heading">
            Khari T.
          </div>
          <div class="widget-subheading">
            FabApp Engineer
          </div>
        </div>
        <div class="widget-content-right header-user-info ml-3">
          <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
            <i class="fas text-white fa-bell pr-1 pl-1"></i>
          </button>
        </div>
        <!-- make this link to the shopping cart page -->
        <div class="widget-content-right header-user-info ml-3">
          <a href="#" class="btn-shadow p-1 btn btn-warning btn-sm">
            <i class="fas text-white fa-shopping-cart pr-1 pl-1"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- <div class="ui-theme-settings">
<button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
<i class="fas fa-cog fa-w-16 fa-spin fa-2x"></i>
</button>
<div class="theme-settings__inner">
<div class="scrollbar-container">
<div class="theme-settings__options-wrapper">
<h3 class="themeoptions-heading">Layout Options
</h3>
<div class="p-3">
<ul class="list-group">
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left mr-3">
<div class="switch has-switch switch-container-class" data-class="fixed-header">
<div class="switch-animate switch-on">
<input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
</div>
</div>
</div>
<div class="widget-content-left">
<div class="widget-heading">Fixed Header
</div>
<div class="widget-subheading">Makes the header top fixed, always visible!
</div>
</div>
</div>
</div>
</li>
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left mr-3">
<div class="switch has-switch switch-container-class" data-class="fixed-sidebar">
<div class="switch-animate switch-on">
<input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
</div>
</div>
</div>
<div class="widget-content-left">
<div class="widget-heading">Fixed Sidebar
</div>
<div class="widget-subheading">Makes the sidebar left fixed, always visible!
</div>
</div>
</div>
</div>
</li>
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left mr-3">
<div class="switch has-switch switch-container-class" data-class="fixed-footer">
<div class="switch-animate switch-off">
<input type="checkbox" data-toggle="toggle" data-onstyle="success">
</div>
</div>
</div>
<div class="widget-content-left">
<div class="widget-heading">Fixed Footer
</div>
<div class="widget-subheading">Makes the app footer bottom fixed, always visible!
</div>
</div>
</div>
</div>
</li>
</ul>
</div>
<h3 class="themeoptions-heading">
<div>
Header Options
</div>
<button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class" data-class="">
Restore Default
</button>
</h3>
<div class="p-3">
<ul class="list-group">
<li class="list-group-item">
<h5 class="pb-2">Choose Color Scheme
</h5>
<div class="theme-settings-swatches">
<div class="swatch-holder bg-primary switch-header-cs-class" data-class="bg-primary header-text-light">
</div>
<div class="swatch-holder bg-secondary switch-header-cs-class" data-class="bg-secondary header-text-light">
</div>
<div class="swatch-holder bg-success switch-header-cs-class" data-class="bg-success header-text-dark">
</div>
<div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-dark">
</div>
<div class="swatch-holder bg-warning switch-header-cs-class" data-class="bg-warning header-text-dark">
</div>
<div class="swatch-holder bg-danger switch-header-cs-class" data-class="bg-danger header-text-light">
</div>
<div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark">
</div>
<div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light">
</div>
<div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light">
</div>
<div class="swatch-holder bg-alternate switch-header-cs-class" data-class="bg-alternate header-text-light">
</div>
<div class="divider">
</div>
<div class="swatch-holder bg-vicious-stance switch-header-cs-class" data-class="bg-vicious-stance header-text-light">
</div>
<div class="swatch-holder bg-midnight-bloom switch-header-cs-class" data-class="bg-midnight-bloom header-text-light">
</div>
<div class="swatch-holder bg-night-sky switch-header-cs-class" data-class="bg-night-sky header-text-light">
</div>
<div class="swatch-holder bg-slick-carbon switch-header-cs-class" data-class="bg-slick-carbon header-text-light">
</div>
<div class="swatch-holder bg-asteroid switch-header-cs-class" data-class="bg-asteroid header-text-light">
</div>
<div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light">
</div>
<div class="swatch-holder bg-warm-flame switch-header-cs-class" data-class="bg-warm-flame header-text-dark">
</div>
<div class="swatch-holder bg-night-fade switch-header-cs-class" data-class="bg-night-fade header-text-dark">
</div>
<div class="swatch-holder bg-sunny-morning switch-header-cs-class" data-class="bg-sunny-morning header-text-dark">
</div>
<div class="swatch-holder bg-tempting-azure switch-header-cs-class" data-class="bg-tempting-azure header-text-dark">
</div>
<div class="swatch-holder bg-amy-crisp switch-header-cs-class" data-class="bg-amy-crisp header-text-dark">
</div>
<div class="swatch-holder bg-heavy-rain switch-header-cs-class" data-class="bg-heavy-rain header-text-dark">
</div>
<div class="swatch-holder bg-mean-fruit switch-header-cs-class" data-class="bg-mean-fruit header-text-dark">
</div>
<div class="swatch-holder bg-malibu-beach switch-header-cs-class" data-class="bg-malibu-beach header-text-light">
</div>
<div class="swatch-holder bg-deep-blue switch-header-cs-class" data-class="bg-deep-blue header-text-dark">
</div>
<div class="swatch-holder bg-ripe-malin switch-header-cs-class" data-class="bg-ripe-malin header-text-light">
</div>
<div class="swatch-holder bg-arielle-smile switch-header-cs-class" data-class="bg-arielle-smile header-text-light">
</div>
<div class="swatch-holder bg-plum-plate switch-header-cs-class" data-class="bg-plum-plate header-text-light">
</div>
<div class="swatch-holder bg-happy-fisher switch-header-cs-class" data-class="bg-happy-fisher header-text-dark">
</div>
<div class="swatch-holder bg-happy-itmeo switch-header-cs-class" data-class="bg-happy-itmeo header-text-light">
</div>
<div class="swatch-holder bg-mixed-hopes switch-header-cs-class" data-class="bg-mixed-hopes header-text-light">
</div>
<div class="swatch-holder bg-strong-bliss switch-header-cs-class" data-class="bg-strong-bliss header-text-light">
</div>
<div class="swatch-holder bg-grow-early switch-header-cs-class" data-class="bg-grow-early header-text-light">
</div>
<div class="swatch-holder bg-love-kiss switch-header-cs-class" data-class="bg-love-kiss header-text-light">
</div>
<div class="swatch-holder bg-premium-dark switch-header-cs-class" data-class="bg-premium-dark header-text-light">
</div>
<div class="swatch-holder bg-happy-green switch-header-cs-class" data-class="bg-happy-green header-text-light">
</div>
</div>
</li>
</ul>
</div>
<h3 class="themeoptions-heading">
<div>Sidebar Options</div>
<button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class" data-class="">
Restore Default
</button>
</h3>
<div class="p-3">
<ul class="list-group">
<li class="list-group-item">
<h5 class="pb-2">Choose Color Scheme
</h5>
<div class="theme-settings-swatches">
<div class="swatch-holder bg-primary switch-sidebar-cs-class" data-class="bg-primary sidebar-text-light">
</div>
<div class="swatch-holder bg-secondary switch-sidebar-cs-class" data-class="bg-secondary sidebar-text-light">
</div>
<div class="swatch-holder bg-success switch-sidebar-cs-class" data-class="bg-success sidebar-text-dark">
</div>
<div class="swatch-holder bg-info switch-sidebar-cs-class" data-class="bg-info sidebar-text-dark">
</div>
<div class="swatch-holder bg-warning switch-sidebar-cs-class" data-class="bg-warning sidebar-text-dark">
</div>
<div class="swatch-holder bg-danger switch-sidebar-cs-class" data-class="bg-danger sidebar-text-light">
</div>
<div class="swatch-holder bg-light switch-sidebar-cs-class" data-class="bg-light sidebar-text-dark">
</div>
<div class="swatch-holder bg-dark switch-sidebar-cs-class" data-class="bg-dark sidebar-text-light">
</div>
<div class="swatch-holder bg-focus switch-sidebar-cs-class" data-class="bg-focus sidebar-text-light">
</div>
<div class="swatch-holder bg-alternate switch-sidebar-cs-class" data-class="bg-alternate sidebar-text-light">
</div>
<div class="divider">
</div>
<div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class" data-class="bg-vicious-stance sidebar-text-light">
</div>
<div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class" data-class="bg-midnight-bloom sidebar-text-light">
</div>
<div class="swatch-holder bg-night-sky switch-sidebar-cs-class" data-class="bg-night-sky sidebar-text-light">
</div>
<div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class" data-class="bg-slick-carbon sidebar-text-light">
</div>
<div class="swatch-holder bg-asteroid switch-sidebar-cs-class" data-class="bg-asteroid sidebar-text-light">
</div>
<div class="swatch-holder bg-royal switch-sidebar-cs-class" data-class="bg-royal sidebar-text-light">
</div>
<div class="swatch-holder bg-warm-flame switch-sidebar-cs-class" data-class="bg-warm-flame sidebar-text-dark">
</div>
<div class="swatch-holder bg-night-fade switch-sidebar-cs-class" data-class="bg-night-fade sidebar-text-dark">
</div>
<div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class" data-class="bg-sunny-morning sidebar-text-dark">
</div>
<div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class" data-class="bg-tempting-azure sidebar-text-dark">
</div>
<div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class" data-class="bg-amy-crisp sidebar-text-dark">
</div>
<div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class" data-class="bg-heavy-rain sidebar-text-dark">
</div>
<div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class" data-class="bg-mean-fruit sidebar-text-dark">
</div>
<div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class" data-class="bg-malibu-beach sidebar-text-light">
</div>
<div class="swatch-holder bg-deep-blue switch-sidebar-cs-class" data-class="bg-deep-blue sidebar-text-dark">
</div>
<div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class" data-class="bg-ripe-malin sidebar-text-light">
</div>
<div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class" data-class="bg-arielle-smile sidebar-text-light">
</div>
<div class="swatch-holder bg-plum-plate switch-sidebar-cs-class" data-class="bg-plum-plate sidebar-text-light">
</div>
<div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class" data-class="bg-happy-fisher sidebar-text-dark">
</div>
<div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class" data-class="bg-happy-itmeo sidebar-text-light">
</div>
<div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class" data-class="bg-mixed-hopes sidebar-text-light">
</div>
<div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class" data-class="bg-strong-bliss sidebar-text-light">
</div>
<div class="swatch-holder bg-grow-early switch-sidebar-cs-class" data-class="bg-grow-early sidebar-text-light">
</div>
<div class="swatch-holder bg-love-kiss switch-sidebar-cs-class" data-class="bg-love-kiss sidebar-text-light">
</div>
<div class="swatch-holder bg-premium-dark switch-sidebar-cs-class" data-class="bg-premium-dark sidebar-text-light">
</div>
<div class="swatch-holder bg-happy-green switch-sidebar-cs-class" data-class="bg-happy-green sidebar-text-light">
</div>
</div>
</li>
</ul>
</div>
<h3 class="themeoptions-heading">
<div>Main Content Options</div>
<button type="button" class="btn-pill btn-shadow btn-wide ml-auto active btn btn-focus btn-sm">Restore Default
</button>
</h3>
<div class="p-3">
<ul class="list-group">
<li class="list-group-item">
<h5 class="pb-2">Page Section Tabs
</h5>
<div class="theme-settings-swatches">
<div role="group" class="mt-2 btn-group">
<button type="button" class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class" data-class="body-tabs-line">
Line
</button>
<button type="button" class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class" data-class="body-tabs-shadow">
Shadow
</button>
</div>
</div>
</li>
</ul>
</div>
</div>
</div>
</div>
</div> -->
<div class="app-main">
  <div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
      <div class="logo-src"></div>
      <div class="header__pane ml-auto">
        <div>
          <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>
      </div>
    </div>
    <div class="app-header__mobile-menu">
      <div>
        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>
      </div>
    </div>
    <div class="app-header__menu">
      <span>
        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
          <span class="btn-icon-wrapper">
            <i class="fas fa-ellipsis-v fa-w-6"></i>
          </span>
        </button>
      </span>
    </div>    <div class="scrollbar-sidebar">
      <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
          <li class="app-sidebar__heading">Category 1</li>
          <li>
            <a href="index.php" class="mm-active">
              <i class="metismenu-icon pe-7s-home"></i>
              Dashboard
            </a>
            <?php if (isset($staff) && $staff->getRoleID() >=  $sv['LvlOfStaff']) { ?>
              <a href="/pages/all_goods.php" >
                <i class="metismenu-icon pe-7s-piggy"></i>
                Register
              </a>
            <?php } ?>
            <a href="/admin/stats.php" >
              <i class="metismenu-icon pe-7s-graph"></i>
              Reports
            </a>
            <a href="#" >
              <i class="metismenu-icon pe-7s-users"></i>
              Users
            </a>
          </li>
          <?php if (isset($staff) && $staff->getRoleID() >=  $sv['LvlOfStaff']) { ?>
            <li>
              <a href="#" id="searchLink">
                <i class="metismenu-icon pe-7s-search">
                </i> Look-Up By
                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
              </a>
            <ul class="nav nav-second-level">
              <form name="searchForm" method="POST" action="" autocomplete="off"  onsubmit="return validateNum('searchForm')">
                <li class="sidebar-radio">
                  <input type="radio" name="searchType" value="s_trans" id="s_trans" checked onchange="searchF()" onclick="searchF()"><label for="s_trans">Ticket</label>
                  <input type="radio" name="searchType" value="s_operator" id="s_operator" onchange="searchF()" onclick="searchF()"><label for="s_operator">ID #</label>
                </li>
                <li class="sidebar-search">
                  <div class="input-group custom-search-form">
                    <input type="number" name="searchField" id="searchField" class="form-control" placeholder="Search..." name="searchField" onclick="searchF()">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit" name="searchBtn">
                        <i class="fas fa-search"></i>
                      </button>
                    </span>
                  </div>
                </li>
              </form>
            </ul>
          </li>
          <li>
            <a href="#" id="pickLink">
              <i class="metismenu-icon pe-7s-gift">
              </i> Pick Up 3D Print
              <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
            </a>
            <ul class="nav nav-second-level">
              <form name="pickForm" method="POST" action="" autocomplete="off" onsubmit="return validateNum('pickForm')">
                <li class="sidebar-search">
                  <div class="input-group custom-search-form">
                    <input type="text" name="pickField" id="pickField" class="form-control" placeholder="Enter ID #" maxlength="10" size="10">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit" name="pickBtn">
                        <i class="fas fa-search"></i>
                      </button>
                    </span>
                  </div>
                </li>
              </form>
            </ul>
          </li>
          <?php if ($sv['wait_system'] != "new") { ?>
            <li>
              <a href="/admin/now_serving.php"><i class="fas fa-list-ol"></i> Now Serving</a>
            </li>
            <?php
          }
        }
        if(isset($staff) && $staff->getRoleID() >= $sv['LvlOfStaff']) { ?>
          <li>
            <a href="#" >
              <i class="metismenu-icon pe-7s-server"></i>
              Inventory
              <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
            </a>
            <ul>
              <li>
                <a href="/pages/inventory.php">
                  <i class="metismenu-icon">
                  </i> Current Inventory
                </a>
              </li>
              <li>
                <a href="/pages/inventory_processing.php">
                  <i class="metismenu-icon">
                  </i> Add Inventory
                </a>
              </li>
            </ul>
          </li>
        <?php }
        else { ?>
          <li>
            <a href="/pages/inventory_processing.php">
              <i class="metismenu-icon pe-7s-server">
              </i> Inventory
            </a>
          </li>
        <?php } ?>

        <li class="app-sidebar__heading">Category 2</li>
        <li>
          <a href="#">
            <i class="metismenu-icon pe-7s-portfolio"></i>
            Tools
          </a>
        </li>
        <li>
          <?php if (isset($staff) && $staff->getRoleID() >=  $sv['LvlOfStaff']) { ?>
            <a href="/admin/error.php">
              <i class="metismenu-icon pe-7s-gleam"></i>
              Error
            </a>
          <?php } ?>
        </li>
        <?php if (isset($staff) && ($staff->getRoleID() >=  $sv['LvlOfStaff'] || $staff->getRoleID() ==  $sv['serviceTechnican'])) { ?>
        <li>
          <a href="#">
            <i class="metismenu-icon pe-7s-tools"></i>
            Service
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
          </a>
          <ul>
            <li>
              <a href="/pages/sr_history.php">
                <i class="metismenu-icon">
                </i>Device History
              </a>
            </li>
            <li>
              <a href="/pages/open_sr.php">
                <i class="metismenu-icon">
                </i>Open Service Issues
              </a>
            </li>
            <li>
              <a href="/pages/sr_issue.php">
                <i class="metismenu-icon">
                </i>Report Issue
              </a>
            </li>
          </ul>
        </li>
       <?php  }
        if (isset($staff) && $staff->getRoleID() >=  $sv['LvlOfLead']) { ?>
        <li>
          <a href="#">
            <i class="metismenu-icon pe-7s-notebook"></i>
            Training
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
          </a>
          <ul>
            <li>
              <a href="/admin/training_certificate.php">
                <i class="metismenu-icon">
                </i>Issue Certificate
              </a>
            </li>
            <li>
              <a href="/admin/training_revoke.php">
                <i class="metismenu-icon">
                </i>Issued Trainings
              </a>
            </li>
            <li>
              <a href="/admin/manage_trainings.php">
                <i class="metismenu-icon">
                </i>Manage Trainings
              </a>
            </li>
          </ul>
        </li>
       <?php }
       if(isset($staff) && $staff->getRoleID() >=  $sv['LvlOfStaff'] && $sv['wait_system'] == "new"){ ?>
        <li>
          <a href="/pages/wait_ticket.php">
            <i class="metismenu-icon pe-7s-menu">
            </i>Wait Queue Ticket
          </a>
        </li>
       <?php } ?>
       <?php  if(isset($staff) && $staff->getRoleID() >= $sv['minRoleTrainer']) { ?>
        <li>
          <a href="#">
            <i class="metismenu-icon pe-7s-share"></i>
            Site Tools
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
          </a>
          <ul>
            <li>
              <a href="/admin/sv.php">
                <i class="metismenu-icon">
                </i>Site Variables
              </a>
            </li>
            <li>
              <a href="/admin/storage_unit_creator.php">
                <i class="metismenu-icon">
                </i>Storage Box
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <li>
          <a href="#">
            <i class="metismenu-icon pe-7s-user">
            </i>Admin
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
          </a>
          <ul>
            <li>
              <a href="/admin/manage_device.php">
                <i class="metismenu-icon">
                </i> Manage Devices
              </a>
            </li>
            <li>
              <a href="/admin/objbox.php">
                <i class="metismenu-icon">
                </i> Objects in Storage
              </a>
            </li>
            <li>
              <a href="/admin/onboarding.php">
                <i class="metismenu-icon">
                </i> OnBoarding
              </a>
            </li>
            <li>
            <a href="#">
              <i class="metismenu-icon">
              </i> Users
              <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
            </a>
            <ul>
              <li>
                <a href="/admin/addrfid.php">
                  <i class="metismenu-icon">
                  </i> Add RFID
                </a>
              </li>
            </ul>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="app-main__outer">
