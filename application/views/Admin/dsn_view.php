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

    <link href="<?php echo base_url('themes/starlightadmin/template/lib/highlightjs/github.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('themes/starlightadmin/template/lib/datatables/jquery.dataTables.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('themes/starlightadmin/template/lib/select2/css/select2.min.css')?>" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="<?php echo base_url('themes/starlightadmin/template/css/starlight.css')?>">
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href="<?php echo base_url('Admin')?>" style="font-size: 18px;">Diskusi CIC (Admin)</a></div>
    <div class="sl-sideleft">

      <label class="sidebar-label">Navigation</label>
      <div class="sl-sideleft-menu">
        <a href="<?php echo base_url('Admin/Main')?>" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        <a href="<?php echo base_url('Admin/user/2')?>" class="sl-menu-link active">
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
        <span class="breadcrumb-item active">User</span>
      </nav>

      <div class="container">
        <div class="row">
          <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40" id="table">
              <h6 class="card-body-title">Data User</h6>
              <p class="mg-b-20 mg-sm-b-30"><a href="<?php echo base_url('Admin/user/1');?>"><button class="btn btn-outline-primary" id="mhs">Mahasiswa</button></a> <button class="btn btn-outline-primary active" id="dsn">Dosen</button> <a href="<?php echo base_url('Admin/input_dsn_view');?>"><button style="float: right;" class="btn btn-primary">+ Tambah User</button></a></p>

              <?php echo '<label class="text-info">' .$this->session->flashdata('info'). '</label>';?>
              <?php echo '<label class="text-danger">' .$this->session->flashdata('error'). '</label>';?>

              <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                  <thead>
                    <tr>
                      <th class="wd-10p">NIP</th>
                      <th class="wd-20p">Nama Lengkap</th>
                      <th class="wd-15p">Jenis Kelamin</th>
                      <th class="wd-15p">E-mail</th>
                      <th class="wd-25p">Alamat</th>
                      <th class="wd-10p">Foto</th>
                      <th class="wd-15p">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($dsn->result() as $m){ ?>
                    <tr>
                      <td><?php echo $m->nip;?></td>
                      <td><?php echo $m->nama;?></td>
                      <td><?php echo $m->jk;?></td>
                      <td><?php echo $m->email;?></td>
                      <td><?php echo $m->alamat;?></td>
                      <td><img src="<?php echo base_url('./assets/profile/'.$m->foto)?>" style="height: 50px; width: 50px;"></td>
                      <td><a href="<?php echo base_url('Admin/update_dsn/'.$m->id_user.'/'.$m->id_dosen);?>"><button class="btn btn-sm btn-warning">Edit</button></a> <a href="<?php echo base_url('Admin/delete_dsn/'.$m->id_user.'/'.$m->id_dosen);?>"><button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-info">Delete</button></a></td>
                    </tr>
                    <!-- <div class="modal fade" id="modal-info">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <?php echo form_open_multipart('Admin/delete_dsn/'.$m->id_user.'/'.$m->id_dosen);?>
                            <div class="modal-header">
                              <h1 class="modal-tittle">Konfirmasi</h1>
                            </div>
                            <div class="modal-body">
                              <h5>Hapus User <?php echo $m->nama;?>?</h5>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <?php echo form_close();?>
                          </div>
                        </div>
                      </div>
                    </div> -->
                  <?php } ?>
                  </tbody>
                </table>
              </div><!-- table-wrapper -->
            </div><!-- card -->
          </div><!-- sl-pagebody -->
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
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/highlightjs/highlight.pack.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/datatables/jquery.dataTables.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/datatables-responsive/dataTables.responsive.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/lib/select2/js/select2.min.js')?>"></script>
    <script src="<?php echo base_url('themes/starlightadmin/template/js/starlight.js')?>"></script>
    <script>
      $(function(){
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>

  </body>
</html>
