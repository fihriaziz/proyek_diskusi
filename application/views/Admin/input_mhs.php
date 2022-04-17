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
    <div class="sl-logo"><a href="<?php echo base_url('Admin')?>" style="font-size: 18px;">Diskusi CIC (Admin)</a></div>
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
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">User</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        <a href="<?php echo base_url('Admin/all_diskusi')?>" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
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
        <a class="breadcrumb-item" href="<?php echo base_url('Admin/User/2')?>">User</a>
        <span class="breadcrumb-item active">Input Mahasiswa</span>
      </nav>

      <div class="container">
        <div class="row">
          <div class="col-xl-6">
            <div class="card pd-20 pd-sm-40 form-layout form-layout-4" style="margin-top: 20px;">
              <h6 class="card-body-title">Form Input Data Mahasiswa</h6><br>
              <?php echo form_open_multipart('Admin/input_mhs');?>
              <div class="row">
                <input type="hidden" name="status" value="Mahasiswa">
                <label class="col-sm-4 form-control-label">NIM: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" class="form-control" name="nim" placeholder="Masukan NIM">
                </div>
              </div><!-- row -->
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Nama Lengkap: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Lengkap">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Jenis Kelamin: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <select class="form-control select2" name="jk" data-placeholder="Jenis Kelamin">
                    <option label="Pilih Jenis Kelamin"></option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Prodi: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <select class="form-control select2" name="prodi" data-placeholder="Prodi">
                    <option label="Pilih Prodi"></option>
                    <option value="TI">TI</option>
                    <option value="SIKA">SIKA</option>
                    <option value="SIMB">SIMB</option>
                    <option value="DKV">DKV</option>
                    <option value="KA-D3">KA-D3</option>
                    <option value="MI-D3">MI-D3</option>
                    <option value="MB-D3">MB-D3</option>
                    <option value="LKP">LKP</option>
                  </select>
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Semester: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" class="form-control" name="semester" placeholder="Masukan Semester">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Email: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" class="form-control" name="email" placeholder="Masukan Email">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Alamat: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <textarea rows="2" class="form-control" name="alamat" placeholder="Masukan Alamat"></textarea>
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Username: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" class="form-control" name="username" placeholder="Masukan Username">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Password: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="password" class="form-control" name="password" placeholder="Masukan Password">
                </div>
              </div>
              <div class="form-layout-footer mg-t-30">
                <button class="btn btn-info mg-r-5">Submit</button>
                <a href="<?php echo base_url('Admin/Main')?>"><button class="btn btn-danger">Cancel</button></a>
              </div><!-- form-layout-footer -->
              <?php echo form_close();?>
            </div><!-- card -->
          </div><!-- col-6 -->
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
