<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Admin Diskusi CIC</title>

    <!-- vendor css -->
    <link href="<?php echo base_url('themes/starlightadmin/template/lib/font-awesome/css/font-awesome.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('themes/starlightadmin/template/lib/Ionicons/css/ionicons.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('themes/starlightadmin/template/lib/perfect-scrollbar/css/perfect-scrollbar.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('themes/starlightadmin/template/lib/rickshaw/rickshaw.min.css')?>" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="<?php echo base_url('themes/starlightadmin/template/css/starlight.css')?>">
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href="<?php echo base_url('Admin/Main')?>" style="font-size: 18px;">Diskusi CIC (Admin)</a></div>
    <div class="sl-sideleft">

      <label class="sidebar-label">Navigation</label>
      <div class="sl-sideleft-menu">
        <a href="<?php echo base_url('Admin/Main')?>" class="sl-menu-link active">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        <a href="<?php echo base_url('Admin/user/1')?>" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-person-outline tx-22"></i>
            <span class="menu-item-label">User</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        <a href="<?php echo base_url('Admin/all_diskusi')?>" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-chatboxes-outline tx-22"></i>
            <span class="menu-item-label">Semua Diskusi</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
            <a href="" class="nav-link nav-link-profile">
              <span class="logged-name"><?php echo $this->session->userdata('nama'); ?></span>
            </a>
        </nav>
        <div style="padding-right: 20px">
            <a href="<?php echo base_url('Admin'); ?>" class="text-danger">Logout</a>
        </div>
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->

  

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="<?php echo base_url('Admin/Main')?>">Diskusi CIC (Admin)</a>
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>

      <div class="container">
        <div class="row">
          <!-- Bagian User -->
          <div class="jumbotron col-sm-3" style="margin-top: 20px; margin-left: -15px;">
            <center>
              <h3 style="margin-top: -10px; margin-bottom: -20px;">Jumlah User</h3>

              <style type="text/css">
                .ion-ios-person {
                  font-size: 100px;
                }
              </style>

              <span class="icon ion-ios-person"></span>
              <h3 style="margin-bottom: -10px; margin-top: -20px;"><?php echo $this->db->count_all_results('user'); ?></h3>
              <a href="<?php echo base_url('Admin/user/1')?>"><button class="btn btn-link" style="margin-top: 20px; font-size: 20px; margin-bottom: -30px;">Lihat User</button></a>
            </center>
          </div>
          <!-- end bagian user -->

          <!-- bagian diskusi -->
          <div class="jumbotron col-sm-3" style="margin-top: 20px; margin-left: 5px;">
            <center>
              <h3 style="margin-top: -10px; margin-bottom: -20px;">Jumlah Diskusi</h3>

              <style type="text/css">
                .ion-ios-chatboxes {
                  font-size: 100px;
                }
              </style>

              <span class="icon ion-ios-chatboxes"></span>
              <h3 style="margin-bottom: -10px; margin-top: -20px;"><?php echo $this->db->count_all_results('diskusi'); ?></h3>
              <a href="<?php echo base_url('Admin/all_diskusi')?>"><button class="btn btn-link" style="margin-top: 20px; font-size: 20px; margin-bottom: -30px;">Lihat Diskusi</button></a>
            </center>
          </div>
          <!-- end bagian diskusi -->

          <!-- bagian report diskusi -->
          <div class="jumbotron col-sm-3" style="margin-top: 20px; margin-left: 5px;">
            <center>
              <h3 style="margin-top: -40px; margin-bottom: -20px;">Jumlah Report Diskusi</h3>

              <style type="text/css">
                .ion-information-circled {
                  font-size: 100px;
                }
              </style>

              <span class="icon ion-information-circled"></span>
              <h3 style="margin-bottom: -10px; margin-top: -20px;"><?php echo $this->db->count_all_results('reportDiskusi'); ?></h3>
              <a href="<?php echo base_url('Admin/reportDiskusi_view')?>"><button class="btn btn-link" style="margin-top: 20px; font-size: 20px; margin-bottom: -30px;">Lihat Report Diskusi</button></a>
            </center>
          </div>
          <!-- end bagian report komentar -->

          <!-- bagian report komentar -->
          <div class="jumbotron col-sm-3" style="margin-top: 20px; margin-left: 5px;">
            <center>
              <h3 style="margin-top: -40px; margin-bottom: -20px;">Jumlah Report Komentar</h3>

              <style type="text/css">
                .ion-information-circled {
                  font-size: 100px;
                }
              </style>

              <span class="icon ion-information-circled"></span>
              <h3 style="margin-bottom: -10px; margin-top: -20px;"><?php echo $this->db->count_all_results('reportKomentar'); ?></h3>
              <a href="<?php echo base_url('Admin/reportKomentar_view')?>"><button class="btn btn-link" style="margin-top: 20px; font-size: 20px; margin-bottom: -30px;">Lihat Report Komentar</button></a>
            </center>
          </div>
          <!-- end bagian report komentar -->

          <!-- profile admin -->
          <div class="jumbotron col-sm-12" style="padding-bottom: 5px;">
            <div class="row"> <!-- row2 -->
            <?php foreach($admin->result() as $a){ ?>
              <div class="col-sm-5">
                <h1 style="margin-top: -50px;">Profile Admin</h1>
                <div class="form-group" style="padding-top: 10px;">
                  <pre><p style="font-size: 18px;">Nama   : <?php echo $a->nama ?></p></pre>
                </div>
                <div class="form-group" style="padding-top: 10px;">
                  <pre><p style="font-size: 18px;">No.tlp : <?php echo $a->no_tlp ?></p></pre>
                </div>
              </div>

              <div class="col-sm-7">
                <!-- edit profile -->
                <a href="<?php echo base_url('Admin/form_edit_profile/'.$a->id_admin)?>" style="float: right; font-size: 18px; margin-top: -50px;">Edit</a>
                <!-- end edit profile -->
                <div class="form-group" style="padding-top: 10px;">
                  <pre><p style="font-size: 18px;">Email  : <?php echo $a->email ?></p></pre>
                </div>
                <div class="form-group" style="padding-top: 10px;">
                  <pre><p style="font-size: 18px;">Alamat :<?php echo $a->alamat ?></p></pre>
                </div>
                </div>
            <?php } ?>
            </div><!-- end row2 -->
          </div> <!-- end jumbotron -->
          <!-- end profile admin -->

        </div> <!-- end row -->
      </div> <!-- end container -->




      <footer class="sl-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright &copy; 2018. STMIK CIC Cirebon. All Rights Reserved.</div>
        </div>
      </footer>
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="<?php echo base_url('themes/starlightadmin/template/lib/jquery/jquery.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/popper.js/popper.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/bootstrap/bootstrap.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/jquery-ui/jquery-ui.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/jquery.sparkline.bower/jquery.sparkline.min.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/d3/d3.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/rickshaw/rickshaw.min.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/chart.js/Chart.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/Flot/jquery.flot.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/Flot/jquery.flot.pie.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/Flot/jquery.flot.resize.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/flot-spline/jquery.flot.spline.js')?>"></script>

<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/js/starlight.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/js/ResizeSensor.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/js/dashboard.js')?>"></script>
  </body>
</html>
