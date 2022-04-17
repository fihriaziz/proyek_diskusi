<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="20" >
	<title>diskusCiC</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap-theme.min.css')?>">
	<script type="text/javascript">
		function cek_notif() {
             xmlhttp = new XMLHttpRequest();
             xmlhttp.open("GET","<?php echo site_url('Main/notif_cek'); ?>",false);
             xmlhttp.send(null);
//                 console.log(xmlhttp.responseText);
//                document.getElementById("getdata").innerHTML = Date();
            document.getElementById("notif").innerHTML = xmlhttp.responseText;
        }
        setInterval(function () {
            cek_notif();
        }, 5000);
	</script>
</head>
<body>

<div class="navbar navbar-inverse navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?php echo base_url('Main')?>" class="navbar-brand"><img src="<?php echo base_url('assets/pic_sys/logo.png')?>" style="width: 100px; height: 30px;"></a>
		</div>

		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_url('Main')?>">Home</a></li>
				<li class="dropdown" id="notif">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Notification<span class="label label-pill label-danger" id="count"></span></a>

					<ul class="dropdown-menu"></ul>
				</li>
				<li><a href="<?php echo base_url('Main/profile')?>">Profile</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url('Main/all_diskusi')?>">Semua Diskusi</a></li>
						<li><a href="<?php echo base_url('Main/logout')?>">Logout</a></li>
					</ul>
				</li>
			</ul>
			
			<form class="navbar-form navbar-right" method="get" action="<?php echo site_url('Main/cari')?>">
				<div class="form-group">
					<input type="text" name="cari" class="form-control" placeholder="Cari Diskusi..">
				</div>
				<button type="submit" class="btn btn-default">Cari</button>
			</form>
		</div>
		
	</div>
	
</div>

<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">Semua Diskusi</div>
			<div class="panel-body">
				<?php echo form_open('Main/urutan'); ?>
				<br><p>Urut Berdasarkan : 
				<select name="urut">
					<option label="Pilih Urutan"></option>
					<option value="terbaru">Terbaru</option>
					<option value="paling lama">Paling Lama</option>
				</select>
				<button type="submit" class="btn btn-info btn-xs">Submit</button>
				</p><br>
				<?php echo $this->session->flashdata('notif'); ?>
				<?php echo form_close(); ?>
				<?php foreach($diskusi->result() as $r){?>
				<ul class="list-group">
					<li class="list-group-item">
						<?php echo "<a href='".base_url()."Main/diskusi/".$r->id_diskusi."'><h4>".$r->judul."</h4></a>";?>
						<p><?php echo $r->isi;?></p>
					</li>
					<div style="float: left;">
						Dipost Oleh :<?php echo $r->nama;?>
					</div>
					<div style="float: right;">
						<?php echo $r->tgl_post;?>
					</div>
				</ul><br>
				<?php } ?>
			</div>
		</div>
	</div>

<footer>
	<p style="text-align: right">Copyright &copy2017 STMIK CIC</p>
</footer>

</div>



<script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
</body>
</html>