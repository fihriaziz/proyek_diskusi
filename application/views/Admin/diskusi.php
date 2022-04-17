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
        <a href="<?php echo base_url('Admin/Main')?>" class="sl-menu-link">
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

        <a href="<?php echo base_url('Admin/all_diskusi')?>" class="sl-menu-link active">
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
        <span class="breadcrumb-item active">Semua Diskusi</span>
      </nav>

      <div class="container">
        <div class="row">
          <div class="sl-pagebody col-sm-12">
            <div class="card">
              <div class="card-body">
                <div class="card card-body col-sm-12 col-xs-12">
                  <?php foreach($diskusi->result() as $r){?>
                  <?php $id_diskusi = $r->id_diskusi; ?>
                  <ul class="list-group">
                    <li class="list-group-item">
                      <div style="float: right;">
                        <?php echo "<a href='".base_url()."Admin/hapus_diskusi/".$r->id_diskusi."'>Hapus</a>";?>
                      </div>
                      <?php echo "<a href='".base_url()."Admin/diskusi/".$r->id_diskusi."'><h2>".$r->judul."</h2></a>";?>
                    </li>
                    <li class="list-group-item">
                      <p><?php echo $r->isi;?></p>
                    </li>
                    <li class="list-group-item">
                      <?php 
                      if($r->tambahan=="Y"){
                        foreach($lampir as $l){
                          if($l->is_image == 0){ ?>
                            <p>Lampiran : <a href="<?php echo base_url('Admin/download/'.$l->id_file);?>"><?php echo $l->nama_file; ?></a></p>
                          <?php 
                          }else{ ?>
                            <center><img src="<?php echo base_url('assets/files/') . $l->nama_file ?>" style="width: 280px; height: 280px;"></center>
                            <!-- <center><a href="<?php echo base_url('Main/download/'.$l->id_file);?>">Download</a></center> -->
                          <?php
                          }
                        }
                      }else{ ?>
                        <p>Lampiran : Tidak Ada Lampiran </p>
                      <?php } ?>
                    </li>
                    <li class="list-group-item">
                      <div style="float: left;">
                        <?php foreach($mhs->result() as $m){ ?>
                        Di Post Oleh : <a href="<?php echo base_url('Admin/profil_other/'.$m->id_user); ?>"><?php echo $m->nama; ?></a>
                        <?php } ?>
                      </div>
                      <div style="float: right;">
                        <?php echo $r->tgl_post;?>
                      </div>
                    </li>
                  </ul>
                  <?php } ?>
                </div>
                <div id="komenan" class="form-group col-sm-12 col-xs-12" style="margin-top: 30px;">
                <strong><?php echo '<label class="alert-success text-info">' .$this->session->flashdata('info'). '</label>';?></strong>
                  <h3>Komentar</h3>
                  <?php foreach($komen->result() as $k){?>
                  <ul class="list-group">
                    
                    <li class="list-group-item">
                      <div class="row">
                        <div class="col-sm-1">
                          <img src="<?php echo base_url('./assets/profile/'.$k->foto)?>" class="rounded-circle" style="width: 70px; height: 70px;">
                        </div>
                        <div class="col-sm-11">
                            <div style="float: right;">
                              <?php echo "<a href='".base_url()."Admin/hapus_komen/".$k->id_diskusi."/".$k->id_komentar."'>Hapus</a>";?>
                            </div>
                          <?php echo "<a href='".base_url()."Admin/profil_other/".$k->id_user."'><h4>".$k->nama."</h4></a>";?>
                          <p><?php echo $k->isi_komentar;?></p>
                        </div>
                      </div>
                    </li>
                    <?php 
                    if($k->is_image == '0'){?>
                      <li class="list-group-item">
                        <p>Lampiran : <a href="<?php echo base_url('Admin/download_lampiran/'.$k->id_komentar);?>"><?php echo $k->lampiran; ?></a></p>
                      </li>
                    <?php }elseif($k->is_image == '1'){ ?>
                      <li class="list-group-item">
                        <img src="<?php echo base_url('assets/file_komen/') . $k->lampiran ?>" style="width: 280px; height: 280px;">
                      </li>
                    <?php } ?>
                    <li class="list-group-item">
                      <div style="float: right;">
                        <?php echo $k->tgl_komentar;?>
                      </div>
                    </li>
                  </ul><br>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div><!-- end pagebody -->
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
